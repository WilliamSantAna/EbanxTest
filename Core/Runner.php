<?php

namespace Core;

/**
 * Runner class
 */
class Runner {

    /**
     * Runs the App
     */
    static function run() {
        # Parsing called api method
        $url = $_SERVER['REQUEST_URI']; 
        if (substr($url, -1) == '/') {
            $url = substr($url, 0, -1);
        }
        $pieces = explode("/", $url); 
        $method = $pieces[count($pieces)-1];

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $payload = null;
            if (strpos($method, '?')) {
                # we have get query string data
                list($method, $query_string) = explode("?", $method);
                parse_str($query_string, $payload);
            }
        }
        else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            # we have the raw body post
            $payload = json_decode(file_get_contents('php://input'), true);
        }

        return call_user_func(["\\Api\\Server", $method], $payload);
    }

}