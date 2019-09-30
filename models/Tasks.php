<?php

namespace Application\Models;

use Application\Core\Model;

class Tasks extends Model
{
	private $query_result;

	/**
	 * Select all tasks
	 * 
	 * @param string $sort 
	 * @param integer $limit_from 
	 * @param integer $limit_to
	 * 
	 * @return array 
	 */
	public function getAllTasks($sort, $limit_from, $limit_to)
	{
		$result = [];
		
		$query = $this->connect->mysqli->prepare("SELECT * FROM tasks ORDER BY {$sort} LIMIT ?, ?");
		$query->bind_param('ii', $limit_from, $limit_to);
		$query->execute();
		$this->query_result = $query->get_result();
		
		if ($this->query_result) {
			while ($row = $this->query_result->fetch_assoc()) {
				$result[] = [
					'id' 	  => $row['id'],
					'name' 	  => $row['name'],
					'email'   => $row['email'],
					'content' => $row['content'],
					'done' 	  => $row['done'],
					'edited'  => $row['edited']
				];
			}
			
			return $result;	
		} else {
			return false;
		}
	}

	/**
	 * Create new task
	 * 
	 * @param string $name
	 * @param string $email
	 * @param string $content
	 * @param integer $done optional parameter
	 * 
	 * @return boolean
	 */
	public function addNewTask($name, $email, $content, $done = false) 
	{
		if ($name == '') {
			$this->addErrorMessage('Поле "Имя" обязательное для заполнения');
		}

		if ($email == '') {
			$this->addErrorMessage('Поле "E-mail" обязательное для заполнения');
		} else {
			if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				$this->addErrorMessage('Вы указали неверный формат email');
			}
		}

		if ($this->hasErrors()) {
			return false;
		} else {
			$query = $this->connect->mysqli->prepare("INSERT INTO tasks (name, email, content, done) VALUES (?, ?, ?, ?)");
			$query->bind_param('sssi', htmlentities($name), htmlentities($email), htmlentities($content), $done);

			if ($query->execute()) {
				return true;
			} else {
				$this->addErrorMessage($query->error);

				return false;
			}
		}
	}

	/**
	 * Return count all tasks
	 * 
	 * @return integer
	 */
	public function getCountAllTasks()
	{
		$this->query_result = $this->connect->mysqli->query("SELECT COUNT(id) as count FROM `tasks`");

		if ($this->query_result) {
			return $this->query_result->fetch_assoc()['count'];
		} else {
			return false;
		}
	}

	/**
	 * Change task content
	 * 
	 * @return boolean
	 */
	public function updateTask($id, $content, $done)
	{
		$id = (int)$id;

		$task = $this->getById($id);
		
		if ($content == $task['content']) {
			$query = $this->connect->mysqli->prepare("UPDATE tasks SET content = ?, done = ? WHERE id = ?");
			$query->bind_param('sii', htmlentities($content), $done, $id);
		} else {
			$query = $this->connect->mysqli->prepare("UPDATE tasks SET content = ?, done = ?, edited = ? WHERE id = ?");
			$query->bind_param('siii', htmlentities($content), $done, time(), $id);
		}

		if ($query->execute()) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Get task by id
	 * 
	 * @param integer $id
	 * 
	 * @return array
	 */
	public function getById($id)
	{
		$id = (int)$id;

		$query = $this->connect->mysqli->prepare("SELECT * FROM tasks WHERE id = ?");
		$query->bind_param('i', $id);
		$query->execute();
		$this->query_result = $query->get_result()->fetch_assoc();
		
		if ($this->query_result) {
			return $this->query_result;	
		} else {
			return false;
		}
	}
}