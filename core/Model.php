<?php

namespace Application\Core;

use Application\Core\Connect;

class Model
{
	public $connect;
	private $error_messages = [];

	function __construct()
	{
		$this->connect = new Connect();
	}

	/**
	 * Add new error message
	 * 
	 * @param string $text
	 */
	public function addErrorMessage($text)
	{
		$this->error_messages[] = $text;
	}

	/**
	 * Get all error messages
	 * 
	 * @return array
	 */
	public function getErrorMessages()
	{
		return $this->error_messages;
	}

	/**
	 * Check errors messages
	 * 
	 * @return boolean
	 */
	public function hasErrors()
	{
		if (count($this->error_messages) > 0) {
			return true;
		} else {
			return false;
		}
	}
}