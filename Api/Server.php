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
                    $result = \Services\Accounts::deposit($id, $amount);
                    break;
                }
                case 'withdraw': {
                    $result = \Services\Accounts::withdraw($id, $amount);
                    break;
                }
                case 'transfer': {
                    $result = \Services\Accounts::transfer($id, $amount);
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