<?php

namespace Core;

class ORM {
    private $fileData;
    private $handle;

    public function __construct() {
        $this->fileData = dirname(__FILE__) . '/data.json';
    }

    private function openConnection() {
        if (!$this->handle) {
            $this->handle = fopen($this->fileData, 'w+');
        }
    }

    private function closeConnection() {
        if ($this->handle) {
            fclose($this->handle);
        }
    }

    public function truncateTable($table) {

    }

    private function writeToTable($table) {

    }

    private function readFromTable($table) {

    }
}