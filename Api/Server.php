<?php
    
    namespace Api;

    class Server {

        /**
         * Reset state before starting tests
         */
        static function reset() {
            return \Services\Accounts::closeAll();
        }

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

        static function balance($payload) {
            $accountId = $payload['account_id'];
            $res = \Services\Accounts::getBalance($accountId);
            return $res;
        }
    }