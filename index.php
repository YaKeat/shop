<?php

// Страница товаров или бренда
// https://site.com/catalog.php?brand=4

// Контент:
// https://shop.cargo-avto.ru/catalog/boxes/korobki-dlya-pereezda/?utm_source=yad_msk&utm_medium=cpc&utm_campaign=korobki&_openstat=ZGlyZWN0LnlhbmRleC5ydTs2NzMwNDA2ODsxMTM3OTU2NjIwNDt5YW5kZXgucnU6cHJlbWl1bQ&yclid=10472717160950267903

include 'db.php';

include 'head.php';

if($query = mysqli_query($link,"SELECT * FROM products WHERE 1=1 ".
    ($_GET['brand']?" AND product_brand=".$_GET['brand']." ":"").
"")){
    while($row = mysqli_fetch_assoc($query)){
        $products[$row['product_id']] = $row;
    }
}

?>

<div class="products-wrapper">
    <?php
        if(!$products) echo '<h3>Товары не найдены</h3>';
        foreach($products as $product){
    ?>
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
    <?php } // end foreach ?>
</div>


<?php
include 'footer.php'; 

