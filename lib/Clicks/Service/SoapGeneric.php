<?php

namespace Clicks\Service;

use SoapClient;

class SoapGeneric
{

    /**
     * Configuraciones del soap
     *
     * @var array
     */
    protected $options = array();
    protected static $instance;
    protected $crypto;

    /**
     * Ejecutar el servicio
     *
     * @param string $service Nombre del servicio
     * @param array  $data    Data
     *
     * @return array pizza list
     */
    public function loadService($service, $data)
    {
        try {
            $soap = new SoapClient(
                    $this->options['url'],
                    empty($this->options['option']) ? array() : $this->options['option']
            );
            $soap->setLocation($this->options['location']);
            $info = $soap->$service($data);
            return $info;
        } catch (\Exception $e) {
//            echo "Error con Service " . $service;
            //return false;
            echo $e->getMessage();
        }
    }

    /**
     * Ejecutar el servicio
     *
     * @param string $options Nombre del servicio
     *
     * @return array pizza list
     */
    final public static function getInstance($options = null)
    {
        $class = static::getClass();
        if (!isset(static::$instance[$class])) {
            static::$instance[$class] = new $class($options);
        }

        return static::$instance[$class];
    }

    final public static function getClass()
    {
        return get_called_class();
    }

    /**
     * Descripcion
     *
     * @param string $data Description
     *
     * @return void
     */
    public function dataToArray($data)
    {
        $data = explode('|', $data);

        $rpta = array();
        foreach ($data as $key => $value) {
            $temp = explode('=', $value);
            $rpta[$temp[0]] = $temp[1];
        }

        return $rpta;
    }
    
    
}
