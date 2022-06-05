<?php
	
	include 'Crud.php';

	$obj = new Crud();
	
	$data = [
		'adminName' => 'obaid',
		'adminPass' => 123,
	];

	$obj->insert('tbl_admin', $data);
  ?>