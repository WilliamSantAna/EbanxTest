<?php

    namespace Core;
    use \Core\ORM;

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
    }