<?php

namespace Application\Model\DAO;

use Application\Model\Adapter\IDataAccessAdapter;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserDao
 *
 * @author Raul Quispe
 */
class UserDao {
    
    private $adapter;
    private $data;
    
    public function __construct(IDataAccessAdapter $adapter = null)
    {
        if ($adapter) {
            $this->adapter = $adapter;
            $json = $this->adapter->read();
            $this->data =  $json['users']['data'][0];
        }
       
    }
    
    public function getAdapter()
    {
        $this->adapter;
    }
    
    public function setAdapter(IDataAccessAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function getUsersForPage($page = 1, $cantItemsByPage = 5, $data = null)
    {
        if (!$data) {
            $data = $this->data;
        }
        $cantUsers = count($data);
        $posicionInicial = ($page - 1) * $cantItemsByPage;
        
        if ($cantUsers % $cantItemsByPage == 0) {
            $posicionFinal = $page * $cantItemsByPage;
        } else {
            $posicionFinal = ($page * $cantItemsByPage) -  ($cantItemsByPage - $cantUsers % $cantItemsByPage);
        }
        
        $result = array();

        for ($i = $posicionInicial; $i < $posicionFinal; $i ++) {
            $result[] = $data[$i];
        }
                
        return $result;
        
    }
    
    public function getCountUsers()
    {
        return count($this->data);
    }
    
    public function getUserByQuery($queryParams)
    {
        $result = array();
        $temp = null;
        
        foreach($this->data as $usuario) {
            
            foreach ($queryParams as $key => $value) {
                if ($usuario[$key] == $value) {
                    $temp = $usuario;
                } else {
                    $temp = null;
                }
            }
            if ($temp) {
                $result[] = $temp;
            }
            
        }
        return $result;
    }
    
    
    
}
