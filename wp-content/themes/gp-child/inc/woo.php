<?php

// Убираем стандартный заголовок из блока .summary
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

// Добавляем заголовок перед блоком продукта
add_action('woocommerce_before_single_product', 'custom_move_product_title', 5);
function custom_move_product_title()
{
    echo '<h1 class="product_title entry-title">' . get_the_title() . '</h1>';
}


add_filter('woocommerce_product_add_to_cart_text', 'custom_variation_button_text', 20, 2);
function custom_variation_button_text($text, $product)
{
    if ($product->is_type('variable')) {
       return 'Подробнее';
    }
    return $text;
}

//покаывать цену "от..." для вариативных товаров в каталогах

add_filter( 'woocommerce_get_price_html', 'custom_variation_price_html_from_text', 10, 2 );

function custom_variation_price_html_from_text( $price, $product ) {
	if ( $product->is_type( 'variable' ) ) {
		$min_price = $product->get_variation_price( 'min', true );
		// Выводим цену "от" только если есть разброс цен
		if ( $product->get_variation_price( 'min', true ) !== $product->get_variation_price( 'max', true ) ) {
			$price = '<span class="price">от ' . wc_price( $min_price ) . '</span>';
		} else {
			// если минимальная и максимальная одинаковы, показываем просто цену
			$price = '<span class="price">' . wc_price( $min_price ) . '</span>';
		}
	}
	return $price;
}

//отключение photoswipe

add_action('wp_enqueue_scripts', function() {
    // Убираем скрипты и стили галереи товаров WooCommerce
    wp_dequeue_script('photoswipe');
    wp_dequeue_script('photoswipe-ui-default');
    wp_dequeue_style('photoswipe');
    wp_dequeue_style('woocommerce-single-product');
}, 100);


//Удаляем стандартный вывод цены
add_action( 'woocommerce_single_product_summary', 'move_price_to_custom_location', 1 );
function move_price_to_custom_location() {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
}