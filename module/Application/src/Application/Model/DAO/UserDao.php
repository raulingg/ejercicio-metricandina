<?php

namespace Application\Model\DAO;

use Application\Model\Adapter\IDataAccessAdapter;
use Exception;


/**
 * UserDao : Data Access Object for usuarios
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
            $this->data =  $this->adapter->read();
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
            throw new Exception("Adapter not found");
        }

        $this->data = $this->adapter->read();
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

    /**
     *
     * findById : Búsqueda de usuario por id
     * @param $id identificador de usuario
     * @return array
     */
    public function findById($id)
    {
        $result = null;

        foreach($this->data as $usuario) {
            if ($usuario['id'] == $id) {
                $result = $usuario;
                break;
            }
        }
        return $result;
    }
    
    public function count()
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
