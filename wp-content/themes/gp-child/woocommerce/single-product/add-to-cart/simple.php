<?php

/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

global $product;

if (! $product->is_purchasable()) {
	return;
}

echo wc_get_stock_html($product); // WPCS: XSS ok.

if ($product->is_in_stock()) : ?>

	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

	<form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action('woocommerce_before_add_to_cart_button'); ?>

		<?php do_action('woocommerce_before_add_to_cart_quantity'); ?>

		<div class="variation-add-to-cart">

			<div class="variation-price">

				<?php echo $product->get_price_html(); ?>

				<div class="quantity-wrapper" style="display: flex; align-items: center; gap: 5px;">
					<button type="button" class="qty-btn minus" aria-label="Decrease quantity"><svg width="30" height="2" viewBox="0 0 30 2" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 2V0H13.8462H15H15.5H16.1538H30V2H16.1538H15.5H15H13.8462H0Z" fill="#332233" />
						</svg></button>
					<?php
					woocommerce_quantity_input(
						array(
							'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
							'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
							'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
						)
					);
					?>
					<button type="button" class="qty-btn plus" aria-label="Increase quantity"><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 16.1538V13.8462H13.8462V0H16.1538V13.8462H30V16.1538H16.1538V30H13.8462V16.1538H0Z" fill="#332233" />
						</svg>
					</button>
				</div>
			</div>


			<?php do_action('woocommerce_after_add_to_cart_quantity'); ?>

			<button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>

			<?php do_action('woocommerce_after_add_to_cart_button'); ?>
		</div>
	</form>

	<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>