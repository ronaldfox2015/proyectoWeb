<?php 
namespace Epass\Service;

class FtpService
{
	protected $config;    
        protected $conn; 
        
    public function setConfig($value)
    {
        $this->config = $value;
    }
    public function connect()
    {
        try {
    		$this->conn = ftp_connect($this->config['server'], 21);
                $login = ftp_login($this->conn, $this->config['user'], $this->config['password']);
                
                ftp_pasv($this->conn, true);
	        if (!$this->conn || !$login) {
	            return false;
	        } else {
                    return true;
                }    
            } catch (\Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }
    public function getFiles($version, $directory = '.')
    {
    	try {

            $contents = ftp_nlist($this->conn, $directory);   
            if($contents)
            {
                $res = array();
                foreach($contents as $v)
                {
                    if(!in_array($v,$version))
                        $res[] = $v;
                }
                return $res;			
            } else {
                return false;
            }
    	} catch (\Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }   
    public function getFileSize($fileServer)
    {
    	try {
            $res = ftp_size($this->conn, $fileServer);
            if ($res < 1)
                return false;
            else
                return true;			
    	} catch (\Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }
    public function getFile($fileServer, $fileLocal)
    {
    	try {
            $previous = libxml_use_internal_errors(true);    
	    $result = ftp_get($this->conn, $fileLocal, $fileServer, FTP_BINARY);
            libxml_use_internal_errors($previous);
	    return $result;			
    	} catch (\Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }
    public function moveFile($fileServer, $fileServerProcess)
    {
    	try {

	    $result = ftp_rename($this->conn, $fileServer, $fileServerProcess);
  
	    return $result;			
    	} catch (\Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }
    public function close()
    {
    	try {
                $result = ftp_close($this->conn);
	    return $result;			
    	} catch (\Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }
}