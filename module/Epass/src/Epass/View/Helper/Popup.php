<?php
namespace Epass\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Epass\Service\PopupService as PopupService;

class Popup extends AbstractHelper
{

    const PLANTILLA_DEFAULT = 'renders/modal_comprobante';

    protected $serviceLocator;
    protected $popup;
    protected $config;
    protected $params = array();
    protected $template;


    //invocamos a la funcion
    public function __invoke()
    {
      $this->getDataPlugin();
      $this->renderCurrent();
    }

    public function __construct(){

    }

    public function setPopupPlugin(PopupService $Popup)
    {
      $this->popup=$Popup;
    }

    public function getPopup()
    {
      return $this->popup;
    }

    public function getParamsPlugin()
    {

      if($this->getPopup() instanceof PopupService){
          return $this->popup->getParams();
      }
      return array();

    }


    public function getTemplatePlugin()
    {
      return $this->popup->getTemplate();
    }

    public function getUse()
    {
      return $this->popup->getUse();
    }

    public function clearPlugin()
    {
      if ($this->popup instanceof PopupService) {
        $this->popup->clearPopup();
      }
      return false;

    }

    public function setConfig($config)
    {
      $this->config=$config;
    }

    public function getConfig()
    {
      return $this->config;
    }

    public function getDataPlugin()
    {
      $this->params=$this->getParamsPlugin();
      $this->template=$this->getTemplatePlugin();
      if($this->getUse()){
        $this->clearPlugin();
      }
    }

    public function getParams(){
      return $this->params;
    }



    public function getTemplate()
    {
      return $this->template;
    }

    public function renderCurrent()
    {
        $data=$this->getParams();
        $template=!empty($this->getTemplate())?$this->getTemplate():self::PLANTILLA_DEFAULT;

        if($data){
          $view = $this->getServiceLocator()->get('Zend\View\Renderer\RendererInterface');
          echo $view->partial($template,$data);
          $this->popup->setUse(true);
        }
    }

    public function setServiceLocator($serviceLocator)
    {
        $this->serviceLocator=$serviceLocator;
    }

    public function getServiceLocator()
    {
      return $this->serviceLocator;
    }

}
