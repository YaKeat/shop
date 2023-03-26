(function(){


// Файл cart_add.js, подключается в html:
// <script src="scripts/cart_add.js?'.$hash.'"></script>


// Вызывает добавление в корзину по кнопке
$('.cart-add').click(function(){
	// Узнаем id товара который изменить в корзине
	var elem = $(this).closest('.product-box');
	var array = {
		'product_id': elem.attr('product-id'),
		'product_count': elem.find('.product-count span').text(),
		'product_price': elem.find('.product-price span').text(),
	};
	$.ajax({
		method: 'POST',
		url: '/post_cart_add.php',
		data: array,
		success: function(data){
			// Переводим array с бэка в json
			data = JSON.parse(data);

			// Посмотреть что вернулось с бэка
			console.log(data); 

			// Событие изменения кол-ва в корзине +1
			// $('.cart-count').html(data['sum']['pos']);
		},
		error: function(err){
			console.log(err);
		},
	}); // ajax
});



})(jQuery);