<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

# Require all needed files (no autoload here, because it's simple!)
require_once dirname(__FILE__) . '/Core/Runner.php';
require_once dirname(__FILE__) . '/Core/ORM.php';

require_once dirname(__FILE__) . '/Api/Balance.php';
require_once dirname(__FILE__) . '/Api/Event.php';


require_once dirname(__FILE__) . '/Core/App.php';



// Run the method
$result = \Core\Runner::run($ORM);

// Return result
http_response_code($result['code']);
if (count($result['body'])) {
    echo json_encode($result['body']);
}
exit;