<?php

    namespace Core;

    /**
     * 
     */
    class App {

        /**
         * Boot the App
         */
        static function init() {
            # Set root path
            $_SERVER['ROOT_PATH'] = dirname(__FILE__) . '/../';

            # Load configs to global $_SERVER var
            $configs = json_decode(file_get_contents($_SERVER['ROOT_PATH'] . '/config.json'));
            $_SERVER['APP_CONFIG'] = $configs;

            // Run the method
            $result = \Core\Runner::run();

            // Output result
            $code = $result['code'];
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            $headerOut = $protocol . ' ' . $code . (!empty($result['body']) ? ' ' . $result['body'] : '');
            header($headerOut);
            http_response_code($code);
            echo $result['body'];
        }
    }