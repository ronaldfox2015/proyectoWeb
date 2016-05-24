<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Controller;

use Application\Form\ReclamacionesForm;
use Application\InputFilter\ReclamacionInputFilter;
use Application\Model\Entity\Reclamacion;
use Epass\Model\ALinkedListTable;
use Zend\Debug\Debug;
use Zend\InputFilter\Factory;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\RegistroAvanzado;
use Zend\View\Model\JsonModel;
use Zend\Session\Container;
use Application\Form\ContactanosForm;
use Application\Model\Entity\Contactanos;

/**
 * Description of EpassController
 *
 * @author ronald
 */
class EpassController extends AbstractActionController
{

    CONST TIPO_DOC_RUC = '00';
    CONST DTP_LIMA = '15';
    CONST PROV_LIMA = '128';
    CONST DIST_LIMA = '1252';

    //put your code here
    public function queEsEpassAction()
    {
        return new ViewModel();

    }

    public function beneficiosAction()
    {
        return new ViewModel();

    }

    public function dondeAction()
    {
        return new ViewModel();

    }

    public function comoAction()
    {
        return new ViewModel();

    }

    public function matchTitle($namePlan)
    {
        $name = strtolower($namePlan);
        $title = '';

        if (preg_match('/individual 1/', $name)) {
            $title = 'Individual';
        }
        if (preg_match('/familiar 1/', $name)) {
            //$title = 'Compartido';
            $title = 'Compartida';
        }
        if (preg_match('/corporativo/', $name)) {
            $title = 'Pre-Pago';
        }

        return $title;

    }

    /* Enrutador del registro de paquete individual */

    public function paqueteIndividualAction()
    {
        $auth = $this->getServiceLocator()->get('AuthService');
        $data_sesion_user = $auth->getStorage()->read();
        if (isset($data_sesion_user->anonimo) && $data_sesion_user->anonimo == 1) {
            $auth->clearIdentity();
        }

        if ($this->getRequest()->isPost()) {
            $datos = $this->getRequest()->getPost();
            $redirect = $this->validarSession($datos, '/personas');
            $data = $this->validarPlan($datos, 'individual');
            if (empty($data)) {
                $this->flashMessenger()->addErrorMessage('Necesitas seleccionar un paquete.');
                return $this->redirect()->toUrl("/personas");
            }
            $data['title'] = $this->matchTitle($datos['nombrePlan']);
            //sessiones afiliate
            $this->crearSessionAfiliate($data);
            if (!$redirect) {
                return $this->redirect()->toUrl("/registro-individual");
            } else {
                return $this->redirect()->toUrl($redirect);
            }
        } else {
            $this->flashMessenger()->addErrorMessage('Necesitas seleccionar un paquete.');
            return $this->redirect()->toUrl("/personas");
        }

    }

    /* Enrutador del paquete familiar */

    public function paqueteFamiliarAction()
    {
        $auth = $this->getServiceLocator()->get('AuthService');
        $data_sesion_user = $auth->getStorage()->read();
        if (isset($data_sesion_user->anonimo) && $data_sesion_user->anonimo == 1) {
            $auth->clearIdentity();
        }
        
        if ($this->getRequest()->isPost()) {
            $datos = $this->getRequest()->getPost();
            $redirect = $this->validarSession($datos, '/personas');
            $data = $this->validarPlan($datos, 'familiar');
            if (empty($data)) {
                $this->flashMessenger()->addErrorMessage('Necesitas seleccionar un paquete.');
                return $this->redirect()->toUrl("/personas");
            }
            $data['title'] = $this->matchTitle($datos['nombrePlan']);
            //sessiones afiliate
            $this->crearSessionAfiliate($data);
            if (!$redirect) {
                return $this->redirect()->toUrl("/registro-familiar");
            } else {
                return $this->redirect()->toUrl($redirect);
            }
        } else {
            $this->flashMessenger()->addErrorMessage('Necesitas seleccionar un paquete.');
            return $this->redirect()->toUrl("/personas");
        }

    }

    /* Enrutador del paquete empresarial */

    public function paqueteEmpresasAction()
    {
        $auth = $this->getServiceLocator()->get('AuthService');
        $data_sesion_user = $auth->getStorage()->read();
        if (isset($data_sesion_user->anonimo) && $data_sesion_user->anonimo == 1) {
            $auth->clearIdentity();
        }
        
        if ($this->getRequest()->isPost()) {
            $datos = $this->getRequest()->getPost();
            $redirect = $this->validarSession($datos, '/empresas');
            $data = $this->validarPlan($datos, 'corporativo');
            if (empty($data)) {
                return $this->redirect()->toUrl("/empresas");
            }
            $data['title'] = $this->matchTitle($datos['nombrePlan']);
            //sessiones afiliate
            $this->crearSessionAfiliate($data);

            if (!$redirect) {
                return $this->redirect()->toUrl("/registro-empresas");
            } else {
                return $this->redirect()->toUrl($redirect);
            }
        } else {
            $this->flashMessenger()->addErrorMessage('Necesitas seleccionar un paquete.');
            return $this->redirect()->toUrl("/empresas");
        }

    }

    /* Formulario del proceso de afiliacion Individual */

    public function afiliacionIndividualAction()
    {
        $this->existSession('personas');
        $true=false;
        if ($this->getRequest()->isPost()) {
            $datos = $this->getRequest()->getPost();
            $this->crearSessionAfiliacion($datos);
            $this->crearSessionVehiculosAfiliacion($datos);
            return $this->redirect()->toUrl("/afiliate-pago");
        } else {
            $session = new Container('afiliacion');
            $session->offsetSet('urlFail','/registro-individual');
            $auth = $this->getServiceLocator()->get('AuthService');
            $data_sesion_user = $auth->getStorage()->read();
            if(isset($data_sesion_user->role)){
                $true=true;
            }
            $formRegistroAvanzado = new RegistroAvanzado();
            //Obtener Tipo de Documento
            $ad = $this->getServiceLocator()->get('Epass\Model\ADocumentTypeTable');
            $ac = $this->getServiceLocator()->get('Epass\Model\AClassTable');
            $sm = $this->getServiceLocator()->get('Epass\Model\ALinkedListTable');
            $tipoDoc = $ad->getData(array());
            foreach ($tipoDoc as $key => $value) {
                $dataTipoDoc[''] = 'Seleccionar Documento';
                $dataTipoDoc[$value['TYPE']] = $value['DESCRIPTION'];
            }

            unset($dataTipoDoc[self::TIPO_DOC_RUC]);

            $formRegistroAvanzado->get('tipoDoc')->setValueOptions($dataTipoDoc);
            //Obtener Los Departamentos
            $dpt = $sm->getData(array('LIST' => ALinkedListTable::DEPARTAMENTOS));
            $prov = $sm->getData(array('LIST' => 4, 'DEPINDEX' => empty($session->idDpto) ? self::DTP_LIMA : $session->idDpto));
            $dist = $sm->getData(array('LIST' => 5, 'DEPINDEX' => empty($session->idProvin) ? self::PROV_LIMA : $session->idProvin));

            foreach ($dpt as $key => $value) {
                $dataLisDptos[''] = 'Seleccionar Departamento';
                $dataLisDptos[$value['INDEX']] = $value['TEXT'];
            }
            foreach ($prov as $key => $value) {
                $dataLisProv[''] = 'Seleccionar Provincia';
                $dataLisProv[$value['INDEX']] = $value['TEXT'];
            }
            foreach ($dist as $key => $value) {
                $dataLisDist[''] = 'Seleccionar Distrito';
                $dataLisDist[$value['INDEX']] = $value['TEXT'];
            }
            $formRegistroAvanzado->get('idDpto')->setValueOptions($dataLisDptos)->setValue(self::DTP_LIMA);
            $formRegistroAvanzado->get('idProvin')->setValueOptions($dataLisProv);
            $formRegistroAvanzado->get('idDistrito')->setValueOptions($dataLisDist);
            //obtener los tipos de vehículos
            $tipoVehiculo = $ac->getData(array('TOLLCOMPANY' => \Epass\Model\AClassTable::TOLLCOMPANY));
            $keys = $this->obtenerKeys($session->maxVehiculos);

            foreach ($keys as $key) {
                ${"dataModelos" . $key} = array('' => 'Seleccionar Modelo');
                ${"dataMarcas" . $key} = array('' => 'Seleccionar Marca');

                if ($session->offsetExists('idTipoVehiculo' . $key)) {
                    foreach ($tipoVehiculo as $value) {
                        if ($value['CLASS'] == $session->{"idTipoVehiculo" . $key}) {
                            ${"typeVehiculo" . $key} = $value['TYPE'];
                        }
                    }
                    //flog("typeVehiculo",${"typeVehiculo" . $key});
                    ${"listMarcas" . $key} = $sm->getData(array('LIST' => ${"typeVehiculo" . $key}));
                    foreach (${"listMarcas" . $key} as $value) {
                        if ($value['INDEX'] == $session->{"idMarca" . $key}) {
                            ${"typeMarca" . $key} = $value['INDEX'];
                        }
                    }
                    foreach (${"listMarcas" . $key} as $k => $value) {
                        ${"dataMarcas" . $key}[''] = 'Seleccionar Marca';
                        /*
                        ${"dataMarcas" . $key}[$k]['value'] = $value['INDEX'];
                        ${"dataMarcas" . $key}[$k]['label'] = utf8_decode($value['TEXT']);
                        ${"dataMarcas" . $key}[$k]['attributes'] = array('data-list' => ${"typeVehiculo" . $key} + 1);*/
                    }
                    ${"listModelos" . $key} = $sm->getData(array('LIST' => ${"typeVehiculo" . $key} + 1, 'DEPINDEX' => ${"typeMarca" . $key}));
                    foreach (${"listModelos" . $key} as $k => $value) {
                        ${"dataModelos" . $key}[''] = 'Seleccionar Modelo';
                        /*
                        ${"dataModelos" . $key}[$k]['value'] = $value['INDEX'];
                        ${"dataModelos" . $key}[$k]['label'] = $value['TEXT'];*/
                    }
                }

                foreach ($tipoVehiculo as $k => $rowVehiculo) {
                    $dataTipo[''] = 'Seleccionar Tipo';
                    $dataTipo[$k]['value'] = $rowVehiculo['CLASS'];
                    $dataTipo[$k]['label'] = $rowVehiculo['DESCRIPTION'];//  mb_convert_encoding($rowVehiculo['DESCRIPTION'],'UTF-8','HTML-ENTITIES');
                    $dataTipo[$k]['attributes'] = array('data-type' => $rowVehiculo['TYPE']);
                }

                $formRegistroAvanzado->get('idTipoVehiculo' . $key)->setValueOptions($dataTipo);
                $formRegistroAvanzado->get('idMarca' . $key)->setValueOptions(${"dataMarcas" . $key});
                $formRegistroAvanzado->get('idModelo' . $key)->setValueOptions(${"dataModelos" . $key});
            }
            $this->setDataFormWithSessionData($formRegistroAvanzado);
            return new ViewModel(array('session' => $session, 'formRegistroAvanzado' => $formRegistroAvanzado));
        }

    }

    private function crearSessionAfiliacion($data)
    {
        $sessionAfiliacion = new Container('afiliacion');
        $sessionAfiliacion->offsetSet('txtRazonSocial', $data['txtRazonSocial']);
        $sessionAfiliacion->offsetSet('txtNombreTitular',
                $data['txtNombreTitular']);
        $sessionAfiliacion->offsetSet('txtApellidosTitular',
                $data['txtApellidosTitular']);
        $sessionAfiliacion->offsetSet('tipoDoc', $data['tipoDoc']);
        $sessionAfiliacion->offsetSet('txtNumDocumento',
                $data['txtNumDocumento']);
        $sessionAfiliacion->offsetSet('txtCorreo', $data['txtCorreo']);
        $sessionAfiliacion->offsetSet('txtTelefono', $data['txtTelefono']);
        $sessionAfiliacion->offsetSet('txtContrasenia', $data['txtContrasenia']);
        $sessionAfiliacion->offsetSet('txtConfirmaContrasenia',
                $data['txtConfirmaContrasenia']);
        $sessionAfiliacion->offsetSet('radTipo', $data['radTipo']);
        $sessionAfiliacion->offsetSet('idDpto', $data['idDpto']);
        $sessionAfiliacion->offsetSet('idProvin', $data['idProvin']);
        $sessionAfiliacion->offsetSet('idDistrito', $data['idDistrito']);
        $sessionAfiliacion->offsetSet('txtNombVia', $data['txtNombVia']);
        $sessionAfiliacion->offsetSet('txtNumVia', $data['txtNumVia']);
        $sessionAfiliacion->offsetSet('txtDptoVia', $data['txtDptoVia']);
        $sessionAfiliacion->offsetSet('txtUrbanizacion',
                $data['txtUrbanizacion']);
        $sessionAfiliacion->offsetSet('txtDireccion', $data['txtDireccion']);
        $sessionAfiliacion->offsetSet('CkTerminos', $data['CkTerminos']);
        $sessionAfiliacion->offsetSet('CkNovedades', $data['CkNovedades']);
        $sessionAfiliacion->offsetSet('txtReferencia', $data['txtReferencia']);
        if(isset($data['id_user_trunco']) && !empty($data['id_user_trunco'])){
            $sessionAfiliacion->offsetSet('id',$data['id_user_trunco']);
        }

    }

    private function crearSessionVehiculosAfiliacion($data)
    {
        $sessionAfiliacion = new Container('afiliacion');
        $keys = $this->obtenerKeys($sessionAfiliacion->maxVehiculos);
        foreach ($keys as $key) {
            if (isset($data['idTipoVehiculo' . $key]) && $data['idTipoVehiculo' . $key] != '') {
                $sessionAfiliacion->offsetSet('idTipoVehiculo' . $key,
                        $data['idTipoVehiculo' . $key]);
                $sessionAfiliacion->offsetSet('idMarca' . $key,
                        $data['idMarca' . $key]);
                $sessionAfiliacion->offsetSet('txtPlaca' . $key,
                        $data['txtPlaca' . $key]);
                $sessionAfiliacion->offsetSet('idModelo' . $key,
                        $data['idModelo' . $key]);
                $sessionAfiliacion->offsetSet('txtColor' . $key,
                        $data['txtColor' . $key]);
            }
        }

    }

    private function crearSessionAfiliate($data)
    {
        $this->removeSession();
        $TransactionTypesModel = $this->getServiceLocator()->get('TransactionTypesModel');
        $tipo = $TransactionTypesModel->getTransactionTypesByID(\Epass\Model\TransactionTypesTable::FLAG_TYPE_AFILIACION_RECARGA);
        $sessionAfiliate = new Container('afiliacion');
        $sessionAfiliate->offsetSet('saldoUso', $data['saldoUso']);
        $sessionAfiliate->offsetSet('tasaRecarga', $data['tasaRecarga']);
        $costoTag=($data['costoPromocionalTag']>0)?$data['costoPromocionalTag']:$data['costoFijoTag'];
        $sessionAfiliate->offsetSet('costoTag',$costoTag);
        $sessionAfiliate->offsetSet('costoPromocionalTag',
                $data['costoPromocionalTag']);
        $sessionAfiliate->offsetSet('costoTotal',
                number_format($data['costoTotal'], 2));
        $sessionAfiliate->offsetSet('costoSinTag',
                number_format($data['costoTotal'], 2));
        $sessionAfiliate->offsetSet('idPlan', $data['planId']);
        $sessionAfiliate->offsetSet('namePlan', $data['namePlan']);
        $sessionAfiliate->offsetSet('title', $data['title']);
        $sessionAfiliate->offsetSet('maxVehiculos', $data['maxVehiculos']);
        $sessionAfiliate->offsetSet('flagTipoAfiliacion', $tipo['id']);
        $sessionAfiliate->offsetSet('urlError', '/afiliate/pago');

    }

    private function removeSession()
    {
        $container = new Container('afiliacion');
        $container->exchangeArray(array());
        return true;

    }

    private function validarPlan($datos, $paquete)
    {
        
        $mpe = $this->getServiceLocator()->get('mpe');
        $paquetes = $mpe->getPaquetesAfiliacion([$paquete]);

        $plan = $paquetes[$paquete];
        if (empty($plan)) {
            return $this->redirect()->toUrl("/");
        }

        foreach ($plan as $key => $value) {
            $individual[$key] = (array) $value;
        }

        $data = array();
        foreach ($individual as $key => $value) {

            if ($value['costoTotal'] == $datos['monto']) {
                $data = $individual[$key];
            }
        }
        return $data;

    }

    public function afiliacionFamiliarAction()
    {
        $this->existSession('personas');
        if ($this->getRequest()->isPost()) {
            $datos = $this->getRequest()->getPost();
            $this->crearSessionAfiliacion($datos);
            return $this->redirect()->toUrl("/registro-familiar-vehiculos");
        } else {
            $session = new Container('afiliacion');
            $session->offsetSet('urlFail','/registro-familiar');
            $formRegistroAvanzado = new RegistroAvanzado();
            //Obtener Tipo de Documento
            $ad = $this->getServiceLocator()->get('Epass\Model\ADocumentTypeTable');
            $sm = $this->getServiceLocator()->get('Epass\Model\ALinkedListTable');
            $tipoDoc = $ad->getData(array());
            foreach ($tipoDoc as $key => $value) {
                $dataTipoDoc[''] = 'Seleccionar Documento';
                $dataTipoDoc[$value['TYPE']] = $value['DESCRIPTION'];
            }

            $optionRuc = $dataTipoDoc[self::TIPO_DOC_RUC];
            unset($dataTipoDoc[self::TIPO_DOC_RUC]);
            $dataTipoDoc[self::TIPO_DOC_RUC] = $optionRuc;
            
            $formRegistroAvanzado->get('tipoDoc')->setValueOptions($dataTipoDoc);
            //Obtener Los Departamentos
            $dpt = $sm->getData(array('LIST' => ALinkedListTable::DEPARTAMENTOS));
            $prov = $sm->getData(array('LIST' => 4, 'DEPINDEX' => empty($session->idDpto) ? self::DTP_LIMA : $session->idDpto));
            $dist = $sm->getData(array('LIST' => 5, 'DEPINDEX' => empty($session->idProvin) ? self::PROV_LIMA : $session->idProvin));
            foreach ($dpt as $key => $value) {
                $dataLisDptos[0] = 'Seleccionar Departamento';
                $dataLisDptos[$value['INDEX']] = $value['TEXT'];
            }
            foreach ($prov as $key => $value) {
                $dataLisProv[0] = 'Seleccionar Provincia';
                $dataLisProv[$value['INDEX']] = $value['TEXT'];
            }
            foreach ($dist as $key => $value) {
                $dataLisDist[0] = 'Seleccionar Distrito';
                $dataLisDist[$value['INDEX']] = $value['TEXT'];
            }
            $formRegistroAvanzado->get('idDpto')->setValueOptions($dataLisDptos);
            $formRegistroAvanzado->get('idProvin')->setValueOptions($dataLisProv);
            $formRegistroAvanzado->get('idDistrito')->setValueOptions($dataLisDist);
            $this->setDataFormWithSessionData($formRegistroAvanzado);
            return new ViewModel(array('session' => $session, 'formRegistroAvanzado' => $formRegistroAvanzado));
        }

    }

    public function afiliacionFamiliarVehiculosAction()
    {
        $this->existSession('personas');
        if ($this->getRequest()->isPost()) {
            $datos = $this->getRequest()->getPost();
            $this->crearSessionVehiculosAfiliacion($datos);
            return $this->redirect()->toUrl("/afiliate-pago");
        } else {
            $session = new Container('afiliacion');
            $this->clearVehicle($session);
            $formRegistroAvanzado = new RegistroAvanzado();
            $ac = $this->getServiceLocator()->get('Epass\Model\AClassTable');
            $sm = $this->getServiceLocator()->get('Epass\Model\ALinkedListTable');
            $tipoVehiculo = $ac->getData(array('TOLLCOMPANY' => \Epass\Model\AClassTable::TOLLCOMPANY));
            $keys = $this->obtenerKeys($session->maxVehiculos);

            foreach ($keys as $key) {
                ${"dataModelos" . $key} = array('' => 'Seleccionar Modelo');
                ${"dataMarcas" . $key} = array('' => 'Seleccionar Marca');

                if ($session->offsetExists('idTipoVehiculo' . $key)) {
                    foreach ($tipoVehiculo as $value) {
                        if ($value['CLASS'] == $session->{"idTipoVehiculo" . $key}) {
                            ${"typeVehiculo" . $key} = $value['TYPE'];
                        }
                    }
                    //flog("typeVehiculo",${"typeVehiculo" . $key});
                    ${"listMarcas" . $key} = $sm->getData(array('LIST' => ${"typeVehiculo" . $key}));
                    foreach (${"listMarcas" . $key} as $value) {
                        if ($value['INDEX'] == $session->{"idMarca" . $key}) {
                            ${"typeMarca" . $key} = $value['INDEX'];
                        }
                    }
                    foreach (${"listMarcas" . $key} as $k => $value) {
                        ${"dataMarcas" . $key}[''] = 'Seleccionar Marca';
                        ${"dataMarcas" . $key}[$k]['value'] = $value['INDEX'];
                        ${"dataMarcas" . $key}[$k]['label'] = utf8_decode($value['TEXT']);
                        ${"dataMarcas" . $key}[$k]['attributes'] = array('data-list' => ${"typeVehiculo" . $key} + 1);
                    }
                    ${"listModelos" . $key} = $sm->getData(array('LIST' => ${"typeVehiculo" . $key} + 1, 'DEPINDEX' => ${"typeMarca" . $key}));
                    foreach (${"listModelos" . $key} as $k => $value) {
                        ${"dataModelos" . $key}[''] = 'Seleccionar Marca';
                        ${"dataModelos" . $key}[$k]['value'] = $value['INDEX'];
                        ${"dataModelos" . $key}[$k]['label'] = utf8_decode($value['TEXT']);
                    }
                }

                foreach ($tipoVehiculo as $k => $rowVehiculo) {
                    $dataTipo[''] = 'Seleccionar Tipo';
                    $dataTipo[$k]['value'] = $rowVehiculo['CLASS'];
                    $dataTipo[$k]['label'] = $rowVehiculo['DESCRIPTION']; //utf8_decode($rowVehiculo['DESCRIPTION']);
                    $dataTipo[$k]['attributes'] = array('data-type' => $rowVehiculo['TYPE']);
                }

                $formRegistroAvanzado->get('idTipoVehiculo' . $key)->setValueOptions($dataTipo);
                $formRegistroAvanzado->get('idMarca' . $key)->setValueOptions(${"dataMarcas" . $key});
                $formRegistroAvanzado->get('idModelo' . $key)->setValueOptions(${"dataModelos" . $key});
            }

            return new ViewModel(array('session' => $session, 'formRegistroAvanzado' => $formRegistroAvanzado));
        }

    }

    private function obtenerKeys($maxVehiculos)
    {
        $keysAll = array('', '2', '3', '4', '5', '6', '7', '8', '9', '10');
        $keys = array_slice($keysAll, 0, $maxVehiculos);
        return $keys;

    }

    public function afiliacionEmpresasAction()
    {
        $this->existSession('empresas');
        if ($this->getRequest()->isPost()) {
            $datos = $this->getRequest()->getPost();
            $this->crearSessionAfiliacion($datos);
            return $this->redirect()->toUrl("/registro-empresas-vehiculos");
        } else {
            $session = new Container('afiliacion');
            $session->offsetSet('urlFail','/registro-empresas');
            $session->isEmpresa = true;
            $formRegistroAvanzado = new RegistroAvanzado();
            //Obtener Los Departamentos
            $sm = $this->getServiceLocator()->get('Epass\Model\ALinkedListTable');
            $dpt = $sm->getData(array('LIST' => ALinkedListTable::DEPARTAMENTOS));
            $prov = $sm->getData(array('LIST' => 4, 'DEPINDEX' => empty($session->idDpto) ? self::DTP_LIMA : $session->idDpto));
            $dist = $sm->getData(array('LIST' => 5, 'DEPINDEX' => empty($session->idProvin) ? self::PROV_LIMA : $session->idProvin));
            foreach ($dpt as $key => $value) {
                $dataLisDptos[0] = 'Seleccionar Departamento';
                $dataLisDptos[$value['INDEX']] = $value['TEXT'];
            }
            foreach ($prov as $key => $value) {
                $dataLisProv[0] = 'Seleccionar Provincia';
                $dataLisProv[$value['INDEX']] = $value['TEXT'];
            }
            foreach ($dist as $key => $value) {
                $dataLisDist[0] = 'Seleccionar Distrito';
                $dataLisDist[$value['INDEX']] = $value['TEXT'];
            }
            $formRegistroAvanzado->get('idDpto')->setValueOptions($dataLisDptos);
            $formRegistroAvanzado->get('idProvin')->setValueOptions($dataLisProv);
            $formRegistroAvanzado->get('idDistrito')->setValueOptions($dataLisDist);
            $this->setDataFormWithSessionData($formRegistroAvanzado, true);
            return new ViewModel(array('session' => $session, 'formRegistroAvanzado' => $formRegistroAvanzado));
        }

    }

    public function afiliacionEmpresasVehiculosAction()
    {
        $this->existSession('empresas');
        if ($this->getRequest()->isPost()) {
            $datos = $this->getRequest()->getPost();
            $this->crearSessionVehiculosAfiliacion($datos);
            return $this->redirect()->toUrl("/afiliate-pago");
        } else {
            $session = new Container('afiliacion');
            $this->clearVehicle($session);
            $formRegistroAvanzado = new RegistroAvanzado();
            //obtener los tipos de vehículos
            $ac = $this->getServiceLocator()->get('Epass\Model\AClassTable');
            $sm = $this->getServiceLocator()->get('Epass\Model\ALinkedListTable');
            $tipoVehiculo = $ac->getData(array('TOLLCOMPANY' => \Epass\Model\AClassTable::TOLLCOMPANY));
            $keys = $this->obtenerKeys($session->maxVehiculos);

            foreach ($keys as $key) {
                ${"dataModelos" . $key} = array('' => 'Seleccionar Modelo');
                ${"dataMarcas" . $key} = array('' => 'Seleccionar Marca');

                if ($session->offsetExists('idTipoVehiculo' . $key)) {
                    foreach ($tipoVehiculo as $value) {
                        if ($value['CLASS'] == $session->{"idTipoVehiculo" . $key}) {
                            ${"typeVehiculo" . $key} = $value['TYPE'];
                        }
                    }
                    ${"listMarcas" . $key} = $sm->getData(array('LIST' => ${"typeVehiculo" . $key}));
                    foreach (${"listMarcas" . $key} as $value) {
                        if ($value['INDEX'] == $session->{"idMarca" . $key}) {
                            ${"typeMarca" . $key} = $value['INDEX'];
                        }
                    }
                    foreach (${"listMarcas" . $key} as $k => $value) {
                        ${"dataMarcas" . $key}[''] = 'Seleccionar Marca';
                        ${"dataMarcas" . $key}[$k]['value'] = $value['INDEX'];
                        ${"dataMarcas" . $key}[$k]['label'] = utf8_decode($value['TEXT']);
                        ${"dataMarcas" . $key}[$k]['attributes'] = array('data-list' => ${"typeVehiculo" . $key} + 1);
                    }
                    ${"listModelos" . $key} = $sm->getData(array('LIST' => ${"typeVehiculo" . $key} + 1, 'DEPINDEX' => ${"typeMarca" . $key}));
                    foreach (${"listModelos" . $key} as $k => $value) {
                        ${"dataModelos" . $key}[''] = 'Seleccionar Marca';
                        ${"dataModelos" . $key}[$k]['value'] = $value['INDEX'];
                        ${"dataModelos" . $key}[$k]['label'] = utf8_decode($value['TEXT']);
                    }
                }

                foreach ($tipoVehiculo as $k => $rowVehiculo) {
                    $dataTipo[''] = 'Seleccionar Tipo';
                    $dataTipo[$k]['value'] = $rowVehiculo['CLASS'];
                    $dataTipo[$k]['label'] = $rowVehiculo['DESCRIPTION']; //utf8_decode($rowVehiculo['DESCRIPTION']);
                    $dataTipo[$k]['attributes'] = array('data-type' => $rowVehiculo['TYPE']);
                }

                $formRegistroAvanzado->get('idTipoVehiculo' . $key)->setValueOptions($dataTipo);
                $formRegistroAvanzado->get('idMarca' . $key)->setValueOptions(${"dataMarcas" . $key});
                $formRegistroAvanzado->get('idModelo' . $key)->setValueOptions(${"dataModelos" . $key});
            }

            return new ViewModel(array('session' => $session, 'formRegistroAvanzado' => $formRegistroAvanzado));
        }

    }

    public function afiliatePagoAction()
    {
        $this->existSession('/');
        $dataPago = array();
        $sessionAfiliate = new Container('afiliacion');

        //validar ultima transaccion
        $t = $this->getServiceLocator()->get('TransactionsModel');
        $visaService = $this->getServiceLocator()->get('Epass\Service\VisaService');

        $transactions = $t->getLastTransactionsByEmail($sessionAfiliate->offsetGet('txtCorreo'));

        foreach ($transactions as $tran) {           
            
            $response = $visaService->processResponce($tran['external_id']); 
            
            if($response['code'] == 200){
                //pegar aqui
                echo "transaccion pendiente";
                $uri = $this->getRequest()->getUri();
                $base = sprintf('%s://%s', $uri->getScheme(), $uri->getHost());
        
                $ch = curl_init($base.'/application/pasarela/visa');
                curl_setopt($ch, CURLOPT_POST, 1);        
                curl_setopt($ch, CURLOPT_POSTFIELDS, "eticket={$tran['external_id']}");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                $respuesta = curl_exec($ch);        
                $error = curl_error($ch);        
                curl_close ($ch);

                return $this->redirect()->toUrl("/");
            }
        }

        $dataPago['saldoUso'] = $sessionAfiliate->offsetGet('saldoUso');
        $dataPago['tasaRecarga'] = $sessionAfiliate->offsetGet('tasaRecarga');
        $dataPago['costoTag'] = $sessionAfiliate->offsetGet('costoTag');
        $dataPago['costoPromocionalTag'] = $sessionAfiliate->offsetGet('costoPromocionalTag');
        $dataPago['costoTotal'] = $sessionAfiliate->offsetGet('costoSinTag');
        //$dataPago['costoSinTag']=$sessionAfiliate->offsetGet('costoSinTag');
        $dataPago['idPlan'] = $sessionAfiliate->offsetGet('idPlan');
        $dataPago['title'] = $sessionAfiliate->offsetGet('title');
        $dataPago['flagTipoAfiliacion'] = $sessionAfiliate->offsetGet('flagTipoAfiliacion');
        $dataPago['isEmpresa'] = $sessionAfiliate->offsetExists('isEmpresa');
        $numVehicle = $this->cantVehiculos($sessionAfiliate);
        $sessionAfiliate->offsetSet('numVehicles',$numVehicle);
        $dataPago['costoTotalVehiculos'] = 0;
        if($numVehicle){
          $costoTag=($dataPago['costoPromocionalTag']>0)?$dataPago['costoPromocionalTag']:$dataPago['costoTag'];
          $dataPago['costoTotalVehiculos']=($numVehicle-1)*$costoTag;
          //$sessionAfiliate->offsetSet('costoTotalVehiculos',$dataPago['costoTotalVehiculos']);
        }
        $monto = str_replace(',','',$dataPago['costoTotal']);
        $total= (double)$monto + (double)$dataPago['costoTotalVehiculos'];
        //$total = str_replace(',','',$total);
        $dataPago['costoTotal'] = number_format($total,2);
        $dataPago['txtRazonSocial']=$sessionAfiliate->offsetGet('txtRazonSocial');
        $dataPago['txtNumDocumento']=$sessionAfiliate->offsetGet('txtNumDocumento');
        $sessionAfiliate->offsetSet('costoTotal',$dataPago['costoTotal']);
        return new ViewModel(array('dataPago' => $dataPago));

    }

    private function cantVehiculos($session)
    {
        $keys = $this->obtenerKeys($session->maxVehiculos);
        $c = 0;
        foreach ($keys as $key) {
            if ($session->offsetExists('idTipoVehiculo' . $key)) {
                $c++;
            }
        }
        $session->offsetSet('numVehicle',$c);
        return $c;
    }
    
    private function clearVehicle($session)
    {
        $keys = $this->obtenerKeys($session->maxVehiculos);
        $c = 0;
        foreach ($keys as $key) {
            if ($session->offsetExists('idTipoVehiculo'.$key)) {
                $session->offsetUnset('idTipoVehiculo'.$key);
            }
        }
        $session->offsetSet('numVehicle',0);
        return $c;
    }

    /* =================Final del proceso=============== */

    private function findUsers($correo)
    {
        $usersModel = $this->getServiceLocator()->get('UsersModel');
        $id = $usersModel->findUsersByCorreo($correo);
        return $id;

    }

    private function findUsersPlans($correo, $idPlan)
    {
        $usersModel = $this->getServiceLocator()->get('UsersModel');
        $id = $usersModel->findUsersPlanByCorreo($correo, $idPlan);
        return $id;

    }

    private function findUsersPlansByCorreo($correo, $idPlan) {
        $usersModel = $this->getServiceLocator()->get('UsersModel');
        $id = $usersModel->findUsersPlanByEmail($correo, $idPlan);
        return $id;
    }

    private function findUsersPlanTruncoByCorreo($correo, $idPlan) {
        $usersModel = $this->getServiceLocator()->get('UsersModel');
        $id = $usersModel->findUsersPlanTruncoByEmail($correo, $idPlan);
        return $id;
    }
    
    private function findPlans($correo) {
        $usersModel = $this->getServiceLocator()->get('UsersModel');
        $id = $usersModel->findPlansByEmail($correo);
        return $id;
    }
    
    public function ajaxFindUserAction()
    {
        $data = [
            'code' => 200,
            'flag' => 0,
            'mensaje' => 'No eres Post xD'
        ];
        if ($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPost();
            if (filter_var($post['txtCorreo'], FILTER_VALIDATE_EMAIL)) {
                $idUser=$this->findUsers($post['txtCorreo']);
                if ($idUser) {
                    $data['mensaje'] = 'registrado sin plan';
                    $data['flag'] = 1;
                    /*if ($this->findUsersPlans($post['txtCorreo'],
                                    $post['idPlan'])) {
                        $data['mensaje'] = 'registrado con plan';
                        $data['flag'] = 4;
                    }*/
                    if ($this->findUsersPlansByCorreo($post['txtCorreo'], $post['idPlan'])) {
                        $session_validate_plan_with_login = new Container('validate_plan_with_session');
                        $session_validate_plan_with_login->offsetSet('id_user_validate_plan_in_session',$idUser['id']);
                        $data['mensaje'] = 'registrado con este plan';
                        $data['flag'] = 4;
                    }else {
                        if($this->findPlans($post['txtCorreo'])) {
                            $data['mensaje'] = 'registrado con otro plan y activo';
                            $data['flag'] = 6;
                        }else {
                            if ($this->findUsersPlanTruncoByCorreo($post['txtCorreo'], $post['idPlan'])) {
                                $data['mensaje'] = 'registrado con este plan de forma trunca';
                                $data['flag'] = 5;
                                $data['id'] = $this->findUsers($post['txtCorreo'])['id'];
                            }else {
                                $data['mensaje'] = 'registrado con otro plan trunco';
                                $data['flag'] = 7;
                                $data['id'] = $this->findUsers($post['txtCorreo'])['id'];
                            }
                        }
                    }
                } else {
                    $data['flag'] = 2;
                    $data['mensaje'] = 'no registrado';
                }
            } else {
                $data['flag'] = 3;
                $data['mensaje'] = 'correo invalido';
            }
        }
        return new JsonModel($data);

    }

    public function ajaxVehiclesAction()
    {
        $data = [
            'code' => 200,
            'flag' => 0,
            'mensaje' => 'No eres Post xD'
        ];
        if ($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPost();
            if ($this->findVehicles($post['txtPlaca'])) {
                $data['mensaje'] = 'registrado';
                $data['flag'] = 1;
            } else {
                $data['flag'] = 2;
                $data['mensaje'] = 'no registrado';
            }
        }
        return new JsonModel($data);

    }

    private function findVehicles($placa)
    {
        $mpe = $this->getServiceLocator()->get('mpe');
        $rs = FALSE;
        $params = array(
            "req_TagPlate" => $placa
        );
        $rq = $mpe->getValidateTagPlate($params);
        if ($rq->status === 'ok') {
            $rs = TRUE;
        }
        return $rs;

    }

    public function preguntasFrecuentesAction()
    {
        return new ViewModel();

    }

    public function reclamacionesAction()
    {
        $form = new ReclamacionesForm();
        $request = $this->getRequest();
        $ALinkedListTable = $this->getServiceLocator()->get('Epass\Model\ALinkedListTable');
        $dpto = $ALinkedListTable->getUbigeofetchPairs(array('LIST' => ALinkedListTable::DEPARTAMENTOS));
        $form->setAddressValues('address_1', $dpto);

        if ($request->isPost()) {

            $config = $this->getServiceLocator()->get('config');
            $data = $request->getPost();

            if ($data['consumer_type'] == 'natural') {
                unset($data['company']);
                unset($data['business_name']);
                unset($data['ruc']);
            } else {
                unset($data['first_name']);
                unset($data['last_name']);
                unset($data['document_type']);
                unset($data['document_number']);
            }

            $ALinkedListTable = $this->getServiceLocator()->get('Epass\Model\ALinkedListTable');
            $Provin = $ALinkedListTable->getUbigeofetchPairs(array('LIST' => ALinkedListTable::PROVINCIAS, 'DEPINDEX' => $data['address_1']));
            $Distrito = $ALinkedListTable->getUbigeofetchPairs(array('LIST' => ALinkedListTable::DISTRITOS, 'DEPINDEX' => $data['address_2']));

            if (isset($provinvia) || isset($distrito)) {
                //return $this->redirect()->toRoute('home');
                $form->setAddressValues('address_2', $Provin);
                $form->setAddressValues('address_3', $Distrito);
            }
            $form->setData($data);

            if ($form->isValid()) {
                $response = $this->saveReclamacion($data);

                if ($response > 0) {

                    $departamento = $ALinkedListTable->getUbigeofetchPairs(array(
                        'LIST' => ALinkedListTable::DEPARTAMENTOS,
                        'INDEX' => $data['address_1']
                    ));
                    $provinvia = $ALinkedListTable->getUbigeofetchPairs(array(
                        'LIST' => ALinkedListTable::PROVINCIAS,
                        'DEPINDEX' => $data['address_1'],
                        'INDEX' => $data['address_2']
                    ));
                    $distrito = $ALinkedListTable->getUbigeofetchPairs(array(
                        'LIST' => ALinkedListTable::DISTRITOS,
                        'DEPINDEX' => $data['address_2'],
                        'INDEX' => $data['address_3']
                    ));
                    // Envio de email
                    $data['address_1'] = $departamento[$data['address_1']];
                    $data['address_2'] = $provinvia[$data['address_2']];
                    $data['address_3'] = $distrito[$data['address_3']];

                    $email = $config['email_from_reclamacion'];
                    $this->sendMessage('Libro de Reclamaciones',
                            'libroReclamaciones.phtml', $email, $data);

                    $this->flashMessenger()->addSuccessMessage('Su reclamo ingresó correctamente. En breve, nuestra área de Atención al Cliente se comunicará con usted.');

                    return $this->redirect()->toRoute('home');
                } else {
                    $this->flashMessenger()->addErrorMessage('Ocurrio un problema al enviar su formulario.');
                }
            } else {
                flog($form->getMessages());
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);

    }

    public function contactoAction()
    {
        $config = $this->getServiceLocator()->get('config');

        $form = new ContactanosForm();
        $request = $this->getRequest();
        if ($request->isPost()) {

            $contactanos = new Contactanos();
            $data = $request->getPost();

            $form->bind($contactanos);
            $form->setData($data);
            if ($form->isValid()) {
                try {
                    $response = $this->saveContactanos($data);
                    flog($response);

                    if ($response > 0) {
                        try {
                            $dataMail = array(
                                'asunto' => $data['asunto'],
                                'email' => $data['correo'],
                                'tipo' => \Epass\Enum\EmailType::WITH_TEMPLATE_RECEIVE,
                                //'tipo' => \Epass\Enum\EmailType::WITH_TEMPLATE,
                                'template' => EMAIL_PATH . "/contacto.phtml",
                                'data' => array(
                                    'nombre' => $data['nombre'] . ' ' . $data['apellidos'],
                                    'correo' => $data['correo'],
                                    'asunto' => $data['asunto'],
                                    'mensaje' => $data['mensaje'],
                                    'telefono1' => $data['telefono_contacto'],
                                    'telefono2' => $data['telefono_adicional'],
                                    'mailAdmin' => $config['mail']['toEmailAdmin']
                                ),
                            );

                            $this->getEventManager()->trigger(\Epass\Event\Listener::MAIL_EVENT,
                                    $this, $dataMail);

                            $this->flashMessenger()->addSuccessMessage('El mensaje fue enviado.');
                            return $this->redirect()->toRoute('home');
                        } catch (Exception $ex) {
                            $this->flashMessenger()->addErrorMessage('No se envío el mensaje.');
                            return $this->redirect()->toRoute('home');
                        }
                    } else {
                        $this->flashMessenger()->addErrorMessage('Error... No se envío el mensaje.');
                    }
                } catch (Exception $ex) {
                    $this->flashMessenger()->addErrorMessage('Error... No se envío el mensaje.');
                }
            } else {
                flog($form->getMessages());
            }
        }

        return new ViewModel([
            'form' => $form
        ]);

    }

    public function sendMessage($asunto, $plantilla, $email, $datos = NULL)
    {
        try {
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

    private function saveContactanos($data)
    {
        $dataInsert['name'] = $data['nombre'];
        $dataInsert['lastname'] = $data['apellidos'];
        $dataInsert['telefono1'] = $data['telefono_contacto'];
        $dataInsert['telefono2'] = $data['telefono_adicional'];
        $dataInsert['email'] = $data['correo'];
        $dataInsert['subject'] = $data['asunto'];
        $dataInsert['message'] = $data['mensaje'];
        $dataInsert['created_at'] = date("Y-m-d H:i:s");
        $dataInsert['updated_at'] = date("Y-m-d H:i:s");

        $table = $this->getServiceLocator()->get('ContactanosModel');

        return $table->save($dataInsert);

    }

    private function saveReclamacion($data)
    {
        $keys = ['consumer_type', 'document_type', 'document_number', 'first_name', 'last_name',
            'company', 'business_name', 'ruc', 'home_phone', 'mobile_phone', 'email',
            'address_1', 'address_2', 'address_3', 'address_4', 'address_5', 'description', 'detail', 'accept_terms'];

        foreach ($keys as $key) {
            if (array_key_exists($key, $data) || !empty($data[$key])) {
                $dataInsert[$key] = $data[$key];
            }
        }

        $table = $this->getServiceLocator()->get('ReclamacionesModel');

        return $table->save($dataInsert);

    }

    public function terminosCondicionesAction()
    {
        $this->layout()->setVariable('terminos', true);
        return new ViewModel();

    }

    private function existSession($redirect)
    {
        $sa = new Container('afiliacion');
        if (!$sa->offsetExists('title')) {
            $this->flashMessenger()->addErrorMessage('Necesitas seleccionar un paquete.');
            return $this->redirect()->toUrl($redirect);
        }

    }

    private function validarSession($data, $redirect)
    {
        $auth = $this->getServiceLocator()->get('AuthService');
        if ($auth->hasIdentity()) {
            $data_sesion_user = $auth->getStorage()->read();
            $idUser = $data_sesion_user->id;
            $idPlan = $data['idPlan'];
            if ($this->userHavePlan($idUser, $idPlan)) {
                /*$container = new Container('validate_plan_with_session');
                $container->exchangeArray(array());
                $redirect = '/mi-cuenta/recarga-directa';
                return $redirect;*/
                $session_validate_plan_with_login = new Container('validate_plan_with_session');
                $session_validate_plan_with_login->offsetSet('id_user_validate_plan_in_session',$idUser);
                return false;
            } else {
                if (!$this->userHaveTypePlan($idUser, $idPlan)) {
                    $session_validate_plan_with_login = new Container('validate_plan_with_session');
                    $session_validate_plan_with_login->offsetSet('id_user_validate_plan_in_session',
                            $idUser);
                    return false;
                } else {
                    $container = new Container('validate_plan_with_session');
                    $container->exchangeArray(array());
                    $service = $this->getServiceLocator()->get('Popup');
                    $data_message = array(
                        'message' => 'Usted ya cuenta con este tipo de plan.'
                    );
                    $service->addParams($data_message);
                    $service->setTemplate('renders/modal_afiliacion_messages');
                    return $redirect;
                }
            }
        } else {
            $container = new Container('validate_plan_with_session');
            $container->exchangeArray(array());
        }

    }

    private function userHaveTypePlan($idUser, $idPlan)
    {
        $mpe = $this->getServiceLocator()->get('mpe');
        $data_plans = $mpe->getAllPlansByProduct(array('req_ProductId' => 1));
        $userPlansModel = $this->getServiceLocator()->get('UserPlansModel');

        $data_user = $userPlansModel->getPlansbyUser($idUser);
        $plans = $this->getPlans($data_plans->data->allPlansByProductDefinition);
        $plan_request = $plans[$idPlan];
        $plans_user = "";
        foreach ($data_user as $data_user_plan) {
            $plans_user .= $plans[$data_user_plan['plan_id']];
        }

        if (stripos($plans_user, $plan_request) !== false) {
            return true;
        }

        return false;

    }

    private function userHavePlan($idUser, $idPlan)
    {
        $userPlansModel = $this->getServiceLocator()->get('UserPlansModel');
        $result = $userPlansModel->isPlansFromUser($idUser, $idPlan);
        if (!empty($result)) {
            return true;
        } else {
            return false;
        }

    }

    private function setDataFormWithSessionData(&$form, $esEmpresa = false)
    {
        $session_validate_plan_with_login = new Container('validate_plan_with_session');

        if ($session_validate_plan_with_login->offsetExists('id_user_validate_plan_in_session')) {

            $session_validate_plan_with_login = new Container('validate_plan_with_session');
            $idUser = $session_validate_plan_with_login->id_user_validate_plan_in_session;

            $sessionAfiliacion = new Container('afiliacion');
            $auth = $this->getServiceLocator()->get('AuthService');
            $data_sesion_user = $auth->getStorage()->read();

            $userModel = $this->getServiceLocator()->get('UsersModel');
            $user = $userModel->getUser($idUser);
            $userPlansModel = $this->getServiceLocator()->get('UserPlansModel');
            $result = $userPlansModel->getDataByIdUser($data_sesion_user->id);

            if ($esEmpresa) {
                $sessionAfiliacion->offsetSet('txtNombreTitular', '');
                $sessionAfiliacion->offsetSet('tipoDoc', '');
                $sessionAfiliacion->offsetSet('txtNumDocumento','');
                $sessionAfiliacion->offsetSet('txtTelefono', '');
                $sessionAfiliacion->offsetSet('txtCorreo', $user['email']);
                $sessionAfiliacion->offsetSet('isContactEmpresa', 1);
            }else{
                $sessionAfiliacion->offsetSet('txtNombreTitular', $user['name']);
                if(trim($user['lastname'])=='' || $user['lastname']== null){
                    $sessionAfiliacion->offsetSet('haveApellidosTitular', false);
                }else{
                    $sessionAfiliacion->offsetSet('haveApellidosTitular', true);
                }
                
                $sessionAfiliacion->offsetSet('txtApellidosTitular', $user['lastname']);
                $sessionAfiliacion->offsetSet('txtCorreo', $user['email']);
                $sessionAfiliacion->offsetSet('isContactEmpresa', 0);
                if (!empty($result['document_type_id']) && $result['description']!='RUC') {
                    $sessionAfiliacion->offsetSet('tipoDoc', $result['document_type_id']);
                }else{
                    $sessionAfiliacion->offsetSet('tipoDoc', '');
                }
                
                if(!empty($result['document_number']) && $result['description']!='RUC'){
                    $sessionAfiliacion->offsetSet('txtNumDocumento',$result['document_number']);
                }else{
                    $sessionAfiliacion->offsetSet('txtNumDocumento','');
                }
                
                if(!empty($result['telephone'])){
                    $sessionAfiliacion->offsetSet('txtTelefono',$result['telephone']);
                }else{
                    $sessionAfiliacion->offsetSet('txtTelefono','');
                }
                
            }

            $sessionAfiliacion->offsetSet('isLoggedUser', true);
            
            $form->get("isUserSessionActive")->setValue(1);
        }

    }

    private function getPlans($plans)
    {
        $plans_data = array();
        foreach ($plans as $plan) {
            $string = $plan->req_Name;
            if (stripos($string, 'individual') !== false) {
                $plans_data[$plan->req_PlanId] = 'individual';
            } elseif (stripos($string, 'familiar') !== false) {
                $plans_data[$plan->req_PlanId] = 'familiar';
            } elseif (stripos($string, 'corporativo') !== false) {
                $plans_data[$plan->req_PlanId] = 'corporativo';
            } else {
                $plans_data[$plan->req_PlanId] = 'recarga';
            }
        }
        return $plans_data;

    }

}
