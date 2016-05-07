<?php

namespace Application\Model\Adapter;

use Zend\Config\Reader\Json;

/**
 * DataAccessJsonAdapter : Esta clase sirve de adaptador para el acceso a la
 * fuente de datos en formato JSON
 *
 * @author Raul Quispe
 */
class DataAccessJsonAdapter implements IDataAccessAdapter{
    
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
        $reader = new Json();
        $data = $reader->fromFile($this->config['location'] . '/' . $this->config['file_name']);
        
        return $data;
    }
}
