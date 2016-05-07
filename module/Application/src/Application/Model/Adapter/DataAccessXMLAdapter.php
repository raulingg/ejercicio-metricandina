<?php

namespace Application\Model\Adapter;

use Zend\Config\Reader\Xml;


/**
 * DataAccessXMLAdapter : This class serves as an adapter for access
 * to the data source in XML format
 *
 * @author Raul Quispe
 */
class DataAccessXMLAdapter implements IDataAccessAdapter{

    /**
     * @var mixed array | object
     */
    private $config;
    
    
    public function __construct($config = null) {
        if ($config) {
            $this->config = $config;
        }
    }

    /**
     * @param mixed $config array | object
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed array | Object
     * @throws
     */
    public function read()
    {
        $file = $this->config['location'] . '/' . $this->config['file_name'];

        if(!file_exists($file) || !is_readable($file)) {
            throw new \Exception("file not exits or not is readable");
        }

        $reader = new Xml();
        $data = $reader->fromFile($file);
        
        return $data['data']['role'];
    }
    
    
}
