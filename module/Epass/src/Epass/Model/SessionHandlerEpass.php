<?php
namespace Epass\Model;
use Zend\Session\SaveHandler\SaveHandlerInterface;

class SessionHandlerEpass implements SaveHandlerInterface
{
    /**
     * @var string Hash of session data read from storage
     */
    protected $_readHash;

    /**
     * @var string Default table name
     */
    protected $_tableName           = 'session';

    /**
     * @var string Default table primary key (session id)
     */
    protected $_tableColumnId       = 'id';

    /**
     * @var string Default session modified date/time column
     */
    protected $_tableColumnModified = 'modified';

    /**
     * @var string Default session lifetime column
     */
    protected $_tableColumnLifetime = 'lifetime';

    /**
     * @var string Default session data column
     */
    protected $_tableColumnData     = 'data';

    /**
     * @var string null|Zend_Db_Adapter_Abstract Database adapter - null if
     *                                             not set
     */
    protected $_dbAdapter;

    /**
     * @var int Session lifetime in seconds
     */
    protected $_lifetime;

    /**
     * Construct handler
     *
     * @param array|Zend_Config $config Handler configuration
     */
    public function __construct($config)
    {
        if ($config instanceof Zend_Config) {
            $config = $config->toArray();
        } elseif (! is_array($config)) {
            throw new Zend_Session_SaveHandler_Exception(
                '$config must be an instance of Zend_Config or an array');
        }

        foreach ($config as $key => $val) {
            if (property_exists($this, '_' . $key)) {
                $this->{'_' . $key} = $val;
            } else {
                throw new Zend_Session_SaveHandler_Exception(
                                                'Invalid config: ' . $key);
            }
        }
    }

    /**
     * Returns the configured database adapter
     *
     * @return Zend_Db_Adapter Database adapter
     */
    protected function _getDbAdapter()
    {
        if (! $this->_dbAdapter instanceof Zend_Db_Adapter_Abstract) {
            throw new Exception(
                'Db adapter not set or not instance of Zend_Db_Adapter_Abstract');
        }

        return $this->_dbAdapter;
    }

    /**
     * Returns the default or configured lifetime in seconds
     *
     * @return int Lifetime
     */
    protected function _getLifetime()
    {
        if (! is_int($this->_lifetime)) {
            $this->_lifetime = (int) ini_get('session.gc_maxlifetime');
        }

        if (! is_int($this->_lifetime)) {
            throw new Exception(
                'Lifetime expects to be an integer');
        }

        return $this->_lifetime;
    }

    /**
     * Open Session - retrieve resources
     *
     * @param string $save_path
     * @param string $name
     */
    public function open($save_path, $name)
    {
        $this->_sessionSavePath = $save_path;
        $this->_sessionName     = $name;

        return true;
    }

    /**
     * Close Session - free resources
     *
     */
    public function close()
    {
        return true;
    }

    /**
     * Read session data
     *
     * @param string $id
     */
    public function read($id)
    {
        $db = $this->_getDbAdapter();

        $select = $db->select();

        $select->from($this->_tableName, array($this->_tableColumnId,
                                               $this->_tableColumnModified,
                                               $this->_tableColumnLifetime,
                                               $this->_tableColumnData))

               ->where($this->_tableColumnId . ' = ?', $id);

        if (! ($row = $select->query()->fetch())) {
            return '';
        }

        if ($this->_getExpirationTime($row[$this->_tableColumnModified],
                                      $row[$this->_tableColumnLifetime]) > time()) {

            $data = stripslashes($row[$this->_tableColumnData]);

            $this->_readHash = md5($data);

            return $data;
        }

        $this->destroy($id);

        return '';
    }

    /**
     * Write Session - commit data to resource
     *
     * @param string $id
     * @param mixed $data
     */
    public function write($id, $data)
    {   
        $db = $this->_getDbAdapter();

        $recordData = array();
        
        if ($this->_readHash != md5($data)) {
            $recordData[$this->_tableColumnData] = addslashes($data);
        }

        unset($data);

        $recordData[$this->_tableColumnModified] = time();

        if ($this->_readHash !== null) {
            return (bool) $db->update($this->_tableName,
                                      $recordData,
                                      $this->_tableColumnId
                                        . ' = ' . $db->quote($id));
        } else {

            $recordData[$this->_tableColumnId] = $id;
            $recordData[$this->_tableColumnLifetime] = $this->_getLifetime();

            return (bool) $db->insert($this->_tableName, $recordData);
        }
    }

    /**
     * Destroy Session - remove data from resource for
     * given session id
     *
     * @param string $id
     */
    public function destroy($id)
    {
        $db = $this->_getDbAdapter();

        return (bool) $db->delete($this->_tableName,
                                  $this->_tableColumnId
                                    . ' = ' . $db->quote($id));
    }

    /**
     * Garbage Collection - remove old session data older
     * than $maxlifetime (in seconds)
     *
     * @param int $maxlifetime
     */
    public function gc($maxlifetime)
    {
        $db = $this->_getDbAdapter();

        $db->delete($this->_tableName,
                    $this->_tableColumnModified
                    . ' + ' . $this->_tableColumnLifetime
                    . ' < ' . time());

        return true;
    }

    /**
     * Retrieve session expiration time
     *
     * @param int $modified
     * @param int $lifetime
     *
     * @return int
     */
    protected function _getExpirationTime($modified, $lifetime)
    {
        return (int) $modified + $lifetime;
    }
}