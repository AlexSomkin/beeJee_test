<?php

namespace Application\Controllers;

use Application\Core\Controller;
use Application\Components\Auth;

class AdminController extends Controller
{	
	/**
	 * Login admin page
	 */
	public function actionLogin()
	{
		$auth = new Auth;

		if (isset($_SESSION['login'])) {
			$this->goHome();
		}

		if (isset($_POST['login']) && isset($_POST['password'])) {
			if ($auth->load($_POST['login'], $_POST['password']) && $auth->login()) {

				$this->redirect('tasks');
			}else{
				$this->render('admin/login', [
					'error_messages' => $auth->getErrorMessages()
				]);	
			}
		} else {
			$this->render('admin/login', []);
		}
	}

	/**
	 * Delete auth
	 */
	public function actionLogout() 
	{
		Auth::logout();

		$this->redirect('tasks');
	}
}