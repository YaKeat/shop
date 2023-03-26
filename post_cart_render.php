<?php


// Файл post_cart_render.php
// - к нему обращается cart_render.js чтобы получить позиции в корзине
// - в себя получает hash нужной корзины из js

include 'db.php';


// Загружаем корзину по hash cookie
if($query_select = mysqli_query($link, "SELECT *,
		(SELECT product_name FROM products WHERE product_id=cart_product) AS product_name,
		(SELECT product_price FROM products WHERE product_id=cart_product) AS product_price,
	 FROM shop_carts WHERE 
		cart_hash='".$_POST['hash']."' "))
{
	while($row = mysqli_fetch_assoc($query_select)){
		$row['sum'] = $row['cart_count']*$row['cart_price'];
		$result['cart'][$row['cart_id']] = $row;
		// Суммы
		$result['sum']['all'] += $row['sum'];
	}
	if($result['cart'])
		$result['sum']['pos'] = count($result['cart']);
}


echo json_encode($result);