<?php
	require_once '../classes/Crud.php';

	$obj = new Crud();
	if (empty($_POST['catName'])) {
		echo 'please fill the category field';
	}else{
	$data = [
		'catName' => $_POST['catName'],
		'category_slug_url' => $obj->slugify($_POST['catName'],'category_slug_url','tbl_category'),
	];
	
	if ($obj->insert('tbl_category', $data)) {
		echo "Success";
	}else{
		echo "Success";
	}
	}
 ?>