<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($con,$str){
	if($str!=''){
		$str=trim($str);
		return mysqli_real_escape_string($con,$str);
	}
}

function get_prod($con, $cat='') {
	$prod = "SELECT * FROM `product` INNER JOIN categories on categories.id = product.categories_id where product.status=1 and categories.status=1 ";
	if($cat != '') {
		$prod .= " and product.categories_id=$cat";
	}
	$res = mysqli_query($con,$prod);
	$data = array();
	while($row = mysqli_fetch_assoc($res)) {
		$data[] = $row;
	}
	return $data;
}
?>