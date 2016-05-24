<?php
/**
 *
 * @author Martin Cruz <i@martincruz.me>
 */
namespace Application\Service;

use Zend\Cache\Storage\Adapter\Memcached;
use Zend\Cache\Storage\Adapter\MemcachedOptions;
use Zend\Cache\Storage\Adapter\MemcachedResourceManager;

/**
 * Class MemcachedService
 * @package Application\Service
 */
class MemcachedService
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var \Zend\Cache\Storage\Adapter\MemcachedResourceManager
     */
    protected $manager;

    /**
     * Default options
     *
     * @var \Zend\Cache\Storage\Adapter\MemcachedOptions
     */
    protected $options;

    /**
     * @var \Zend\Cache\Storage\Adapter\Memcached
     */
    protected $memcached;


    /**
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
        $this->manager = new MemcachedResourceManager();

        $this->manager->addServer('1', [
            $config['host'],
            $config['port']
        ]);

        $this->options = new MemcachedOptions([
            'resource_manager' => $this->manager,
            'resource_id'      => '1',
            'namespace'        => '',
            'ttl'              => '60',
        ]);
        $this->memcached = new Memcached($this->options);
       
    }

    /**
     * @param string $key  Unique
     * @param mixed  $data
     * @param int    $time Seconds
     * @return bool
     */
    public function setItem ($key, $data, $time = 60)
    {
        $this->options->setTtl($time);

        return $this->memcached->setItem($key, $data);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getItem($key)
    {
        return $this->memcached->getItem($key);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasItem ($key)
    {
        return $this->memcached->hasItem($key);
    }

    /**
     * @return bool
     */
    public function flush()
    {
        return $this->memcached->flush();
    }

    /**
     * @param string $namespace
     * @param string | int $uniqueKey
     * @return string
     */
    public function keyGenerate($namespace, $uniqueKey)
    {
        return strtolower($namespace) . '_' . strval($uniqueKey);
    }


    /**
     * @return Memcached
     */
    public function getMemcached()
    {
        return $this->memcached;
    }

    /**
     * @return MemcachedOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param MemcachedOptions $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }
    public function removecache($key)
    {
         $this->memcached->removeItem($key);
    }

}