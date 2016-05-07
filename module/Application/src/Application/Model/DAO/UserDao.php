<?php

namespace Application\Model\DAO;

use Application\Model\Adapter\DataAccessJsonAdapter;
use Application\Model\Adapter\IDataAccessAdapter;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;


/**
 * UserDao : Objeto de acceso a datos para usuarios
 *
 * @author Raul Quispe
 */
class UserDao {

    /**
     * @var IDataAccessAdapter
     */
    private $adapter;
    /**
     * @var mixed Array | Object
     */
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

    public function read()
    {
        if ($this->adapter){
            $this->adapter = new DataAccessJsonAdapter();
        }

        $json = $this->adapter->read();
        $this->data =  $json['users']['data'][0];
    }

    public function getUsersByPage($page = 1, $cantItemsByPage = 5)
    {

        $cantUsers = count($this->data);
        $posicionInicial = ($page - 1) * $cantItemsByPage;
        $pageCantItemsByPage = $page * $cantItemsByPage;

        if ($cantUsers >= $pageCantItemsByPage) {
            $posicionFinal = $pageCantItemsByPage;
        } else {
            $posicionFinal = $cantUsers;
        }
        
        $result = array();
        
        for ($i = $posicionInicial; $i < $posicionFinal; $i ++) {
            $result[] = $this->data[$i];
        }
        
        unset($this->data);
        
        return $result;
        
    }
    
    public function getCountUsers()
    {
        return count($this->data);
    }
    
    public function filterDataByQuery($queryParams)
    {
        /**
         * Si no existen parámetros de consulta entonces no filtramos
         */
        if (empty($queryParams)) {
            return;
        }

        $dataFiltered = array();

        foreach($this->data as $usuario) {
            $temp = null;

            foreach ($queryParams as $keyQuery => $value) {
                if ($usuario[$keyQuery] == $value) {
                    $temp = $usuario;
                }  else {
                    $temp = null;
                    break;
                }
            }

            if ($temp) {
                $dataFiltered[]  = $temp;
            }
        }

        unset($this->data);
        $this->data = $dataFiltered;
    }
    
    
    
}
