<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');

# Require all needed files (no autoload here, because it is simple!)
require_once dirname(__FILE__) . '/Core/Runner.php';
require_once dirname(__FILE__) . '/Core/ORM.php';
require_once dirname(__FILE__) . '/Core/Model.php';
require_once dirname(__FILE__) . '/Core/App.php';
require_once dirname(__FILE__) . '/Api/Server.php';

\Core\App::init();
exit;