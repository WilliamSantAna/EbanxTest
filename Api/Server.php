<?php
    
    namespace Api;

    class Server {
        static function reset() {
            // Clear Accounts table data
            $account = new \Model\Account();
            $account->truncate();
        }

        static function event($post) {

        }

        static function balance($post) {

        }
    }