<?php

namespace Application\Model\Adapter;

use Zend\Config\Reader\Xml;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataAccessXMLAdapter
 *
 * @author Media
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
