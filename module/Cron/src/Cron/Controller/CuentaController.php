<?php

namespace Cron\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Request as ConsoleRequest;
use Zend\Mvc\MvcEvent;
use Zend\Db\Sql\Sql;

class CuentaController extends AbstractActionController {

    public function onDispatch(MvcEvent $e)
    {
//        if (!$this->getRequest() instanceof ConsoleRequest) {
//            throw new \RuntimeException('You can only use this action from a console!');
//        }

        return parent::onDispatch($e);
    }
    
    /* 
     * @return \Epass\Model\Collection\CronLogCollection
     */
    protected function _getCronLogCollection()
    {
        return $this->getServiceLocator()->get('CronLogCollection');
    }    
    
    /* 
     * @return \Cron\Service\CuentaImportService
     */
    protected function _getCuentaImportService()
    {
        return $this->getServiceLocator()->get('Cron\Service\CuentaImportService');
    }    
    
    public function importAction() 
    { 
        $this->_getCuentaImportService()->import();
        
        exit;        
    }    
    
    public function emailNuevasAfiliacionesAction() 
    {
        $config = $this->getServiceLocator()->get('config');
        $dbAdapter = $this->getServiceLocator()->get('adapter');
        $date = date('Y/m/d');
        $date_yesterday = date('d/m/Y', strtotime('-1 day', strtotime($date)));
        $sql = "
                SELECT 
                        -- tt.name AS TipoProceso,
                        -- pm.name AS MedioPago,
                        up.account_id,
                        u.email AS email,
                        IF(up.individual='N',up.razon_social,CONCAT_WS(' ',u.name,u.lastname)) AS 'nombre_razonsocial',
                        IF(up.flagDelivery=1,'Delivery','Recojo de punto de Venta') AS 'tipo_entrega',
                        up.address AS direccion,
                        -- up.observations AS referencia,
                        v.license_plate AS placa
                        -- up.billing_receipt_type AS tipo_documento
                FROM 
                        transactions t
                        INNER JOIN user_plans up 		ON t.user_plan_id=up.id
                        INNER JOIN users u 			ON up.user_id=u.id
                        INNER JOIN payment_methods pm 		ON t.payment_method_id=pm.id
                        INNER JOIN transaction_types tt 	ON t.transaction_type_id=tt.id
                        INNER JOIN user_plan_vehicle AS upv 	ON upv.user_plan_id=up.id
                        INNER JOIN vehicles AS v 		ON upv.vehicle_id=v.id
                WHERE 
                        t.status=3 
                        AND t.transaction_type_id=1 
                        AND t.created_at BETWEEN STR_TO_DATE('$date_yesterday 00:00:00', '%d/%m/%Y %H:%i:%s') AND STR_TO_DATE('$date_yesterday 23:59:59', '%d/%m/%Y %H:%i:%s')
                ORDER BY account_id, email, nombre_razonsocial;
            ";

        $statement = $dbAdapter->query($sql);
        $results = $statement->execute();        
        $data = array(
            'afiliaciones'  => $results,
            'fecha'         => $date_yesterday
        );
        
        $resultado = $this->_sendMessage('Nuevas Afiliaciones', 'nuevasafiliaciones.phtml', $config['mail']['toEmailNewAfiliation'], $data);
        if($resultado){
           $nuevas_afiliaciones = count($results);
           $this->_getCronLogCollection()->save(array('data' => "Email enviado con $nuevas_afiliaciones nuevas afiliaciones para el $date_yesterday", 'type' => 'Email nuevas afiliaciones'));
        }
        
    }

    private function _sendMessage($asunto, $plantilla, $email, $datos = NULL){
        try {
            $dataMail = array(
                'asunto'   => $asunto,
                'email' => $email,
                'tipo' => \Epass\Enum\EmailType::WITH_TEMPLATE,
                'template' => EMAIL_PATH.$plantilla,
                'data' => $datos,
            );
            $response = $this->getEventManager()->trigger(\Epass\Event\Listener::MAIL_EVENT, $this, $dataMail);
            return $response[0];
        } catch (Exception $e) {
            return false;
        }
    }
}
