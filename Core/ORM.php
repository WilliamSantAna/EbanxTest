<?php

namespace Core;

/**
 * ORM Core
 */
class ORM {
    private $schemaFile;

    public function __construct() {
        $this->schemaFile = $_SERVER['ROOT_PATH'] . DIRECTORY_SEPARATOR . $_SERVER['APP_CONFIG']->schemaFile;
    }

    /**
     * Load datafile schema data
     */
    private function getSchemaData() {
        try {
            $data = file_get_contents($this->schemaFile);
            return json_decode($data, true);
        }
        catch (\Exception $e) {
            # For some reason it didnt work
            # @TODO A logger must be implemented here
            # We are rethrowing this out because next methods may treat it
            throw $e;
        }
    }

    /**
     * Finds a row by its pk value
     */
    protected function read($key) {
        try {
            $schemaData = $this->getSchemaData();
            $table = $this->getTable();
            $pk = $this->getPk();
            foreach ($schemaData[$table] as $idx => $row) {
                if ($row[$pk] == $key) {
                    return ['idx' => $idx, 'data' => $row];
                }
            }
            return ['idx' => null, 'data' => null];
        }
        catch (\Exception $e) {
            # For some reason it didnt work
            # @TODO A logger must be implemented here
            return false;
        }
    }

    /**
     * Persists a row in datafile
     */
    protected function write($data) {
        try {
            $schemaData = $this->getSchemaData();       
            $table = $this->getTable();
            $pk = $this->getPk();
            $key = $data[$pk];
            $res = $this->read($key);
            //echo 'print_r($res): ' . print_r($res, 1);

            if ($res['idx'] !== null) {
                // Updates a row due its table row exists
                //echo '$res[idx]: ' . $res['idx'];
                $schemaData[$table][$res['idx']] = $data;
            }
            else {
                // Inserts a row in the end of table
                $schemaData[$table][] = $data;
            }
    
            file_put_contents($this->schemaFile, json_encode($schemaData));
            return true;
        }
        catch (\Exception $e) {
            # For some reason it didnt work
            # @TODO A logger must be implemented here
            return false;
        }
    }

    /**
     * Remove a row from datafile
     */
    protected function delete($key) {
        try {
            $schemaData = $this->getSchemaData();
            $table = $this->getTable();
            $res = $this->read($key);
            if ($res['idx'] !== null) {
                unset($schemaData[$table][$res['idx']]);
            }
            file_put_contents($this->schemaFile, json_encode($schemaData));
            return true;
        }
        catch (\Exception $e) {
            # For some reason it didnt work
            # @TODO A logger must be implemented here
            return false;
        }
    }

        /**
     * Truncate a table in datafile
     */
    protected function truncate() {
        try {
            $schemaData = $this->getSchemaData();
            $table = $this->getTable();
            $schemaData[$table] = [];
            file_put_contents($this->schemaFile, json_encode($schemaData));
            return true;
        }
        catch (\Exception $e) {
            # For some reason it didnt work
            # @TODO A logger must be implemented here
            return false;
        }
    }

}