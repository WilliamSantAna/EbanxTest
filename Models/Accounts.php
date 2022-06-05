<?php

namespace Models;
use \Core\Model;

/**
 * Accounts Model
 */
class Accounts extends Model {
    public $id;
    public $amount;

    public function __construct() {
        parent::__construct();
        $this->class = __CLASS__;
        $this->pk = 'id';
    }

}