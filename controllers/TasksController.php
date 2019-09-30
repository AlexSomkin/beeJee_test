<?php

namespace Application\Controllers;

use Application\Models\Tasks;
use Application\Components\Auth;
use Application\Core\Controller;

class TasksController extends Controller
{	
	private $tasks_on_page = 3;
	
	/**
	 * Tasks list page
	 */
	public function actionIndex($params)
	{
		$model = new Tasks();
		
		$count_pages = (int)ceil($model->getCountAllTasks() / $this->tasks_on_page);

		if ((isset($params[0]) && (!is_numeric($params[0])) || $params[0] > $count_pages)) {
			$this->render('error', []);
		} else {
			$pagination_array = $this->preparePaginationData($params[0], $params[1]);

			$tasks_array = $model->getAllTasks($pagination_array['sort'], $pagination_array['limit_from'], $this->tasks_on_page); 

			$this->render('tasks/index', [
				'count_pages' => $count_pages,
				'current_page' => $pagination_array['page'],
				'current_sort' => $pagination_array['current_sort'],
				'other_sort' => $pagination_array['other_sort'],
				'tasks' => $tasks_array
			]);
		}
	}

	/**
	 * Create task page
	 */
	public function actionAdd() 
	{
		$this->addJsFile('tasks/addTask');

		if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['content'])) {
			$model = new Tasks();
			
			$result = $model->addNewTask($_POST['name'], $_POST['email'], $_POST['content'], false);

			if ($result) {
				$this->goTasksHomePage('Задача добавлена');
			} else {
				$this->render('tasks/add', [
					'error_messages' => $model->getErrorMessages()
				]);
			}
		} else {
			$this->render('tasks/add', []);
		}
	}

	/**
	 * Update task page
	 * 
	 * @param integer $id
	 */
	public function actionUpdate($id)
	{
		if (!Auth::isLogged()) {
			$this->redirect('admin/login');
		} elseif (isset($_POST['content'])) {
			$id_update = $id[0];

			if (isset($_POST['done'])) {
				if ($_POST['done'] == 'yes') {
					$done = 1;
				} else {
					$done = 0;
				}
			} else {
				$done = false;
			}
			
			$model = new Tasks();
			$model->updateTask($id_update, $_POST['content'], $done) ;

			$this->redirect('tasks/1');
		} else {
			$model = new Tasks();
			$result = $model->getById($id[0]);

			$this->render('tasks/update', [
				'task' => $result
			]);
		}
	}

	/**
	 * Prepare data for pagination
	 * 
	 * @param integer $page=1
	 * @param string $sortName=null
	 * 
	 * @return array
	 */
	private function preparePaginationData($page = null, $sortName = null)
	{
		$result_array = [];
		$page = ($page == null ? 1 : $page);

		switch ($sortName) {
			case null:
				$result_array['sort'] = 'id ASC';
				$result_array['current_sort'] = '';
				$result_array['other_sort'] = [
					'name' => 'sortByNameASC',
					'email' => 'sortByEmailASC',
					'done' => 'sortByDoneASC'
				];
				break;
			case 'sortByNameASC':
				$result_array['sort'] = 'name ASC';
				$result_array['current_sort'] = '/sortByNameASC';
				$result_array['other_sort'] = [
					'name' => 'sortByNameDESC',
					'email' => 'sortByEmailASC',
					'done' => 'sortByDoneASC'
				];
				break;
			case 'sortByNameDESC':
				$result_array['sort'] = 'name DESC';
				$result_array['current_sort'] = '/sortByNameDESC';
				$result_array['other_sort'] = [
					'name' => 'sortByNameASC',
					'email' => 'sortByEmailASC',
					'done' => 'sortByDoneASC'
				];
				break;
			case 'sortByEmailASC':
				$result_array['sort'] = 'email ASC';
				$result_array['current_sort'] = '/sortByEmailASC';
				$result_array['other_sort'] = [
					'name' => 'sortByNameASC',
					'email' => 'sortByEmailDESC',
					'done' => 'sortByDoneASC'
				];
				break;
			case 'sortByEmailDESC':
				$result_array['sort'] = 'email DESC';
				$result_array['current_sort'] = '/sortByEmailDESC';
				$result_array['other_sort'] = [
					'name' => 'sortByNameASC',
					'email' => 'sortByEmailASC',
					'done' => 'sortByDoneASC'
				];
				break;
			case 'sortByDoneASC':
				$result_array['sort'] = 'done ASC';
				$result_array['current_sort'] = '/sortByDoneASC';
				$result_array['other_sort'] = [
					'name' => 'sortByNameASC',
					'email' => 'sortByEmailASC',
					'done' => 'sortByDoneDESC'
				];
				break;
			case 'sortByDoneDESC':
				$result_array['sort'] = 'done DESC';
				$result_array['current_sort'] = '/sortByDoneDESC';
				$result_array['other_sort'] = [
					'name' => 'sortByNameASC',
					'email' => 'sortByEmailASC',
					'done' => 'sortByDoneASC'
				];
				break;
			default: 
				$this->render('error', []);
		}

		$result_array['page'] = $page;
		$result_array['limit_from'] = ($page - 1) * $this->tasks_on_page;

		return $result_array;
	}

	/**
	 * Load tasks home page with message
	 */
	public function goTasksHomePage($success_message = '')
	{	
		$model = new Tasks();

		$count_pages = (int)ceil($model->getCountAllTasks() / $this->tasks_on_page);

		$pagination_array = $this->preparePaginationData();

		$tasks_array = $model->getAllTasks($pagination_array['sort'], $pagination_array['limit_from'], $this->tasks_on_page); 
				
		$this->render('tasks/index', [
			'count_pages' => $count_pages,
			'current_page' => $pagination_array['page'],
			'current_sort' => $pagination_array['current_sort'],
			'other_sort' => $pagination_array['other_sort'],
			'tasks' => $tasks_array,
			'success_message' => $success_message
		]);
	}
}