<?php

namespace Application\Core;

use mysqli;

class Connect
{
	protected $host = "localhost";
	protected $user_db = "root";
	protected $password_db = "";
	protected $select_db = "test";
	public 	  $mysqli;

	function __construct() 
	{
		$this->mysqli = new mysqli($this->host, $this->user_db, $this->password_db, $this->select_db);
		
		if ($this->mysqli->connect_error) {
			die('Connect Error (' . $this->mysqli->connect_errno . ') '
					. $this->mysqli->connect_error);
		}
	}

	function __destruct()
	{
		$this->mysqli->close();
	}
}