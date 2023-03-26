(function(){

// Файл cart_render.js, выводит позиции корзины на страницу заказа 
// подключается в html: <script src="scripts/cart_render.js?'.$hash.'"></script>

// Получить cookie
var getCookie = function(name){
	let matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
	return matches ? decodeURIComponent(matches[1]) : undefined;
};

// Ищем hash корзины
var cart_hash = getCookie('myproject_cart_hash');

// Если hash корзины нету, то создаем рандомный
if(!cart_hash){
	cart_hash = Math.floor(Math.random()*8999+1000)
		+ '-' + Math.floor(Math.random()*8999+1000) 
		+ '-' + Math.floor(Math.random()*8999+1000);
	// Считаем дату конца куки, +1 мес
	var cookie_date = new Date(); cookie_date.setMonth(cookie_date.getMonth() + 1);
	document.cookie = "myproject_cart_hash="+cart_hash+"; path=/; expires=" + cookie_date.toUTCString();
}

// Вывод корзины на страницу
if($('.cart-box').length){
	$.ajax({
		method: 'POST',
		url: '/post_cart_render.php',
		data: 'hash='+cart_hash,
		success: function(data){
			// Переводим array с бэка в json
			data = JSON.parse(data);

			// Посмотреть что вернулось с бэка
			console.log(data); 

			// Выводим позиции из корзины
			data['cart'].forEach(function(row){
				$(`<div class="product-box" product-id="`+row['product_id']+`">
					<div class="product-name">`+row['product_name']+`</div>
					<div class="product-price">`+row['product_price']+`</div>
					<div class="product-cart">
						<div class="cart-minis"></div>
						<div class="cart-count">`+row['cart_count']+`</div>
						<div class="cart-plus"></div>
					</div>
				</div>`).appendTo('.cart-box');
			});
		},
	}); // ajax
}


})(jQuery);