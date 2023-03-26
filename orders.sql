--


-- MYSQL
-- Это не в код, а вставляем в phpmyamdin через вкладку SQL один раз и таблицы создаются


-- Товары
CREATE TABLE `products` (
  `product_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_art` varchar(64) DEFAULT NULL,
  `product_name` varchar(154) DEFAULT NULL,
  `product_photo` text DEFAULT NULL,
  `product_price` float DEFAULT NULL,
  `product_desc` text NULL DEFAULT NULL, -- Описание
  `product_brand` int(11) NULL DEFAULT NULL, -- brands.brand_id  
  `product_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP, -- Дата добавления
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;



-- Бренд
CREATE TABLE `brands` (
  `brand_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(154) DEFAULT NULL,
  `brand_uri` varchar(196) DEFAULT NULL, -- Адрес бренда на сайте - /adidas
  `brand_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;





-- Заказы
CREATE TABLE `orders` (
  `order_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_fio` int(11) DEFAULT NULL,
  `order_adress` varchar(32) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;



-- Позиции корзины и заказов
CREATE TABLE `order_carts` (
  `cart_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cart_hash` int(11) DEFAULT NULL,
  `cart_order` int(11) DEFAULT NULL,
  `cart_product` int(11) DEFAULT NULL,
  `cart_count` int(11) DEFAULT NULL,
  `cart_price` float DEFAULT NULL,
  `cart_sum` float DEFAULT NULL,
  `cart_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;

