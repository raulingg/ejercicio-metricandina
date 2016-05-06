<?php

namespace Application\Model\Adapter;

use Zend\Config\Reader\Json;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataAccessJsonAdapter
 *
 * @author Media
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
