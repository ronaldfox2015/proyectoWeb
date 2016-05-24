<?php
namespace Cron\Service;
use Zend\ServiceManager\ServiceLocatorInterface;          

class CuentaImportService  
{  
    private $_sl = null;
    
    public function __construct(ServiceLocatorInterface $serviceLocator) {
        $this->_sl = $serviceLocator;
    }   
    

    /**
     * 
     * @return \Epass\Service\EmailService
     */
    protected function _getEmailService()
    {
       return $this->_sl->get('EmailService') ;
    }
    
    /* 
     * @return \Application\Service\CuentaService
     */
    protected function _getCuentaService()
    {
        return $this->_sl->get('Application\Service\CuentaService');
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
     * @return \Epass\Service\FtpService
     */
    protected function _getFtpService()
    {
       return $this->_sl->get('FtpService') ;
    }

    private function _user($account, &$emailActivacion) 
    {

        $usersModel = $this->_sl->get('UsersModel');
        $user = $usersModel->getUsersByCorreo((string) $account->Email);
        $emailActivacion = false;
        
        $data = [
            'name' => (string) $account->Forename,
            'lastname' => (string) $account->Surname,
            'fullname' => (string) $account->Designation,
            'migrate' => 1,
            'role_id' => \Epass\Model\RolesTable::USUARIO,
            'enable' => 1
        ];
        
        if (!$user) {
            $data['email'] = (string) $account->Email;
            $data['terms_check'] = 1;
            $data['news_check'] = 0;
            $data['ismigrate'] = 1;
            $data['email_check'] = 1;
            $user_id = $usersModel->saveUser($data);
            
            $emailActivacion = true;
            
        } else {    
            if ($user['role_id'] == \Epass\Model\RolesTable::RECARGA) {
                $data['ismigrate'] = 1;
                $emailActivacion = true;
            }            
            $data['id'] = $user['id'];
            $usersModel->saveUser($data);
            
            $user_id = $user['id'];
        }

        return $user_id;
    }

    private function _plan($account, $user_id) {
        $id = null;
        $userPlansModel = $this->_sl->get('UserPlansModel');
        $ALinkedListTable = $this->_sl->get('Epass\Model\ALinkedListTable');
        
        $ubigeo =  $ALinkedListTable->getUbigeoBxCodeWS((string)$account->Address->Departamento, (string)$account->Address->Provincia, (string)$account->Address->Distrito);
        
        $plan = $userPlansModel->getByAccount((string) $account->AccountNum);
        
        $dataPlan = [
            'user_id'                   => $user_id,
            'razon_social'              => (string) $account->Designation,
            'individual'                => (string) $account->Individual, //crear campo
            'created_at'                => date("Y-m-d H:i:s", strtotime((string) $account->CreationTime)),
            'document_type_id'          => (string) $account->DocType,
            'document_number'           => (string) $account->DocNumber,
            'contact'                   => (string) $account->Contact, //crear campo
            'address'                   => (string) $account->Address->Street,
            'district_id'               => $ubigeo['dist'],
            'province_id'               => $ubigeo['prov'],
            'department_id'             => $ubigeo['dep'],
            'observations'              => (string) $account->Address->Referencia,
            'telephone'                 => (string) $account->DayPhone,
            'additional_phone'          => (string) $account->EveningPhone,
            'billing_receipt_type'      => (string) $account->Billing->ReceiptType, //crear campo
            'billing_doc_number'        => (string) $account->Billing->BillingNumDoc,
            'billing_designation'       => (string) $account->Billing->BillingDesignation,
            'billing_street'            => (string) $account->Billing->BillingAddress,
            'billing_code_distrito'     => $ubigeo['dist'],
            'billing_code_provincia'    => $ubigeo['prov'],
            'billing_code_departamento' => $ubigeo['dep'],
            'plan_id'                   => (string) $account->Plans->Plan->PlanId,
            'plan_name'                 => (string) $account->Plans->Plan->PlanName,
        ]; 
        if (!$plan) {
            $dataPlan['account_id'] = (string) $account->AccountNum;            
            $dataPlan['enable'] = 1;
            $dataPlan['migrate'] = 1;    
        } else {
            $dataPlan['id'] = $plan['id'];        
        }

        $id = $userPlansModel->saveUserPlans($dataPlan);
        
        return $id;
    }
    
    public function import() 
    { 
        $log[] = '--- Importar Transitos FTP ---' . PHP_EOL;
        $error = array();
        
        $config = $this->_sl->get('config'); 
        $ftpService = $this->_getFtpService();        
        $ftpService->setConfig($config['ftp-transacciones']);        
        
        $importService = $this->_sl->get('ImportModel');
        if (!file_exists($config['ftp-transacciones']['fileLocal'])) {
            mkdir($config['ftp-transacciones']['fileLocal'], 0777, true);
        }
     
        $ftpService->connect();

        $result = $importService->getLast();
        $archivos = $ftpService->getFiles($result, $config['ftp-transacciones']['fileServer']  . 'Accounts');
     
        //$archivos = $importService->getNotImport($archivos);
        
         if (is_array($archivos) && count($archivos)) {
                foreach ($archivos as $fileServer) {
                    $partes_ruta = pathinfo($fileServer);
                    
                    $filename = $partes_ruta['basename'];
                    $fileLocal = $config['ftp-transacciones']['fileLocal'].$filename;
                    
                    if ($partes_ruta['extension'] == 'xml') {
                        $log[] = "Descargando archivo FTP $fileServer" . PHP_EOL;
                        if ($ftpService->getFileSize($fileServer)) {
                            
                            if ($ftpService->getFile($fileServer, $fileLocal)) {
                                
                                $previous = libxml_use_internal_errors(true);         
                                $content = utf8_encode(file_get_contents($fileLocal));                                 
                                $content = str_replace(array("&amp;", "&"), array("&", "&amp;"), $content);
                                $xml = simplexml_load_string($content);
                                libxml_use_internal_errors($previous);
                                if($xml === false) {
                                     $log[]  = "No se puede leer el archivo xml, Error en codificacion.";
                                     $ftpService->moveFile($fileServer, $config['ftp-transacciones']['fileServer'] .'Accounts_error/'. $filename );
                                } else {
                                    $db = $this->_sl->get('adapter');
                                    $con = $db->getDriver()->getConnection();
                                    $con->beginTransaction();
                                    try{
                                        $log[] = "Se descargo correctamente el archivo: {$filename}..." . PHP_EOL;

                                        $log[] = $this->_cuentaDiaria($xml);

                                        $result = $importService->save(array('type' => 'ACCO', 'version' => $fileServer));
                                        $con->commit();
                                        
                                        $ftpService->moveFile($fileServer, $config['ftp-transacciones']['fileServer']  . 'Accounts_process/'. $filename );
                                    } catch (\Exception $e) {
                                        $con->rollback();
                                        $error[] = $e->getMessage();
                                    }  
                                }
                            } else {
                                $error[] = "No se pudo descargar el archivo $filename" . PHP_EOL;
                            }
                        } else {
                            $error[] = "El archivo esta vacio $filename" . PHP_EOL;
                            $ftpService->moveFile($fileServer, $config['ftp-transacciones']['fileServer'] . 'Accounts_error/'. $filename );              
                        }
                        
                    } else {
                        $error[] = "Archivo no valido:$filename" . PHP_EOL;
                    }
     
                }
                
         } 
        
        $this->_getCronLogCollection()->save(array('data' => $log, 'error' => $error, 'type' => 'account'));
        echo implode('<br>', $log);
        echo implode('<br>', $error);
        
        $this->_sendMailError($error);
        
        exit;
        
    }
    
    private function _sendMailError($error) 
    {        
        if (!empty($error)) {
            $config = $this->_sl->get('config');
            if (isset($config['mail']['exception_notification']['enabled']) && isset($config['mail']['exception_notification']['enabled']) == true) {
                $this->_getEmailService()->enviarMailExceptionNoTemplate('Error: Cron Importar cuentas', $config['mail']['exception_notification']['emails'], implode('<br>', $error));
            }                
        }
    }
    
    private function _cuentaDiaria($xml)
    { 

        $count = count($xml);

        foreach ($xml as $account) {
            if (!empty((string) $account->Email)) {
                $user_id = $this->_user($account, $emailActivacion);
                $id_users_plan = $this->_plan($account, $user_id);

                $userPlansModel = $this->_sl->get('UserPlansModel');
                $userPlansModel->setRemovePlansbyUserFormCache($id_users_plan);
                if ($emailActivacion) {
                    $this->_getCuentaService()->sendMessageRecoverPassword($user_id); 
                }
                echo '<hr>';
            }
        }
        return "Procesado: " . $count . "registros <br>";
        
    }
    
    /*
    private function _executeScriptSql($file) 
    {
        $config = $this->_sl->get('config');
        $configDb = $config['db']['adapters']['adapter'];

        $command = sprintf('mysql -h %s -u %s -p%s "%s" < "%s"',
                        escapeshellcmd($configDb['host']),
                        escapeshellcmd($configDb['username']),
                        escapeshellcmd($configDb['password']),
                        escapeshellcmd($configDb['dbname']),
                        escapeshellcmd($file)
        );

        exec($command,$output=array(),$worked);
    }
    
    public function migrarCuentasInicialAction() {
      
        $config = $this->_sl->get('config');  
            
        $this->_executeScriptSql($config['ftp-transacciones']['fileLocal'] . 'cuentas-inicial-temp.sql');
        $this->_executeScriptSql($config['ftp-transacciones']['fileLocal'] . 'cuentas-inicial-carga.sql');
        exit;
    }    
     * 
     */
   
}