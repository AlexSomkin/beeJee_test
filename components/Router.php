<?php

namespace Application\Components;

use Application\Controllers\AdminController;
use Application\Controllers\TasksController;
use Exception;

class Router
{
	private $routes;

	public function __construct() 
	{
		$routesPath = ROOT.'/config/routes.php';

		$this->routes = include $routesPath;
	}

	private function getURI() 
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	public function run() 
	{
		$uri = $this->getURI();
		
		foreach ($this->routes as $uriPattern => $path) {
			if (preg_match("~$uriPattern~", $uri)) {
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
				$parameters = explode('/', $internalRoute);
				$controllerName = 'Application\\Controllers\\'.ucfirst(array_shift($parameters).'Controller');
				$actionName = 'action'.ucfirst(array_shift($parameters));

				$controllerObject = new $controllerName;

				try {
					if (!method_exists($controllerObject, $actionName)) {
						throw new Exception("Указан неверный адрес");
					} else {
						$controllerObject->$actionName($parameters); 
					}
				} catch (Exception $th) {
					echo $th->getMessage();
				}
				
				break;
			}

		}
	}
}
