<?php


// Файл post_cart_add.php
// - к нему обращается cart.js чтобы изменить корзину
// - в себя получает hash корзины, id товара, кол-во и цену - изменяемой позиции в корзине

include 'db.php';

if(!$_POST['product_count']) $_POST['product_count'] = 1;

$sql = "INSERT IGNORE INTO order_carts SET 
		 cart_count='".$_POST['product_count']."'
		, cart_price='".$_POST['product_price']."'
		, cart_hash='".$_POST['hash']."'
		, cart_product='".$_POST['product_id']."'
";
$result['sql'] = $sql;
// Добавляем позиция в корзину
if($query_select = mysqli_query($link, $sql)){
	$result['insert_id'] = mysqli_insert_id($link);
	if(!$result['insert_id']){
		// Изменяем корзину
		if($query_select = mysqli_query($link, "UPDATE order_carts SET 
				 cart_count=cart_count+1
				, cart_price='".$_POST['product_price']."'
			WHERE 
				cart_hash='".$_POST['hash']."'
				AND cart_product='".$_POST['product_id']."'
		")){
			$result['success'] = true;
		}
	} else {
		$result['success'] = true;
	}
}


echo json_encode($result);