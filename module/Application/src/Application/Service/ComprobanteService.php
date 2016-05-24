<?php

namespace Application\Service;

use stdClass;
use Zend\Debug\Debug;
use Zend\Soap\Client;
use Zend\Soap\Exception\Exception;

class ComprobanteService
{

    /**
     * @var array
     */
    protected $config;

    /**
     * @var \Zend\Soap\Client
     */
    protected $client;

    /**
     * Constructor
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $this->config = $config;
        $this->client = new Client($config['url-comprobante-ws']);

    }

    /**
     * Create account
     *
     * @param array $params
     * @return object
     */
    public function getDocumentoPDF($params)
    {
        $keys = ['_ruttEmpr', '_folioDTE', '_tipoDTE', '_serieInte', '_fechaDTE', '_monTotal'];

        if ($this->validate($keys, $params)) {
            try {
                $response = new stdClass();
                $response->code = 200;

                $obj = $this->client->getDocumentoPDF($params);
                $data = $obj->getDocumentoPDFResult->string;

                if (is_array($data)) {
                    if (!empty($data[1])) {
                        $response->status = 'ok';
                        $response->name = $data[0];
                        $response->data = $data[1];
                    } else {
                        $response->status = 'fail';
                        $response->message = $data;
                    }
                } else {
                    $response->status = 'fail';
                    $response->message = $data;
                }

                return $response;
            } catch (\SoapFault $e) {
                $response = new stdClass();
                $response->code = $e->getCode();
                $response->message = $e->getMessage();

                return $response;
            }
        }

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

}
