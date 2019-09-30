<?php

return array(
	'tasks/([0-9]+)' => 'tasks/view/$1',
	'tasks/add' => 'tasks/add',
	'tasks/update/([0-9]+)' => 'tasks/update/$1',
	'tasks/update' => 'tasks/update',
	'tasks/updateFinish' => 'tasks/updateFinish',
	'tasks' => 'tasks/index',
	'tasks/([0-9]+)' => 'tasks/index/$1',
	'tasks/([0-9]+)/([0-9]+)' => 'tasks/index/$1/$2',
	'admin/login' => 'admin/login',
	'admin/logout' => 'admin/logout',
	'admin' => 'admin/login',
	'' => 'tasks/index',
);