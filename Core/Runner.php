<?php

namespace Core;

class Runner {

    static function run($ORM) {
        if ($_REQUEST['REQUEST_METHOD'] == 'GET') {
            $url = $_SERVER['REQUEST_URI'];
            $pieces = explode("/", substr($url, 0, -1));
            $method = $pieces[count($pieces)-1];
    
            $post = json_decode(file_get_contents('php://input'), true);
            return call_user_func(["\\Api\\Server", $method], $ORM, $post['data']);
        }
        else if ($_REQUEST['REQUEST_METHOD'] == 'POST') {
            $url = $_SERVER['REQUEST_URI'];
            $pieces = explode("/", substr($url, 0, -1));
            $method = $pieces[count($pieces)-1];
    
            $post = json_decode(file_get_contents('php://input'), true);
            return call_user_func(["\\Api\\Server", $method], $ORM, $post['data']);
        }
        else {
            return [
                'code' => 405,
                'body' => null
            ];
        }
    }

}