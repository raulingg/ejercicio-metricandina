<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Application\Model;

use ArrayObject;
/**
 * Description of Usuario
 *
 * @author Media
 */
class Usuario {
    
    private $id;
    private $isActive;
    private $firstName;
    private $lastName;
    private $email;
    private $gender;
    private $age;
    private $phone;
    private $company;
    private $address;
    private $roles;
    
    public function __construct() 
    {
        $this->roles = new ArrayObject();
    }
    
    public  function getId()
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
    
    public function setIsActive($active)
    {
        $this->isActive = $active;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }
    
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    
    public function getLastName()
    {
        return $this->lastName;
    }
    
    public function setLastName($lastname)
    {
        $this->lastName = $lastname;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function getGender()
    {
        return $this->gender;
    }
    
    public function setGender($gender)
    {
        $this->gender = $gender;
    }
    
    public function getAge()
    {
        return $this->age;
    }
    
    public function setAge($age)
    {
        $this->age = $age;
    }
    
    public function getPhone()
    {
        return $this->phone;
    }
    
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    
    public function getCompany()
    {
        return $this->company;
    }
    
    public function setCompany($company)
    {
        $this->company = $company;
    }
    
    public function getAddress()
    {
        return $this->address;
    }
    
    public function setAddress($address)
    {
        $this->address = $address;
    }
    
    public function getRoles()
    {
        $this->roles;
    }
    
    public function addRole(Role $role)
    {
        
    }
}
