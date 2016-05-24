<?php
namespace Epass\Service;
use Zend\ServiceManager\ServiceLocatorInterface;          

class TransactionService  
{  
    private $_sl = null;
    private $_transactionModel = null;
    
    public function __construct(ServiceLocatorInterface $serviceLocator) {
        $this->_sl = $serviceLocator;
        $this->_transactionModel = $this->_sl->get('TransactionsModel');
    }
    
    /**
     * 
     * @return \Epass\Model\TransactionsTable;
     */
    private function _getTransactionModel() 
    {
        return $this->_transactionModel;
    }
    
    /**
     * 
     * @return \Application\Service\MpeService
     */
    protected function _getMpeService()
    {
        return $this->_sl->get('Application\Service\MpeService');
    }
    
    /**
     * 
     * @return \Epass\Model\Collection\WebServicesCollection
     */
    protected function _getCollectionService()
    {
        return $this->_sl->get('WebServicesCollection');
    }

    /**
     * 
     * @return \Epass\Model\UsersTable
     */
    protected function _getUserModel()
    {
        return $this->_sl->get('UsersModel');
    }

    /**
     * 
     * @return \Epass\Model\UserPlansTable
     */
    protected function _getUserPlansModel()
    {
        return $this->_sl->get('UserPlansModel');
    }    
    
    /**
     * 
     * @return \Epass\Model\VehiclesTable
     */
    protected function _getVehiclesModel()
    {
        return $this->_sl->get('VehiclesModel');
    }     
        
   
    public function reprocess() 
    {
        $dataNotMigrated = $this->_getTransactionModel()->getAllNotMigrated();
      
        foreach ($dataNotMigrated as $data) {
            if ($data['transaction_type_id'] == 2) {
                $this->_migrateRecarga($data);
            } else {
                $this->_migrateAfiliacion($data);
            }
        }        
    }
    
    public function _migrateRecarga($params)
    {
        try {
            $data=$this->filterFields($params);
            $datosEstaticos = array('req_Source' => 'portal-web');
            $datosws = array_merge($data, $datosEstaticos);

            /* ============================= */
            $response = $this-> _getMpeService()->rechargePrepayAccount($datosws);
            if ($response->status == 'ok') {
                $this->_getTransactionModel()->save(array('id' => $params['transaction_id'], 'migrate' => 1));
            }
            
            $this->_getMpeService()->RemoveCacheGetSaldoByAccount($params['req_AccountId']);

            $this->_getMpeService()->RemoveCacheMovementsByAccount($params['req_AccountId']);
            
            
            $datos = [
                'Services'  => 'soloRecarga',
                'idUser'    => $params['user_id'],
                'data'      => $datosws,
                'status'    => $response->status,
                'message'   => $response->message,
                'fecha'=> date('d-m-Y H:i:s')
            ];
            var_dump($datos);
            $this->_getCollectionService()->saveWebServicesLog($datos);
        
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }
    
    private function filterFields($data){
        $datos = array("req_AccountId","req_Amount","req_Date","req_InternalId",
        "req_ExternalId","req_Type","req_Source");
        $rpta=array();
        foreach ($datos as $key) {
            $rpta[$key]=$data[$key];
        }
        return $rpta;
    }
    
    private function _migrateAfiliacion($params) 
    {
        try{
            if (!$params['req_AccountId']) {
                $accountId = $this->_migrateAccount($params);
            } else {
                $accountId =  $params['req_AccountId'];
            }        

            if ($params['user_plan_migrate'] != 1) {
                $this->_migratePlan($params, $accountId);
            }
            $this->_migrateVehicles($params['user_plan_id'], $accountId);
            $this->_getTransactionModel()->save(array('id' => $params['transaction_id'], 'migrate' => 1));  
            
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        
    }
    
    private function _migrateAccount($params) 
    {
        $result = false;
        

        if ($params['req_Individual'] == \Epass\Model\UserPlansTable::INDIVIDUAL_YES) {            
            unset($params['req_BillingDocNumber']);
            unset($params['req_BillingDesignation']);
            unset($params['req_BillingStreet']);
            unset($params['req_BillingReferencia']);
            unset($params['req_BillingCodeDistrito']);
            unset($params['req_BillingCodeProvincia']);
            unset($params['req_BillingCodeDepartamento']);
            
            $params['req_Individual'] = true;
        } else {
            $params['req_Individual'] = false;
        }

        $response = $this-> _getMpeService()->requestAccountCreation($params);
        
        if ($response->status === 'ok') {                    
            
            //actualizar users and user_plan
            $this->_getUserModel()->saveUser(array('id' => $params['user_id'], 'migrate' => 1));                      
            $this->_getUserPlansModel()->saveUserPlans(array('id' => $params['user_plan_id'], 'account_id' => $response->data->AccountId)); 
            
            $result = $response->data->AccountId;      
        }         
        //guardar log en la collection  
        $datos = [
            'Services'  => 'requestAccountCreation',
            'idUser'    => $params['user_id'],
            'data'      => $params,
            'status'    => $response->status,
            'message'   => $response->message,
        ];
        var_dump($datos);
        $this->_getCollectionService()->saveWebServicesLog($datos);

        return $result;
    }
    
    private function _migratePlan($params, $accountId)
    {
        $result = false;
        $idUserPlan = $params['user_plan_id'];
        $params['req_AccountId'] = $accountId;
        $response = $this-> _getMpeService()->subscribePlan($params);

        if ($response->status === 'ok') {

            $this->_getUserPlansModel()->saveUserPlans(array('id' => $idUserPlan, 'migrate' => 1));
            $result = $this->_crearPromotionMPE($params, $idUserPlan);
        } 
        $datos = [
            'Services' => 'subscribePlan',
            'idUserPlan' => $idUserPlan,
            'data' => $params,
            'status' => $response->status,
            'message' => $response->message,
        ];
        var_dump($datos);
        $this->_getCollectionService()->saveWebServicesLog($datos);

        return $result;
    }
    
    private function _crearPromotionMPE($params, $idUserPlan)
    {
        $result = false;
        $paramsAllPromotions = array(
            'req_ProductId' => 1,
            'req_PlanId' => $params['req_PlanId']
        );

        $response = $this-> _getMpeService()->getAllPromotionsByPlanByProduct($paramsAllPromotions);
        if ($response->status === 'ok') {
            $promo = $response->data->allPromotionsByPlanByProductDefinition;
            foreach ($promo as $value) {
                $paramsPromotion = array(
                    'req_AccountId' => $params['req_AccountId'],
                    'req_PromotionId' => $value->req_PromotionId
                );
                $this-> _getMpeService()->subscribePromotion($paramsPromotion);
            }
            $result =  true;
        } 
        
        $datos = [
            'Services' => 'getAllPromotionsByPlanByProduct',
            'idUserPlan' => $idUserPlan,
            'data' => $params,
            'status' => $response->status,
            'message' => $response->message,
        ];
        var_dump($datos);
        $this->_getCollectionService()->saveWebServicesLog($datos);        

    }    
    
    private function _migrateVehicles($idUserPlan, $accountId)
    {
 
        $vehicles = $this->_getVehiclesModel()->getVehiclesByIdUserPlan($idUserPlan);
        
        foreach ($vehicles as $vehicle) {
   
            $vehicleMigrate = [
                'idVehicle'     => $vehicle['id'],
                'req_AccountId' => $accountId,
                'req_VehClass'  => $vehicle['type'],
                'req_Plate'     => $vehicle['license_plate'],
                'req_Make'      => $this->_getVehiclesModel()->getVehicleBrandById($vehicle['type'],$vehicle['brand']),
                'req_Model'     => $this->_getVehiclesModel()->getVechicleModelById($vehicle['type'],$vehicle['brand'],$vehicle['model']),
                'req_Colour'    => $vehicle['color'],                  
            ];

            $response = $this-> _getMpeService()->addVehicle($vehicleMigrate);

            if ($response->status === 'ok') {
                $this->_getVehiclesModel()->saveVehicle(array('id' => $vehicle['id'], 'migrate' => 1));
            } 
            //guardar en la collection de errores
            $datos = [
                'Services' => 'addVehicle',
                'data' => $vehicleMigrate,
                'status' => $response->status,
                'message' => $response->message,
            ];
            var_dump($datos);
            $this->_getCollectionService()->saveWebServicesLog($datos);
        }
    }
    
}