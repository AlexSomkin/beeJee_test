<?php

use Application\components\Router;

define('ROOT',dirname(__FILE__));

require_once(ROOT.'/vendor/autoload.php');

$router = new Router();
$router->run();