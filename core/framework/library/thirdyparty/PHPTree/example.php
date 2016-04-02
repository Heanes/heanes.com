<?php 
require('PHPTree.class.php');

//原始数据, 从数据库读出
$data = array(
	array(
		'id'=>1,
		'name'=>'book',
		'parent_id'=>0
	),
	array(
		'id'=>2,
		'name'=>'music',
		'parent_id'=>0
	),
	array(
		'id'=>3,
		'name'=>'book1',
		'parent_id'=>1
	),
	array(
		'id'=>4,
		'name'=>'book2',
		'parent_id'=>3
	)
);

$r = PHPTree::makeTree($data);

echo json_encode($r);

?>