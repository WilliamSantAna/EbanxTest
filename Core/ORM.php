<?php

namespace Core;

class ORM {
    private $schemaFile;
    private $handle;
    protected $table;

    public function __construct() {
        $this->schemaFile = dirname(__FILE__) . '/data.json';
    }

    private function open() {
        if (!$this->handle) {
            $this->handle = fopen($this->schemaFile, 'w+');
        }
    }

    private function close() {
        if ($this->handle) {
            fclose($this->handle);
        }
    }

    private function getSchemaData() {
        returnfile_get_contens($this->file);
    }

    public function truncate() {
        $this->write([]);
    }

    private function write(array $data) {
        $schemaData = $this->getSchemaData();
        $schemaData[$this->table] = $data;

    }

    private function read() {

    }
}