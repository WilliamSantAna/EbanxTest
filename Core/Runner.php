<?php

namespace Core;

class Runner {

    static function run() {
        # Parsing called api method
        $url = $_SERVER['REQUEST_URI']; 
        if (substr($url, -1) == '/') {
            $url = substr($url, 0, -1);
        }
        $pieces = explode("/", $url); 
        $method = $pieces[count($pieces)-1];

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data = null;
            if (strpos($method, '?')) {
                # we have get query string data
                $exp = explode("?", $method);
                list($method, $data) = explode("?", $method);
            }
        }
        else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
        }

        return call_user_func(["\\Api\\Server", $method], $data);
    }

}