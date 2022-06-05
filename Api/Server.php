<?php
    
    namespace Api;

    /**
     * class Server
     */
    class Server {

        /**
         * Reset state before starting tests
         */
        static function reset() {
            return \Services\Accounts::closeAll();
        }

        /**
         * Returns a call to an event (deposit, withdraw, transfer)
         */
        static function event($payload) {
            switch ($payload['type']) {
                case 'deposit': {
                    $destination = $payload['destination'];
                    $amount = $payload['amount'];
                    $result = \Services\Accounts::deposit($destination, $amount);
                    break;
                }
                case 'withdraw': {
                    $origin = $payload['origin'];
                    $amount = $payload['amount'];
                    $result = \Services\Accounts::withdraw($origin, $amount);
                    break;
                }
                case 'transfer': {
                    $origin = $payload['origin'];
                    $destination = $payload['destination'];
                    $amount = $payload['amount'];
                    $result = \Services\Accounts::transfer($origin, $destination, $amount);
                    break;
                }
                default: {
                    $result = ['code' => 404, 'body' => 0];
                }
            }

            return $result;
        }

        /**
         * Returns the balance of an account (if it exists, of course)
         */
        static function balance($payload) {
            $accountId = $payload['account_id'];
            return \Services\Accounts::getBalance($accountId);
        }
    }