<?php
abstract class Service
{
    protected $_options = array();
    protected static $_instance;
    /*
     * Ejecutar el servicio
     */
    public function _loadService($service, $data)
    {
        try {
            $soap = new Zend\Soap\Client($this->_options['url']);
            $info = $soap->$service($data);

            return $info;
        } catch (Exception $e) {
            return false;
        }
    }
    /*
     * Extraer una instancia de la aplicación
     * @param  string       $securityPath Carpeta donde se almacenan public.key y private.key
     * @return PagoEfectivo retorna la instancia de la clase
     */
    final public static function getInstance($options = null)
    {
        $class = static::getClass();
        if (!isset(static::$_instance[$class])) {
            static::$_instance[$class] = new $class($options);
        }

        return static::$_instance[$class];
    }
    /*
     * Captura el nombre de la clase
     */
    final public static function getClass()
    {
        return get_called_class();
    }

    public function getOptions()
    {
        return $this->_options;
    }
}
