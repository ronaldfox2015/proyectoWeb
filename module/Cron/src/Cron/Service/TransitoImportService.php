<?php
namespace Cron\Service;
use Zend\ServiceManager\ServiceLocatorInterface;          

class TransitoImportService  
{  
    private $_sl = null;
    
    public function __construct(ServiceLocatorInterface $serviceLocator) {
        $this->_sl = $serviceLocator;
    }   
    
    /* 
     * @return \Epass\Model\Collection\CronLogCollection
     */
    protected function _getCronLogCollection()
    {
        return $this->_sl->get('CronLogCollection');
    }
    
    /**
     * 
     * @return \Epass\Service\EmailService
     */
    protected function _getEmailService()
    {
       return $this->_sl->get('EmailService') ;
    }
    
    /**
     * 
     * @return \Epass\Service\FtpService
     */
    protected function _getFtpService()
    {
       return $this->_sl->get('FtpService') ;
    }

    public function import() 
    {      
        $log[] = '--- Importar Transitos FTP ---' . PHP_EOL;
        $error = array();
        $config = $this->_sl->get('config');
        
        
        $ftpService = $this->_getFtpService();
        $ftpService->setConfig($config['ftp-transacciones']);
        $transitoVersion = $this->_sl->get('TransitoVersionModel');
        if ($ftpService->connect()) {
            $result = $transitoVersion->getLast();
            $archivos = $ftpService->getFiles($result, $config['ftp-transacciones']['fileServer'] . 'Transits');

            if (is_array($archivos) && count($archivos)) {
                foreach ($archivos as $fileServer) {
                    $partes_ruta = pathinfo($fileServer);
                    
                    $filename = $partes_ruta['basename'];
                    $fileLocal = $config['ftp-transacciones']['fileLocal'].$filename;
             
                    if ($partes_ruta['extension'] == 'txt') {
                        $log[] = "Descargando archivo FTP $filename" . PHP_EOL;
                        if ($ftpService->getFileSize($fileServer)) {
                            if ($ftpService->getFile($fileServer, $fileLocal)) {

                                $db = $this->_sl->get('adapter');
                                $con = $db->getDriver()->getConnection();
                                $con->beginTransaction();
                                try {
                                    $insertValues = $this->_getInsertValues($fileLocal);
                                    $this->_executeInserts($insertValues, $log);
                                    $transitoVersion->save(array('version' => $fileServer));
                                    $con->commit();
                                    
                                    $ftpService->moveFile($fileServer, $config['ftp-transacciones']['fileServer']  . 'Transits_process/'. $filename );
                                } catch (\Exception $exc) {
                                    $con->rollback();
                                    $error[] = $exc->getMessage();
                                }                                
                            } else {
                                $error[] = "No se pudo descargar el archivo $filename" . PHP_EOL;
                            }
                        } else {
                            $error[] = "El archivo esta vacio $filename" . PHP_EOL;
                            $ftpService->moveFile($fileServer, $config['ftp-transacciones']['fileServer']  . 'Transits_error/'. $filename );
                        }
                       
                    } else {
                        $error[] = "Archivo no valido:$filename" . PHP_EOL;
                    }
                }
            } 
            $ftpService->close();
        } else {
            $error[] = 'Fallo en la conexion' . PHP_EOL;
        }
        $this->_getCronLogCollection()->save(array('data' => $log, 'error' => $error, 'type' => 'transits'));
        echo implode('<br>', $log);
        echo implode('<br>', $error);
        
        $this->_eliminarTransitosDuplicados();
        $this->_sendMailError($error);
    }
    
    private function _sendMailError($error) 
    {        
        if (!empty($error)) {
            $config = $this->_sl->get('config');
            if (isset($config['mail']['exception_notification']['enabled']) && isset($config['mail']['exception_notification']['enabled']) == true) {
                $this->_getEmailService()->enviarMailExceptionNoTemplate('Error: Cron Importar transitos', $config['mail']['exception_notification']['emails'], implode('<br>', $error));
            }                
        }
    }
    
    private function _getInsertValues($fileLocal) 
    {
        $result = array();
        $_values = "";
        chmod($fileLocal, 0777);
        if (($gestor = fopen($fileLocal, "r")) !== FALSE) {
            $contador = 1;
            $limite = 20000;
            
            while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                $total = count($datos);
                $datos = array_map("utf8_encode", $datos);
                $_values .= "(";
                $_row = "";
                for ($c=0; $c < $total; $c++) {
                    if ($c < 15) {
                        $val = $datos[$c];
                        $_row .= '"'.$val.'",';
                    }
                }
                $_values .= rtrim($_row, ",");
                $_values .= "),";
                if ($contador < $limite) {
                    $contador++;
                } else {
                    $result[] = $_values;
                    $contador = 1;
                    $_values = "";
                }
            }            
            $result[] = $_values;
            fclose($gestor);
        }
        
        return $result;
    }
    
    private function _executeInserts($insertValues, &$log) 
    {
        $transitosImport = $this->_sl->get('TransitosModel');
        foreach($insertValues as $values) {
            if (!empty($values)) {
                $sql = " INSERT INTO transito (TOLLCOMPANY, PAYMENTMEANS, ISSUER,TAG, PASSAGETIME, PLAZA, LANE, CLASS, AMOUNT, CREATOR, ACCOUNT, PLATE, BILLINGRUC,BILLINGRAZONSOCIAL,ROWVERSION)
                        VALUES ";
                $sql .= rtrim($values, ",");
                $sql .= ";";

                $log[] = "Insertando registros en Base de Datos..." . PHP_EOL;

                $result = $transitosImport->executeSql($sql);
                $log[] = "Se insertaron {$result->count()} registros" . PHP_EOL;
            }
        }        
    }

    private function _eliminarTransitosDuplicados() 
    {
        
        $dbAdapter = $this->_sl->get('adapter');

        $sql = "
                SET SQL_SAFE_UPDATES = 0;

                DELETE FROM transito
                WHERE id  IN(SELECT * 
                FROM (SELECT MIN(t.id)
                FROM transito t
                GROUP BY TollCompany, PaymentMeans, substring(PASSAGETIME,1,14), Plaza, Lane
                HAVING COUNT(*) > 1 ) temp);

                SET SQL_SAFE_UPDATES = 1;
            ";

        $statement = $dbAdapter->query($sql);  
        $result = $statement->execute();
    }    

    /*
    public function inicioTransitosAction()
    {
        $fileServer = 'transitos-inicial.csv';
        $config = $this->_sl->get('config');  
            $file = $config['ftp-transacciones']['fileLocal'].$fileServer;
            $_values = "";
            $res = array();
            chmod($file, 0777);
            echo "Abriendo archivo $file...".PHP_EOL;
            if (($gestor = fopen($file, "r")) !== FALSE) {
                $contador = 1;
                $limite = 29000;
                while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                    $total = count($datos);
                    $datos = array_map("utf8_encode", $datos);
                    $_values .= "(";
                    $_row = "";
                    for ($c=0; $c < $total; $c++) {
                        //
                        if ($c < 15){
                            $val = $datos[$c];
                            $_row .= '"'.$val.'",';
                        }
                    }
                    $_values .= rtrim($_row, ",");
                    $_values .= "),";
                    if($contador<$limite)
                    {
                        $contador++;
                    }
                    else
                    {
                        $res[] = $_values;
                        $contador = 1;
                        $_values = "";
                    }
                }
                $res[] = $_values;
                fclose($gestor);
                $kk=1;
                foreach($res as $value)
                {
                    if(!empty($value))
                    {
                                $sql = "
                                INSERT INTO transito (TOLLCOMPANY, PAYMENTMEANS, ISSUER,TAG, PASSAGETIME, PLAZA, LANE, CLASS, AMOUNT, CREATOR, ACCOUNT, PLATE, BILLINGRUC,BILLINGRAZONSOCIAL,ROWVERSION)
                                VALUES ";
                        $sql .= rtrim($value, ",");
                        $sql .= ";";

                        echo "Insertando registros en Base de Datos...".PHP_EOL;
                        try {
                            $transitosImport = $this->_sl->get('TransitosModel');
//                            $result = $transitosImport->executeSql($sql);                    
//                            echo "Se insertaron {$result->count()} registros".PHP_EOL;   
                            $filename = $config['ftp-transacciones']['fileLocal']. $kk . '-transitos-inicial.sql';
                            $nuevoarchivo = fopen( $filename, "w+");
                            fwrite($nuevoarchivo,$sql);
                            fclose($nuevoarchivo);
//                            $this->_executeScriptSql($filename);
                        } catch (\Exception $exc) {
                            echo "Error ".$exc->getMessage().PHP_EOL;            
                        }
                    }
                    $kk++;
                }
            } else {
                echo "No se puede leer el archivo".PHP_EOL;
            }               
            
            exit();
    }  
     * 
     */
}