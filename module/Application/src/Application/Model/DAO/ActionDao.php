<?php

namespace Application\Model\DAO;

use Application\Model\Adapter\IDataAccessAdapter;
use Exception;


/**
 * ActionDao : Data Access Object for actions
 *
 * @author Raul Quispe
 */
class ActionDao {

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

        if ($this->data) {
            unset($this->data);
        }

        $this->data = $this->adapter->read();
    }

    /**
     *
     * findById : Búsqueda de action por id
     * @param $id identificador de action
     * @return array
     */
    public function findById($id)
    {
        $result = null;

        foreach($this->data as $action) {
            if ($action['id'] == $id) {
                $result = $action;
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
