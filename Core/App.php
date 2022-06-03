<?php

    namespace Core;

    class App {

        static function init() {
            # Bootstrap enviroment
            $ORM = new ORM();
            register_shutdown_function([$ORM, 'closeConnection']);

            # Load configs to global $_SERVER var
            $configs = json_decode(file_get_contents(dirname(__FILE__) . '/config.json'));
            $_SERVER['APP_CONFIG'] = $configs;

        }

    }