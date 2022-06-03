<?php

    namespace Core;

    class App {

        static function init() {
            # Set root path
            $_SERVER['ROOT_PATH'] = dirname(__FILE__) . '/../';

            # Load configs to global $_SERVER var
            $configs = json_decode(file_get_contents($_SERVER['ROOT_PATH'] . '/config.json'));
            $_SERVER['APP_CONFIG'] = $configs;

            // Run the method
            $result = \Core\Runner::run();

            // Output result
            http_response_code($result['code']);

            if (!empty($result['body'])) {
                echo json_encode($result['body']);
            }
        }
    }