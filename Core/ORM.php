<?php

namespace Core;

/**
 * ORM Core
 */
class ORM {
    private $schemaFile;

    public function __construct() {
        $this->schemaFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . $_SERVER['schemaFile'];
    }

    /**
     * Load datafile schema data
     */
    private function getSchemaData() {
        return json_decode(file_get_contens($this->schemaFile), true);
    }

    /**
     * Truncate a table
     */
    public function truncate() {
        $this->write(null);
    }

    /**
     * Persists a row in datafile
     */
    private function write(\Core\Model $model) {
        $schemaData = $this->getSchemaData();
        $table = $model->getTable();
        $pk = $model->getPk();
        
        $data = $model->getData();
        if ($data !== null) {
            if (isset($schemaData[$table][$pk])) {
                // Updates a row
                $schemaData[$table] = $data;
            }
            else {
                // Inserts a row
                $schemaData[$table] = $data;
            }
        }
        else {
            // Remove a row
            unset($schemaData[$table]);
        }

        file_put_contents($this->schemaFile, $schemaData);
    }

    private function read() {

    }
}