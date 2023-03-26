<?php

// Страница товара
// https://site.com/product.php?id=2

include 'db.php'; 

include 'head.php'; // Подключаем файл 

// mysql
if($query = mysqli_query($link,"SELECT *
        ,(SELECT brand_name FROM brands WHERE brand_id=product_brand) AS brand_name
     FROM products WHERE 
        product_id=".$_GET['id']."
"))
{
    $product = mysqli_fetch_assoc($query);
}

?>

<a href="/">Назад</a>

<div class="product-wrapper">
    <div class="product-box" product-id="<?=$product['product_id']?>">
        <a href="/product.php?id=<?=$product['product_id']?>" class="product-photo">
            <div class="product-image" 
                <?php if($product['product_photo']){ ?>
                    style="background-image: url(<?=$product['product_photo']?>)"
                <?php } ?>
            >
            </div>
        </a>
        <div class="product-data">
            <div class="product-art">#<?=$product['product_art']?></div>
            <a href="/product.php?id=<?=$product['product_id']?>" class="product-title"><?=$product['product_name']?></a>
            <div class="product-brand"><?=$brands[$product['product_brand']]['brand_name']?></div>
            <div class="product-cart">
                <div class="product-price">
                    <span><?=$product['product_price']?></span>
                    руб.
                </div>
                <div class="cart-add">Купить</div>
            </div>
        </div>
    </div>
</div>

