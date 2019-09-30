<?php

namespace Application\Core;

use Application\Components\Auth;

class Controller
{	
	protected $js_array = [];

	/**
	 * Return names of added js files in array
	 */
    public function getJsArray()
    {
        return $this->js_array;
    }

	/**
	 * Add new name of js file for include
	 * 
	 * @param string $name
	 */
    public function addJsFile($name)
    {
        $this->js_array[] = $name;
    }
	
	/**
	 * Redirect to home page
	 */
	public function goHome() 
	{
		return header('Location: /');
	}

	/**
	 * Render view
	 * 
	 * @param string $view
	 * @param array $data
	 */
	public function render($view, $data) 
	{
		if (isset($data) && $data) {
			extract($data);
		} 
		
		$js  = $this->getJsArray();
		$auth = new Auth;
		
		require_once ROOT.'/views/layout/header.php';
		require_once ROOT.'/views/'.$view.'.php';
		require_once ROOT.'/views/layout/footer.php';
	}

	/**
	 * Make redirect
	 * 
	 * @param string $action
	 */
	public function redirect($action) 
	{
		header('Location: /'.$action);
	}
}