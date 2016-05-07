<?php

namespace Application\Model\Adapter;

/**
 * IDataAccessAdapter : Contrato para la implementaci�n del Patron Adapter
 * con la finalidad de que nuestra aplicaci�n sea flexible al cambio de la capa
 * de acceso a datos
 *
 * @author Raul Quispe
 */
interface IDataAccessAdapter {
    
    public function read();
    
    public function setConfig($config);
}
