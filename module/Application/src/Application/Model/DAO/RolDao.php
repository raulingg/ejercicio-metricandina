<?php

namespace Application\Model\DAO;

use Application\Model\Adapter\IDataAccessAdapter;
use Exception;


/**
 * RolDao : Data Access Object for roles
 *
 * @author Raul Quispe
 */
class RolDao {

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
            $this->data = $this->adapter->read();
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

    /**
     *
     * findById : Búsqueda de rol por id
     * @param $id identificador de rol
     * @return array
     */
    public function findById($id)
    {
        $result = null;
        foreach($this->data as $rol) {
            if ($rol['id'] == $id) {
                $result = $rol;
                break;
            }
        }
        return $result;
    }
    
    public function count()
    {
        return count($this->data);
    }
    
}
