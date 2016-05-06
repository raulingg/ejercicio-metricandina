<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rol
 *
 * @author Raul Quispe
 */
class Rol {
    
    private $id;
    private $isActive;
    private $actions;
    
    public function __construct() 
    {
        $this->actions = new ArrayObject();
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getIsActive()
    {
        return $this->isActive;
    }
    
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }
    
    public function getActions()
    {
        
    }
    
    public function addAction()
    {
        
    }
}
