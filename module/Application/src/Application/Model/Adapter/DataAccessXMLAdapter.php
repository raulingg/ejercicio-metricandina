<?php

namespace Application\Model\Adapter;

use Zend\Config\Reader\Xml;


/**
 * DataAccessXMLAdapter : Esta clase sirve de adaptador para el acceso a la
 * fuente de datos en formato XML
 *
 * @author Raul Quispe
 */
class DataAccessXMLAdapter implements IDataAccessAdapter{
    
    private $config;
    
    
    public function __construct($config = null) {
        if ($config) {
            $this->config = $config;
        }
    }
    
    public function setConfig($config)
    {
        $this->config = $config;
    }
    
    
    public function read()
    {
        $reader = new Xml();
        $data = $reader->fromFile($this->config['location'] . '/' . $this->config['file_name']);
        
        return $data;
    }
    
    
}
