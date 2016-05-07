<?php

namespace Application\Model\Adapter;


/**
 * DataAccessCsvAdapter : This class serves as an adapter for access
 * to the data source in CSV format
 *
 * @author Raul Quispe
 */
class DataAccessCsvAdapter implements IDataAccessAdapter {

    /**
     * @var mixed array | object
     */
    private $config;


    public function __construct($config = null) {
        if ($config) {
            $this->config = $config;
        }
    }

    /**
     * @param mixed $config array | object
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed array | Object
     * @throws
     */
    public function read()
    {
        $file = $this->config['location'] . '/' . $this->config['file_name'];

        if(!file_exists($file) || !is_readable($file)) {
            throw new \Exception("file not exits or not is readable");
        }

        $header = null;
        $data = array();
        if ($handle = fopen($file, 'r')) {
            while ($row = fgetcsv($handle, 1000, ',')) {
                if (!$header) {
                    foreach ($row as $key => $keynameCvs) {
                        if (!substr_compare($keynameCvs, " ", 0 , 1)) {
                            $newKeynameCvs = str_replace(" ", "", $keynameCvs);
                            $row[$key] = $newKeynameCvs;
                        }
                    }
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        return $data;

    }
}
