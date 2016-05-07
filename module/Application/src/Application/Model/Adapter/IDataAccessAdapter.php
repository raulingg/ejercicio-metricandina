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

    /**
     * @return mixed array | object
     */
    public function read();

    /**
     * @param mixed $config array | object
     */
    public function setConfig($config);
}
