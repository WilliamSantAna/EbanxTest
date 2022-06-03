<?php

namespace Model;
use \Core\ORM;


class Accounts extends ORM {
    public $id;
    public $amount;

    public function __construct() {
        parent::__construct();
        $this->table = __CLASS__;
    }

}