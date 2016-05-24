<?php

namespace ModPruebas\Controller;

use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $moment = '20050101172525';
        var_dump(strtotime($moment));
        exit;
        $datos = explode(' ', $moment);
        $fecha = explode('/', $datos[0]);
        $time = explode(':', $datos[1]);
        $meridiano = $datos[2];
        $timestamp = mktime($time[0], $time[1], 0, $fecha[1], $fecha[0],
                $fecha[2]);

        var_dump(date('Y-m-d H:i:s', $timestamp));

        exit;




        $title = 'Pre pago';
        $newTitle = str_replace(array('-', ' '), '', strtolower($title));
        var_dump($newTitle);
        exit;
        $datosPago = array(
            'mensaje' => 'este es el mensaje',
            'transaccion' => 1651651,
            'day' => '13/03/2016',
            'monto' => 50,
            'tarjeta' => 'American Express',
            'plan' => 'Individual',
            'operacion' => 'Afiliacion');

        $this->mailpagoAction($datosPago);

        return new ViewModel(array());

    }

    public function mailpagoAction($datos)
    {
        $t = $this->getServiceLocator()->get('TransactionsModel');
        $datosUser = $t->getDataByTransaction(18008);
        $datosPago = array_merge($datos, $datosUser);
        $resp = $this->sendMessagePago('Boleta de Pago', 1651651,
                'boletaEmpresa.phtml', $datosPago);

    }

    public function sendMessagePago($asunto, $idTransaction, $plantilla, $datos)
    {
        try {
            /* $t = $this->getServiceLocator()->get('TransactionsModel');
              $email=$t->getEmailByTransaction($idTransaction); */
            $email = 'deybeecz@gmail.com';
            $dataMail = array(
                'asunto' => $asunto,
                'email' => $email,
                'tipo' => \Epass\Enum\EmailType::WITH_TEMPLATE,
                'template' => EMAIL_PATH . $plantilla,
                'data' => $datos,
            );
            $this->getEventManager()->trigger(\Epass\Event\Listener::MAIL_EVENT,
                    $this, $dataMail);
            return true;
        } catch (Exception $e) {
            return false;
        }

    }

    public function visaAction()
    {
        $numTicket = rand(1000000, 9999999);
        $monto = number_format(rand(1, 200), 2);
        /* Pruebas en visa */
        $VisaService = $this->getServiceLocator()->get('Epass\Service\VisaService');

        $generaEticket = $VisaService->generateEticket($numTicket, $monto);
        $eticket = 0;
        if ($generaEticket['code'] == 200) {
            $eticket = $generaEticket['eticket'];
        } else {
            var_dump($generaEticket);
        }
        return new ViewModel(array('eticket' => $eticket, 'action' => $VisaService->getAction()));

    }

    public function masterAction()
    {
        $numTicket = rand(1000000, 9999999);
        $monto = number_format(rand(1, 200), 2);
        $service = $this->getServiceLocator()->get('Epass\Service\MasterService');
        //$datosHash=array('8004617','ORD155626','14.00','PEN','20160307','113010','cb36c56f1e7','REG002','PER','druphEJUs6EJapAfruQachaSpecubusp');
        /* $datosHash=$service->getDataForHash('ORD155626',$monto);
          echo 'nueva funcion';
          $strHash = urlencode(base64_encode($service->getHash($datosHash)))."</br>";
          echo "HMACSha1: ".$service->getHash($datosHash)."</br>";
          echo "Encode:".base64_encode($service->getHash($datosHash))."</br>";
          echo "Firma:".urlencode(base64_encode($service->getHash($datosHash)))."</br>"; */

        $datos = $service->getDataForHash($numTicket, $monto);
        $hash = $service->getHash($datos);
        $formData = $service->getDataForm($datos, $hash);
        //exit;
        return new ViewModel(array('action' => $service->getAction(), 'datos' => $formData));

    }

    public function amexAction()
    {
        $numTicket = rand(1000000, 9999999);
        $monto = number_format(rand(1, 200), 2);
        $service = $this->getServiceLocator()->get('Epass\Service\AmexService');

        $datos = $service->getDataForHash($numTicket, $monto);
        $hash = $service->getHash($datos);
        $formData = $service->getDataForm($datos, $hash);
        return new ViewModel(array('action' => $service->getAction(), 'datos' => $formData));

    }

    public function dinnersAction()
    {
        $numTicket = rand(1000000, 9999999);
        $monto = number_format(rand(1, 200), 2);
        $service = $this->getServiceLocator()->get('Epass\Service\DinnerService');

        $datos = $service->getDataForHash($numTicket, $monto);
        $hash = $service->getHash($datos);
        $formData = $service->getDataForm($datos, $hash);
        return new ViewModel(array('action' => $service->getAction(), 'datos' => $formData));

    }

    public function emailAction()
    {
        $dataMail = array(
            'asunto' => 'Prueba de envio de email',
            'email' => 'dchavez@clicksandbricks.pe',
            'tipo' => \Epass\Enum\EmailType::WITH_TEMPLATE,
            'template' => EMAIL_PATH . "/boletaPago.phtml",
            'data' => array('pasarela' => 'Visa', 'monto' => '50.00'),
        );

        $this->getEventManager()->trigger(\Epass\Event\Listener::MAIL_EVENT,
                $this, $dataMail);
        echo 'se envio';
        exit;

    }

    public function pagoAction()
    {
        $datosPago = array('mensaje' => 'la operacion se realizo correctamente',
            'transaccion' => 515451,
            'day' => date('Y-m-d H:i:s'),
            'monto' => 110,
            'tarjeta' => 'MasterCard',
            'plan' => 'individual',
            'operacion' => 'Afiliacion');

        $service = $this->getServiceLocator()->get('Popup');
        $service->addParams($datosPago);
        $service->setTemplate('renders/modal_comprobante');
        $this->redirect()->toUrl("/");

    }

    public function registrarEmpresaAction()
    {
        $mpe = $this->getServiceLocator()->get('mpe');
        $valores = array(
            'req_CrmTicket' => "4794",
            'req_Title' => "asd",
            'req_Surname' => "deybee chavez",
            'req_CodeDepartamento' => "15",
            'req_CodeDistrito' => "1252",
            'req_CodeProvincia' => "128",
            'req_Contact' => "aasdads",
            'req_Designation' => "asadasd",
            'req_DocNumber' => "56232563659",
            'req_DocType' => "00",
            'req_Email' => "usuario00012@yopmail.com",
            'req_Forename' => "deybee chavez",
            'req_Individual' => false,
            'req_PhoneNum' => "515151651",
            'req_PhoneNumMobile' => "151511",
            'req_PhoneNumWork' => "956235968",
            'req_ReceiptType' => "B",
            'req_Referencia' => "asdadasd",
            'req_RucNumber' => "56232563659",
            'req_Street' => "ssd",
                /* "req_CrmTicket"=>"4794",
                  "req_RucNumber"=>"56232563659",
                  "req_DocType"=>"00",
                  "req_DocNumber"=>"56232563659",
                  "req_Individual"=>True,
                  "req_Title"=>"Sr.",
                  "req_Forename"=>"deybee",
                  "req_Surname"=>"chavez",
                  "req_Designation"=>"mi razon social",
                  "req_Contact"=>"Deybee Chavez",
                  "req_Street"=>"mi calle",
                  "req_Referencia"=>"referencia",
                  "req_CodeDistrito"=>"05",
                  "req_CodeProvincia"=>"03",
                  "req_CodeDepartamento"=>"02",
                  "req_PhoneNum"=>"956235629",
                  "req_PhoneNumMobile"=>"",
                  "req_PhoneNumWork"=>"",
                  "req_Email"=>"deybeecz@gmail.com",
                  "req_ReceiptType"=>"F",
                  "req_BillingDocNumber"=>"56232563659",
                  "req_BillingDesignation"=>"mi ruc",
                  "req_BillingStreet"=>"asdasd",
                  "req_BillingReferencia"=>"aasdadasd",//string
                  "req_BillingCodeDistrito"=>"05",
                  "req_BillingCodeProvincia"=>"03",//string32
                  "req_BillingCodeDepartamento"=>"02",//string32 */
        );
        $rpta = $mpe->requestAccountCreation($valores);
        var_dump($rpta);
        exit();

    }

    /* public function MongoTestAction()
      {

      $usuarioColection = $this->getServiceLocator()->get('UsuariosCollection');
      $usuarios = $usuarioColection->getUsuarios();
      flog("usuarios",$usuarios);
      return new ViewModel(array("usuarios"=> $usuarios));
      }

      public function testServiceAction()
      {
      //crear usuario
      $data = array();
      $service = $this->getServiceLocator()->get('EpassService');

      $service->requestAccountCreation($data);

      die("testService");
      }

      public function soapServerAction()
      {
      /*$options = array(
      'uri' => 'http://localhost:8080/pruebas/',
      'location' => 'http://localhost:8080/pruebas/index/soap-server',
      );

      $server = new \Zend\Soap\Server(null, $options);
      $server->setObject(new SoapService());
      $server->handle(); */
    /* $autodiscover = new \Zend\Soap\AutoDiscover();
      $autodiscover->setClass('SoapService')
      ->setBindingStyle(array('style' => 'document'))
      ->setUri("http://localhost:8080/pruebas/index/soap-server");
      header('Content-type: application/xml');
      echo $autodiscover->toXml();
      die("soap server");
      } */

    public function crearUsuario2Action()
    {
        /* $alinkedlist = $this->getServiceLocator()->get('Epass\Model\ALinkedListTable');
          $dpt = $alinkedlist->getData(array('LIST' => 3, 'INDEX' => 15));
          $prov = $alinkedlist->getData(array('LIST' => 4, 'INDEX' => 128));
          $dist = $alinkedlist->getData(array('LIST' => 5, 'INDEX' => 1252));
          Debug::dump($dpt[0]["VALUE"]);
          Debug::dump($prov[0]["VALUE"]);
          Debug::dump($dist[0]["VALUE"]);
          exit(); */


        $mpe = $this->getServiceLocator()->get('mpe');


        $params = array(
            'req_CrmTicket' => '60',
            'req_RucNumber' => '',
            'req_DocType' => '00',
            'req_DocNumber' => '56232563659',
            'req_Individual' => false,
            'req_Title' => '',
            'req_Forename' => '',
            'req_Surname' => utf8_encode('Chávez'),
            'req_Designation' => 'khkjh',
            'req_Contact' => '',
            'req_Street' => '',
            'req_Referencia' => '',
            'req_CodeDistrito' => '03',
            'req_CodeProvincia' => '01',
            'req_CodeDepartamento' => '15',
            'req_PhoneNum' => '',
            'req_PhoneNumMobile' => '',
            'req_PhoneNumWork' => '943431802',
            'req_Email' => 'deybeeczs@gmail.com',
            'req_ReceiptType' => 'F',
                //'req_BillingPeriod'=>'D'
        );
        flog("params", $params);
        $rq = $mpe->requestAccountCreation($params);
        Debug::dump($rq);
        Debug::dump($rq->message->res->AccountEditStatus);
        Debug::dump($rq->data->AccountId);
        exit();
        flog("rq", $rq);
        exit;

    }

    public function subscribePlanAction()
    {
        $mpe = $this->getServiceLocator()->get('mpe');


        $params = array(
            'req_AccountId' => '00101694',
            'req_PlanId' => 39,
        );
        flog("params", $params);
        $rq = $mpe->subscribePlan($params);
        Debug::dump($rq);
        Debug::dump($rq->status);
        exit();

    }

    public function AllPromotionsAction()
    {
        $mpe = $this->getServiceLocator()->get('mpe');

        $params = array(
            'req_ProductId' => 1,
            'req_PlanId' => 39
        );

        flog("params", $params);
        $rq = $mpe->getAllPromotionsByPlanByProduct($params);
        Debug::dump($rq);
        Debug::dump($rq->status);
        exit();

    }

    public function subscribePromotionAction()
    {
        $mpe = $this->getServiceLocator()->get('mpe');

        $params = array(
            'req_AccountId' => '00101694',
            'req_PromotionId' => true
        );

        flog("params", $params);
        $rq = $mpe->subscribePromotion($params);
        Debug::dump($rq);
        Debug::dump($rq->status);
        exit();

    }

    public function addVehiclesAction()
    {
        $mpe = $this->getServiceLocator()->get('mpe');

        $params = array(
            'req_AccountId' => '00101694',
            'req_VehClass' => '01',
            'req_Plate' => 'abc-123',
            'req_Make' => '1',
            'req_Model' => '211'
        );

        flog("params", $params);
        $rq = $mpe->addVehicle($params);
        Debug::dump($rq);
        Debug::dump($rq->status);
        exit();

    }

    public function recargaAction()
    {
        try {
//            $costoPromocionalTag = '15.00';
//            $costoTotal = '1,015.00';
//            ;
//            $costoTagFinal ='15.00';
//            $costoTotal = str_replace(',', "", $costoTotal);
//
//            $saldoUso =   ($costoTotal - $costoTagFinal);
//            var_dump($saldoUso,$costoTotal);
//
//            exit;

            $t = $this->getServiceLocator()->get('TransactionsModel');
            $datosUser = $t->getDataByRecarga(19141);
            var_dump($datosUser);exit;
            $mpe = $this->getServiceLocator()->get('mpe');
            $datosEstaticos = array('req_Source' => 'portal-web');
            $datosws = array_merge($datosUser, $datosEstaticos);




            $rpta = $mpe->rechargePrepayAndRequestTagAccount($datosws);
            var_dump($rpta, $datosws);
            exit;
            if ($rpta->status == 'ok') {
                $data = array('id' => $idTransaction, 'migrate' => 1);
                $t->save($data);
            }
            return true;
        } catch (Exception $e) {
            $t = $this->getServiceLocator()->get('TransactionsModel');
            $data = array('id' => $idTransaction, 'migrate' => 1);
            $t->save($data);
            continue;
        }

    }

    public function recargar($id)
    {
        $t = $this->getServiceLocator()->get('TransactionsModel');
        $datosUser = $t->getDataByTransaction(18029);
        var_dump($datosUser);

    }

    public function transitoAction()
    {
        $mpe = $this->getServiceLocator()->get('mpe');

        $params = array(
            'req_StartDate' => '20150505040404',
            'req_EndDate' => '20160101040404'
        );

        flog("params", $params);
        $rq = $mpe->getTransits($params);
        Debug::dump($rq);
        Debug::dump($rq->status);
        exit();

    }

    public function verificaTagAction()
    {
      $tags=['20150218484F000020005312', '20150218484F000020004745',
       '20150218484F000020003215', '20150218484F000020003071',
        '20150218484F000020003091', '20150218484F000020003038',
      '20150218484F000020003111','20150218484F000020003113',
      '20150218484F000020003212','20150218484F000020003082',
      '20150218484F000020003092'
    ];

      $mpe = $this->getServiceLocator()->get('mpe');
      foreach ($tags as $tag) {
        $rep=$mpe->getValidateTagPlate(['req_TagPlate'=>substr($tag,-8)]);
        var_dump($rep);
        echo "<br/>";
        if($rep->code==200){
          $inicio=date('Ymd',mktime(0,0,0,3,1,2016));
          $final=date('Ymd',time()+86400);
          $data=array('req_AccountId'=>$rep->data->accountId,'req_StartDate'=>$inicio,'req_EndDate'=>$final);
          $repMov=$mpe->getMovementsByAccount($data);
          print_r($repMov);
        }
        exit;
        echo "<br/>";
      }
      exit;
    }
    
    public function testUpGoogleAction()
    {
        $g = $this->getServiceLocator()->get('google');
        $file = 'white.pdf';
        $rtp = $g->upload($file);
        \Zend\Debug\Debug::dump($rtp);
        exit;
    }
    
    public function nombreMailAction(){
        $user_plans = $this->getServiceLocator()->get('UsersModel');
        $name=$user_plans->getNameUserbyEmail('agabaldoni@gmail.com');
        var_dump($name);
        exit;
    }
    
    public function crearUsuarioAction(){
        $idTransaccion = 21029;
        
        $t = $this->getServiceLocator()->get('TransactionsModel');
        $params=$t->getDataByEmail($idTransaccion);
        var_dump($params);
        exit;
//        unset($params['user_id']);
//        unset($params['user_plan_id']);
//        $mpe = $this->getServiceLocator()->get('mpe');
//        $rq = $mpe->requestAccountCreation($params);
//        var_dump($rq);
//        exit;
    }

}
