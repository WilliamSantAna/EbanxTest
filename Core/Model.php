<?php

    namespace Core;

    /**
     * Model Core
     */
    class Model extends ORM {
        protected $table;
        protected $pk;

        /**
         * Returns table name
         */
        protected function getTable() {
            return $this->table;
        }

        /**
         * Returns table primary key
         */
        protected function getPk() {
            return $this->pk;
        }

        /**
         * Returns all public prop data
         */
        public function getData() {

        }

        /**
         * Add data to model
         */
        public function addData($data) {

        }

        /**
         * Save data to table
         */
        public function save() {
            $reflect = new \ReflectionClass(__CLASS__);
            $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
            
            $data = [];
            foreach ($props as $prop) {
                $data[$prop->getName()] = $this->{$prop->getName()};
            }
            $this->write($data);
        }

        /**
         * Retrieve a row by its primary key value
         */
        public function find($key) {
            return $this->read($key);
        }
    }