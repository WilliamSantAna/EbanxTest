<?php

    namespace Core;

    /**
     * Model Core
     */
    class Model extends ORM {
        protected $table;
        protected $class;
        protected $pk;

        /**
         * Returns table name
         */
        protected function getTable() {
            return substr($this->class, strrpos($this->class, '\\') + 1);
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
            $reflect = new \ReflectionClass($this->class);
            $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);

            $data = [];
            foreach ($props as $prop) {
                $data[$prop->getName()] = $this->{$prop->getName()};
            }

            return $data;
        }

        /**
         * Add data to model
         */
        public function addData($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }

        /**
         * Save data to table
         */
        public function save() {
            return $this->write($this->getData());
        }

        /**
         * Retrieve a row by its primary key value
         */
        public function find($key) {
            return $this->read($key);
        }

        /**
         * Delete ALL rows in the table
         */
        public function deleteAll() {
            return $this->truncate();
        }
    }