<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Action
 *
 * @author Raul Quispe
 */
class Action {
   
    private $id;
    private $name;
    private $actionToken;
    
    public function __construct() 
    {
    
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getActionToken()
    {
        return $this->actionToken;
    }
    
    public function setActionToken($actionToken)
    {
        $this->actionToken = $actionToken;
    }
    
}
