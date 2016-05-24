<?php

namespace Application\Service;


class GoogleApiService {

    protected $serviceLocator;
    protected $config;
    
    public function __construct(\Google_Client $client = null)
    {
        if (!$client) {
            $client = new \Google_Client();
            $path = APPLICATION_PATH . '/config/autoload/auth/service-account.json';
            putenv('GOOGLE_APPLICATION_CREDENTIALS='.$path);
            $client->useApplicationDefaultCredentials();
            $client->setScopes(\Google_Service_Storage::DEVSTORAGE_READ_WRITE);
        }
        $this->service = new \Google_Service_Storage($client);
    }
    
    public function upload($file) 
    {
        $obj = new \Google_Service_Storage_StorageObject();
        $obj->setName($file);
        $localFilePath = PUBLIC_PATH . '/download/'. $file;
        $obj = $this->service->objects->insert($this->config['bucket'], $obj, array(
            'data' => file_get_contents($localFilePath),
            'uploadType' => 'media',
            'name' => $file,
            'predefinedAcl' => 'publicread',
        ));
        return $obj->getMediaLink();
    }

    public function setConfig($config)
    {
        $this->config = $config;
    }

}
