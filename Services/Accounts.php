<?php

namespace Services;

/**
 * Accounts Service class 
 */
class Accounts {
    
    /**
     * Put an amount in
     */
    static function deposit($destination, $amount) {
        $accounts = new \Models\Accounts();
        $res = $accounts->find($destination);
        if ($res['idx'] === null) {
            # Do not exists an account with this destination. Lets create it 
            $accounts->addData(['id' => $destination, 'amount' => 0]);
            $accounts->save();
            $amountAtAccount = 0;
        }
        else {
            $amountAtAccount = $res['data']['amount'];
        }

        # Lets deposit the amount at that account
        $amountAtAccount += $amount;
        $accounts->addData(['id' => $destination, 'amount' => $amountAtAccount]);
        $accounts->save();

        $return = ['destination' => ['id' => $destination, 'balance' => $amountAtAccount]];
        return ['code' => 201, 'body' => json_encode($return)];
    }

    /**
     * Gets an amount out
     */
    static function withdraw($origin, $amount) {
        $accounts = new \Models\Accounts();
        $res = $accounts->find($origin);
        if ($res['idx'] !== null) {
            $amountAtAccount = $res['data']['amount'];
            # Lets withdraw the amount from that account
            $amountAtAccount -= $amount;
            $accounts->addData(['id' => $origin, 'amount' => $amountAtAccount]);
            $accounts->save();

            $return = ['origin' => ['id' => $origin, 'balance' => $amountAtAccount]];
            return ['code' => 201, 'body' => json_encode($return)];
        }
        else {
            # Do not exists an account with this destination.
            return ['code' => 404, 'body' => 0];
        }
    }

    /**
     * Send a value to
     */
    static function transfer($origin, $destination, $amount) {
        $accounts = new \Models\Accounts();
        $res = $accounts->find($origin);
        if ($res['idx'] !== null) {
            # Remove the amount from origin
            $originAmount = $res['data']['amount'];
            $originAmount -= $amount;
            $accounts->addData(['id' => $origin, 'amount' => $originAmount]);
            $saved = $accounts->save();
            if ($saved) {
                # Deposit the amount to destination
                $res = self::deposit($destination, $amount);
                $body = json_decode($res['body'], true);
                $destinationAmount = $body['destination']['balance'];

                $return = [
                    'origin' => ['id' => $origin, 'balance' => $originAmount],
                    'destination' => ['id' => $destination, 'balance' => $destinationAmount],
                ];
                return ['code' => 201, 'body' => json_encode($return)];
            }
            else {
                # Error on removing balance from origin
                return ['code' => 404, 'body' => 0];
            }
        }
        else {
            # Do not exists an account with this origin.
            return ['code' => 404, 'body' => 0];
        }
    }

    /**
     * Get balance for account
     */
    static function getBalance($accountId) {
        $accounts = new \Models\Accounts();
        $res = $accounts->find($accountId);
        if ($res['idx'] !== null) {
            # Get balance for existing account
            $amount = $res['data']['amount'];
            return ['code' => 200, 'body' => $amount];
        }
        else {
            # Non-existing account
            return ['code' => 404, 'body' => 0];
        }
    }

    /**
     * Close ALL accounts at this fintech. No remorse. No backup!
     */
    static function closeAll() {
        # Clear Accounts table data
        $accounts = new \Models\Accounts();
        $closed = $accounts->deleteAll();
        if ($closed) {
            return ['code' => 200, 'body' => 'OK'];
        }
        return ['code' => 404, 'body' => 0];
}
}