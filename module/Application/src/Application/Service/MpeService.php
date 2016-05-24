<?php

/**
 * This service caches data by setting a time limit
 *
 * @author Martin Cruz <i@martincruz.me>
 */

namespace Application\Service;

use stdClass;
use Zend\Soap\Client;
use Zend\Soap\Exception\Exception;

class MpeService
{

    const PRODUCT_ID = 1;
    const getmovementsbyaccount = 'getMovementsByAccount';
    const getSaldoByAccount = 'getSaldoByAccount';

    /**
     * @var array
     */
    protected $config;

    /**
     * @var \Zend\Soap\Client
     */
    protected $client;

    /**
     * @var \Application\Service\MemcachedService
     */
    protected $memcached;

    /**
     * Constructor
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $this->config = $config;
        $this->client = new Client($config['url']);
        $this->client->setLocation($config['location']);

    }

    /**
     * Create account
     *
     * @param array $params
     * @return object
     */
    public function requestAccountCreation($params)
    {
        $keys = ['req_CrmTicket', 'req_RucNumber', 'req_DocType', 'req_DocNumber', 'req_Individual', 'req_Title',
            'req_Forename', 'req_Surname', 'req_Designation', 'req_Contact', 'req_Street', 'req_Referencia',
            'req_CodeDistrito', 'req_CodeProvincia', 'req_CodeDepartamento', 'req_PhoneNum',
            'req_PhoneNumMobile', 'req_PhoneNumWork', 'req_Email', 'req_ReceiptType'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $obj = $this->client->requestAccountCreation($params);
                $response->message = $obj->res->AccountEditStatus;

                if ($obj->res->AccountEditStatus == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                }

                return $response;
            } catch (\SoapFault $e) {
                $response = new stdClass();
                $response->code = $e->getCode();
                $response->status = 'error';
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * @param array $params
     * @return object
     */
    public function getAccountData($params)
    {
        $keys = ['req_AccountId'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $cacheId = $this->memcached->keyGenerate(__FUNCTION__,
                        $params['req_AccountId']);

                if ($this->memcached->hasItem($cacheId)) {
                    $obj = $this->memcached->getItem($cacheId);
                } else {
                    $obj = $this->client->getAccountData($params);
                    $this->memcached->setItem($cacheId, $obj, 1); // 1 minute
                }


                if ($obj->res->accountDataStatus == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res->accountDataDefinition;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res->accountDataStatus;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * @param array $params
     * @param boolean $isUpdate
     * @return object
     */
    public function getMembersByAccount($params, $isUpdate = FALSE)
    {
        $keys = ['req_AccountId'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $cacheId = $this->memcached->keyGenerate(__FUNCTION__,
                        $params['req_AccountId']);

                if ($this->memcached->hasItem($cacheId) && $isUpdate == FALSE) {
                    $obj = $this->memcached->getItem($cacheId);
                } else {
                    $obj = $this->client->getMembersByAccount($params);
                    $this->memcached->setItem($cacheId, $obj, 300); // 5 minutes
                }

                if ($obj->res->membersByAccountStatus == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res->membersByAccountDefinition;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res->membersByAccountStatus;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * @param array $params
     * @return object
     */
    public function subscribePlan($params)
    {
        $keys = ['req_AccountId', 'req_PlanId'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $obj = $this->client->subscribePlan($params);

                if ($obj->res == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';                    
                }
                $response->message =  $obj->res;

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();
                $response->status = 'error';

                return $response;
            }
        }

    }

    /**
     * @param array $params
     * @return object
     */
    public function unsubscribePlan($params)
    {
        $keys = ['req_AccountId', 'req_PlanId'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $obj = $this->client->unsubscribePlan($params);

                if ($obj->res == 'OK') {
                    $response->status = 'ok';
                    $response->data = $response->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * @param array $params
     * @return object
     */
    public function subscribePromotion($params)
    {
        $keys = ['req_AccountId', 'req_PromotionId'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $obj = $this->client->subscribePromotion($params);

                if ($obj->res == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();
                $response->status = 'error';

                return $response;
            }
        }

    }

    /**
     * @param array $params
     * @return object
     */
    public function unsubscribePromotion($params)
    {
        $keys = ['req_AccountId', 'req_PromotionId'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $obj = $this->client->unsubscribePromotion($params);

                if ($obj->res == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * Add vehicle to user
     *
     * @param array $params
     * @return mixed
     */
    public function addVehicle($params = array())
    {
        $keys = ['req_AccountId', 'req_VehClass', 'req_Plate', 'req_Make', 'req_Model'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $obj = $this->client->addVehicle($params);

                if ($obj->res->EditVehicleStatus == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';                    
                }
                $response->message = $obj->res->EditVehicleStatus;

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();
                $response->status = 'error';

                return $response;
            }
        }

    }

    /**
     * @param array $params
     * @return string
     */
    public function getAllPlansByProduct($params)
    {
        $keys = ['req_ProductId'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $cacheId = $this->memcached->keyGenerate(__FUNCTION__,
                        $params['req_ProductId']);

                if ($this->memcached->hasItem($cacheId)) {
                    $obj = $this->memcached->getItem($cacheId);
                } else {
                    $obj = $this->client->getAllPlansByProduct($params);
                    $this->memcached->setItem($cacheId, $obj, 60);  // 1 minute
                }

                if ($obj->res->allPlansByProductStatus == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res->allPlansByProductStatus;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * @param array $params
     * @return object
     */
    public function getAllPromotionsByPlanByProduct($params)
    {
        $keys = ['req_ProductId', 'req_PlanId'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $uniqueKey = strval($params['req_PlanId']) + strval($params['req_PlanId']);
                $cacheId = $this->memcached->keyGenerate(__FUNCTION__,
                        $uniqueKey);

                if ($this->memcached->hasItem($cacheId)) {
                    $obj = $this->memcached->getItem($cacheId);
                } else {
                    $obj = $this->client->getAllPromotionsByPlanByProduct($params);
                    $this->memcached->setItem($cacheId, $obj, 3600);  // 1 minute
                }

                if ($obj->res->allPromotionsByPlanByProductStatus == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else if ($obj->res->allPromotionsByPlanByProductStatus == 'NoActivePromotions') {
                    $response->status = 'fail';
                    $response->data = [];
                }
                $response->message = $obj->res->allPromotionsByPlanByProductStatus;

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();
                $response->status = 'error';

                return $response;
            }
        }

    }

    /**
     * @param array $params
     * @return object
     */
    public function attachDocumentToAccount($params)
    {
        $keys = ['req_AccountId', 'req_Filename', 'req_Description', 'req_md5', 'req_size'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $obj = $this->client->attachDocumentToAccount($params);

                if ($obj->res == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * @param $params
     * @return object
     */
    public function autoRechargeAffiliation($params)
    {
        $keys = ['req_AccountId', 'req_Operation', 'req_Entity', 'req_AccountNumber', 'req_AccountType',
            'req_CardNumber', 'req_ExpiryMonth', 'req_ExpiryYear', 'req_RechargeDay', 'req_RechargeAmount'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $obj = $this->client->autoRechargeAffiliation($params);

                if ($obj->res == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * @param array $params
     * @return object
     */
    public function dropVehicle($params = array())
    {
        $keys = ['req_AccountId', 'req_VehicleId'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $obj = $this->client->dropVehicle($params);

                if ($obj->res == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * @param $params
     * @return object
     */
    public function getBillingPeriodByAccount($params)
    {
        $keys = ['req_AccountId'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $cacheId = $this->memcached->keyGenerate(__FUNCTION__,
                        $params['req_AccountId']);

                if ($this->memcached->hasItem($cacheId)) {
                    $obj = $this->memcached->getItem($cacheId);
                } else {
                    $obj = $this->client->getBillingPeriodByAccount($params);
                    $this->memcached->setItem($cacheId, $obj, 300);  // 5 minutes
                }


                if ($obj->res->billingPeriodByAccountStatus == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res->billingPeriodByAccountStatus;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * @param array $params
     * @return object
     */
    public function getPlansByAccount($params)
    {
        $keys = ['req_AccountId'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $cacheId = $this->memcached->keyGenerate(__FUNCTION__,
                        $params['req_AccountId']);

                if ($this->memcached->hasItem($cacheId)) {
                    $obj = $this->memcached->getItem($cacheId);
                } else {
                    $obj = $this->client->getPlansByAccount($params);
                    $this->memcached->setItem($cacheId, $obj, 180);  // 3 minutes
                }

                if ($obj->res->plansByAccountStatus == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res->plansByAccountStatus;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * @param $params
     * @return object
     */
    public function getSaldoByAccount($params)
    {
        $keys = ['req_AccountId'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $cacheId = $this->memcached->keyGenerate(__FUNCTION__,
                        $params['req_AccountId']);

                if ($this->memcached->hasItem($cacheId)) {
                    $obj = $this->memcached->getItem($cacheId);
                } else {
                    $obj = $this->client->getSaldoByAccount($params);
                    $this->memcached->setItem($cacheId, $obj, 60);  // 1 minute
                }


                if ($obj->res->saldoByAccountStatus == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res->saldoByAccountStatus;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * 
     * @param type $id
     */
    public function RemoveCacheGetSaldoByAccount($id)
    {
        $cacheId = $this->memcached->keyGenerate(self::getSaldoByAccount, $id);
        if ($this->memcached->getItem($cacheId))
            $this->memcached->removecache($cacheId);

    }

    /**
     * 
     * @param type $id
     */
    public function flush()
    {

        $this->memcached->flush();

    }

    /**
     * Validate vehicle tag
     *
     * @param array $params
     * @return object
     */
    public function getValidateTagPlate($params)
    {
        $keys = ['req_TagPlate'];
        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $cacheId = $this->memcached->keyGenerate(__FUNCTION__,
                        $params['req_TagPlate']);

                if ($this->memcached->hasItem($cacheId)) {
                    $obj = $this->memcached->getItem($cacheId);
                } else {
                    $obj = $this->client->getValidateTagPlate($params);
                    $this->memcached->setItem($cacheId, $obj, 300);  // 5 minutes
                }

                if ($obj->res->validateTagPlateStatus == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res->validateTagPlateStatus;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * @param array $params
     * @return object
     */
    public function modifyAccountData($params = array())
    {
        $keys = ['req_AccountId', 'req_RucNumber', 'req_DocType', 'req_DocNumber', 'req_Individual',
            'req_Title', 'req_Forename', 'req_Surname', 'req_Designation', 'req_Contact', 'req_Street',
            'req_Referencia', 'req_CodeDistrito', 'req_CodeProvincia', 'req_CodeDepartamento', 'req_PhoneNum',
            'req_PhoneNumMobile', 'req_PhoneNumWork', 'req_Email', 'req_ReceiptType'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $obj = $this->client->modifyAccountData($params);

                if ($obj->res == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * @param array $params
     * @return object
     */
    public function modifyVehicleData($params)
    {
        $keys = ['req_AccountId', 'req_VehicleId', 'req_VehClass', 'req_Plate', 'req_Make', 'req_Model', 'req_Colour'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $obj = $this->client->modifyVehicleData($params);

                if ($obj->res == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * @param array $params
     * @return object
     */
    public function rechargePrepayAccount($params)
    {
        $keys = ['req_AccountId', 'req_Amount', 'req_Date', 'req_InternalId', 'req_ExternalId', 'req_Type', 'req_Source'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $obj = $this->client->rechargePrepayAccount($params);

                if ($obj->res == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';                   
                }
                $response->message = $obj->res;

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();
                $response->status = 'error';

                return $response;
            }
        }

    }

    /**
     * @param array $params
     * @return object
     */
    public function rechargePrepayAndRequestTagAccount($params)
    {
        $keys = ['req_AccountId', 'req_RechargePrepayAmount', 'req_Date', 'req_RequestTag_List',
            'req_CrmTicket', 'req_InternalId', 'req_ExternalId', 'req_Type', 'req_Source',
            'req_BillingDocNumber', 'req_BillingDesignation'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $obj = $this->client->rechargePrepayAndRequestTagAccount($params);

                if ($obj->res == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * @param $params
     * @return object
     */
    public function getMovementsByAccount($params)
    {
        $keys = ['req_AccountId', 'req_StartDate', 'req_EndDate'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $cacheId = $this->memcached->keyGenerate(__FUNCTION__,
                        $params['req_AccountId']);
                if ($this->memcached->hasItem($cacheId)) {
                    $obj = $this->memcached->getItem($cacheId);
                } else {
                    $ordenado=array();
                    $obj = $this->client->getMovementsByAccount($params);
                    if ($obj->res->movementsByAccountStatus == 'OK') {
                        $ordenado = $this->record_sort($obj->res->movementsByAccountDefinition,
                                'req_Time', true);
                    }
                   

                    $obj->res->movementsByAccountDefinition = $ordenado;
                    $this->memcached->setItem($cacheId, $obj, 60);  // 2 minutes
                }
                if ($obj->res->movementsByAccountStatus == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res->movementsByAccountStatus;
                }
                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    protected function sortMovements($array)
    {
        $movimientos = [];
        $total = count($array);
        for ($i = $total - 1; $i >= 0; $i--) {
            $movimientos[] = $array[$i];
        }
        return $movimientos;

    }

    /**
     * @param $params
     * @return stdClass
     */
    public function getTransits($params)
    {
        $keys = ['req_StartDate', 'req_EndDate'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $obj = $this->client->getTransits($params);

                if ($obj->res == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    /**
     * @param $params
     * @return stdClass
     */
    public function getPlateAvailable($params)
    {
        $keys = ['req_Plate'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $obj = $this->client->getPlateAvailable($params);

                if ($obj->res == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

    public function RemoveCacheMovementsByAccount($id)
    {
        $cacheId = $this->memcached->keyGenerate(self::getmovementsbyaccount,
                $id);
        if ($this->memcached->getItem($cacheId))
            $this->memcached->removecache($cacheId);

    }

    /**
     * @param array $keys
     * @param array $params
     * @return bool
     */
    private function validate($keys, $params)
    {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $params)) {
                throw new \RuntimeException('Parameter ' . $key . ' is required');
                return false;
            }
        }

        return true;

    }

    /**
     * @return MemcachedService
     */
    public function getMemcached()
    {
        return $this->memcached;

    }

    /**
     * @param MemcachedService $memcached
     */
    public function setMemcached($memcached)
    {
        $this->memcached = $memcached;

    }

    /**
     * Obtiene los paquetes de afiliacion para los planes individual, familiar, corporativo
     *
     * @param array $types
     * @return array
     */
    public function getPaquetesAfiliacion($types = [], $isCalledInDashboard = false)
    {
        $paquetes = $this->getPaquetesRecarga($types, $isCalledInDashboard);

//        if (isset($paquetes['corporativo'])) {
//            foreach ($paquetes['corporativo'] as $paquete) {
//                if ($paquete->costoTotalConTag > 450) {
//                    $descuento = 5;
//                    $paquete->costoPromocionalTag = $paquete->costoPromocionalTag - $descuento;
//                    $paquete->costoTotalConTag = $paquete->costoTotalConTag - $descuento;
//                    $paquete->costoTotal = $paquete->costoTotal - $descuento;
//                }
//            }
//        }

        return $paquetes;

    }

    /**
     * Obtiene los paquetes de recarga para los planes individual, familiar, corporativo
     *
     * @param array $types
     * @return array
     */
    public function getPaquetesRecarga($types = [], $isCalledInDashboard = false)
    {
        $selectedPlanes = $this->getAllPlansWithPromotions($isCalledInDashboard);
        $packages = array();
        // Set packages
        if (in_array('individual', $types)) {
            $packages['individual'] = $this->getPeoplePackages($selectedPlanes,
                    $isCalledInDashboard);
        }

        if (in_array('familiar', $types)) {
            $packages['familiar'] = $this->getFamilyPackages($selectedPlanes);
        }

        if (in_array('corporativo', $types)) {
            $packages['corporativo'] = $this->getCorporatePackages($selectedPlanes);
        }

        return $packages;

    }

    /**
     * @param $planes
     * @return array
     */
    private function getPeoplePackages($planes, $isCalledInDashboard = false)
    {
        $packages = array();

        foreach ($planes as $plan) {
            $name = strtolower($plan->req_Name);
            $flag = (preg_match('/individual 2/', $name) && $isCalledInDashboard) ? true : false;
            if (preg_match('/individual 1/', $name) || $flag) {
                $packages = array_merge($packages,
                        $this->getPackagesExists($plan, $plan->promotions,
                                $isCalledInDashboard));
            }
        }

        return $packages;

    }

    /**
     * @param $planes
     * @return array
     */
    private function getFamilyPackages($planes)
    {
        $packages = array();
        foreach ($planes as $plan) {
            $name = strtolower($plan->req_Name);
            if (preg_match('/familiar 1/', $name)) {
                $packages = $this->getPackagesExists($plan, $plan->promotions);
                break;
                //$newPackage = $this->getPackagesExists($plan, $plan->promotions);
                //$packages = array_merge($packages, $newPackage);
            }
        }

        return $packages;

    }

    /**
     * @param array $planes
     * @return array
     */
    private function getCorporatePackages($planes)
    {
        $packages = array();
        foreach ($planes as $plan) {
            $name = strtolower($plan->req_Name);

            if (preg_match('/corporativo/', $name)) {
                $promotions = $plan->promotions;
                $recargas = [];
                $tagPromotions = [];
                $costoFijoTag = $plan->req_PlanFeatures[0]->req_PlanFeatureValue / 100;

                foreach ($promotions as $promotion) {
                    $namePromotion = strtolower($promotion->req_Name);
                    if (preg_match('/recarga/', $namePromotion)) {
                        $recargas = $promotion->req_PromotionFeatures->req_PromotionFeeRecharge;
                    }
                    if (preg_match('/tag/', $namePromotion)) {
                        $tagPromotions = $promotion->req_PromotionFeatures;
                        if (!is_array($tagPromotions)) {
                            $tagPromotions = [$tagPromotions];
                        }
                    }
                }

                foreach ($recargas as $recarga) {
                    $package = new \stdClass();
                    $package->planId = $plan->req_PlanId;
                    $package->namePlan = $plan->req_Name;
                    $package->total = $recarga->req_AmountIni / 100;
                    $package->tasaRecarga = $recarga->req_Value / 100;
                    $package->saldoUso = $package->total - $package->tasaRecarga;
                    $package->maxVehiculos = $this->maxVehicles('corporativo',
                            $package->total);
                    $package->costoFijoTag = $costoFijoTag;

                    $package->costoPromocionalTag = 0;
                    $package->costoTotalConTag = $package->total + $costoFijoTag;

                    foreach ($tagPromotions as $tagPromotion) {
                        $name = strtolower($tagPromotion->req_PromotionFeatureDescription);
                        if (preg_match('/costo/', $name)) {
                            $package->costoPromocionalTag = $tagPromotion->req_PromotionFeatureValue / 100;
                            $package->costoTotalConTag = $package->total + $package->costoPromocionalTag;
                        }
                    }

                    $package->costoTotal = $package->costoTotalConTag;

                    array_push($packages, $package);
                }
                break;
            }
        }

        return $packages;

    }

    /**
     * @param object $plan
     * @param object $promotions
     * @return object
     */
    private function getPackagesExists($plan, $promotions, $isCalledInDashboard = false)
    {
        $packages = array();
        $rechargePromotions = [];
        $tagPromotions = [];
        $costoFijoTag = $plan->req_PlanFeatures[0]->req_PlanFeatureValue / 100;

        foreach ($promotions as $promotion) {
            $name = strtolower($promotion->req_Name);

            if (preg_match('/recarga/', $name)) {
                $rechargePromotions = $promotion->req_PromotionFeatures->req_PromotionFeeRecharge;
            }

            if (preg_match('/tag/', $name)) {
                $tagPromotions = $promotion->req_PromotionFeatures;
                if (!is_array($tagPromotions)) {
                    $tagPromotions = [$tagPromotions];
                }
            }
        }

        if (is_null($promotions))
            return $packages;

        $name = strtolower($plan->req_Name);
        $flag = (preg_match('/individual 2/', $name) && $isCalledInDashboard) ? true : false;
        if (preg_match('/individual 1/', $name) || $flag) {
            foreach ($rechargePromotions as $index => $promotion) {
//                $limit_promotion = 140;
                $package = new \stdClass();
                $package->planId = $plan->req_PlanId;
                $package->namePlan = $plan->req_Name;

                $package->total = $rechargePromotions[$index]->req_AmountIni / 100;
                $package->tasaRecarga = $rechargePromotions[$index]->req_Value / 100;
                $package->saldoUso = $package->total - $package->tasaRecarga;
                $package->maxVehiculos = $this->maxVehicles('individual 1',
                        $package->total);
                $package->costoFijoTag = $costoFijoTag;

                $package->costoPromocionalTag = 0;
                $package->costoTotalConTag = $package->total + $costoFijoTag;
                foreach ($tagPromotions as $tagPromotion) {
                    $name = strtolower($tagPromotion->req_PromotionFeatureDescription);
                    if (preg_match('/costo/', $name)) {
                        $package->costoPromocionalTag = $tagPromotion->req_PromotionFeatureValue / 100;
                        $package->costoTotalConTag = $package->total + $package->costoPromocionalTag;
                    }
                }

//                if (($limit_promotion <= $package->costoTotalConTag) && !$flag) {
//                    $package->costoPromocionalTag = 10;
//                    $package->costoTotalConTag = $package->total + $package->costoPromocionalTag;
//                    $package->saldoUso = $package->costoTotalConTag - $package->costoPromocionalTag - $package->tasaRecarga;
//                }
                $package->costoTotal = $package->costoTotalConTag;

                array_push($packages, $package);
            }
        } else if (preg_match('/familiar 1/', $name)) {
            foreach ($rechargePromotions as $index => $promotion) {
                $package = new \stdClass();
                $package->planId = $plan->req_PlanId;
                $package->namePlan = $plan->req_Name;
                $package->total = $rechargePromotions[$index]->req_AmountIni / 100;
                $package->tasaRecarga = $rechargePromotions[$index]->req_Value / 100;
                $package->saldoUso = $package->total - $package->tasaRecarga;
                $package->maxVehiculos = $this->maxVehicles('familiar 1',
                        $package->total);
                $package->costoFijoTag = $costoFijoTag;

                $package->costoPromocionalTag = 0;
                $package->costoTotalConTag = $package->total + $costoFijoTag;

                foreach ($tagPromotions as $tagPromotion) {
                    $name = strtolower($tagPromotion->req_PromotionFeatureDescription);
                    if (preg_match('/costo/', $name)) {
                        $package->costoPromocionalTag = $tagPromotion->req_PromotionFeatureValue / 100;
                        $package->costoTotalConTag = $package->total + $package->costoPromocionalTag;
                    }
                }

                $package->costoTotal = $package->costoTotalConTag;

                array_push($packages, $package);
            }
        }
        return $packages;

    }

    /**
     * Calcula el max. de vehiculos que puede tener plan familiar o corporativo
     *
     * @param string $type
     * @param float $amount
     * @return int
     */
    private function maxVehicles($type, $amount)
    {
        $config = [
            'individual 1' => [
                '35.00' => 1,
                '65.00' => 1,
                '90.00' => 1,
                '140.00' => 1,
                '190.00' => 1,
                '240.00' => 1,
            ],
            'familiar 1' => [
                '90.00' => 2,
                '140.00' => 4,
                '190.00' => 5,
                '240.00' => 6,
                '290.00' => 8,
                '340.00' => 10,
            ],
            'corporativo' => [
                '140.00' => 2,
                '240.00' => 3,
                '340.00' => 4,
                '450.00' => 5,
                '600.00' => 6,
                '800.00' => 8,
                '1,000.00' => 10,
            ]
        ];

        $amount = number_format($amount, 2);

        if (array_key_exists($type, $config) && array_key_exists($amount,
                        $config[$type])) {
            $plan = $config[$type];
            $maxVehicles = $plan[$amount];
        } else {
            $maxVehicles = 1;
        }

        return $maxVehicles;

    }

    /**
     * @return array
     */
    public function getAllPlansWithPromotions($isCalledInDashboard = false)
    {
        $result = $this->getAllPlansByProduct(['req_ProductId' => self::PRODUCT_ID]);
        $selectedPlanes = array();

        if ($result->code == 200 && $result->status == 'ok') {
            $allPlanes = $result->data->allPlansByProductDefinition;

            foreach ($allPlanes as $plan) {
                $name = strtolower($plan->req_Name);
                $flag = (strpos($name, 'individual 2') && $isCalledInDashboard) ? true : false;
                if (strpos($name, 'individual 1') || strpos($name, 'familiar 1') || strpos($name,
                                'corporativo') || $flag) {
                    $result = $this->getAllPromotionsByPlanByProduct([
                        'req_ProductId' => self::PRODUCT_ID,
                        'req_PlanId' => $plan->req_PlanId
                    ]);

                    if ($result->code == 200 && strtolower($result->message) == 'ok') {
                        $data = $result->data->allPromotionsByPlanByProductDefinition;
                        if (is_array($data)) {
                            $plan->promotions = $result->data->allPromotionsByPlanByProductDefinition;
                        } else {
                            $plan->promotions = [$data];
                        }
                    }
                    array_push($selectedPlanes, $plan);
                }
            }
        }

        return $selectedPlanes;

    }

    /**
     *
     * */
    private function record_sort($records, $field, $reverse = false)
    {
        $hash = array();

        foreach ($records as $key => $record) {
            //  $record= (array)$record;
            $hash[$record->$field . $key] = $record;
        }

        ($reverse) ? krsort($hash) : ksort($hash);

        $records = array();

        foreach ($hash as $record) {
            $records [] = $record;
        }

        return $records;

    }
    
    /**
     * @param $params
     * @return object
     */
    public function getbillingRDLByAccount($params)
    {
        $keys = ['req_AccountId', 'req_StartDate', 'req_EndDate'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $cacheId = $this->memcached->keyGenerate(__FUNCTION__,
                        $params['req_AccountId']);
                if ($this->memcached->hasItem($cacheId)) {
                    $obj = $this->memcached->getItem($cacheId);
                } else {
                    $ordenado=array();
                    $obj = $this->client->getbillingRDLByAccount($params);
                    if ($obj->res->billingRDLByAccountStatus == 'OK') {
                        if(is_object($obj->res->billingRDLByAccountDefinition)){
                            $ordenado[0] =(array)$obj->res->billingRDLByAccountDefinition;
                            $ordenado = $this->record_sort($ordenado,'req_ReceiptTime', true);
                        }
                        if(is_array($obj->res->billingRDLByAccountDefinition)){
                            $ordenado = $this->record_sort($obj->res->billingRDLByAccountDefinition,
                                'req_ReceiptTime', true);
                        }
                        
                    }

                    $obj->res->billingRDLByAccountDefinition = $ordenado;
                    $this->memcached->setItem($cacheId, $obj, 60);  // 2 minutes
                }
                
                if ($obj->res->billingRDLByAccountStatus == 'OK') {
                    $response->status = 'ok';
                    $response->data = $obj->res;
                } else {
                    $response->status = 'fail';
                    $response->message = $obj->res->billingRDLByAccountStatus;
                }
                return $response;
            } catch (\SoapFault $e) {
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

    }

}
