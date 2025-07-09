<?php

/**
 * Custom Variable product template with tabbed variations.
 */

defined('ABSPATH') || exit;

global $product;

$available_variations = $product->get_available_variations();
$attributes = $product->get_variation_attributes();

if (empty($available_variations)) {
	echo '<p class="stock out-of-stock">' . esc_html__('This product is currently out of stock and unavailable.', 'woocommerce') . '</p>';
	return;
}

do_action('woocommerce_before_add_to_cart_form');

// Получаем название атрибута (например, "Цвет")
$attribute_labels = array_map('wc_attribute_label', array_keys($attributes));
$attribute_label = implode(' / ', $attribute_labels); // если их несколько, объединяем
?>

<form class="variations_form cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
	<div class="variation-tabs">

		<!-- Название атрибута и вкладки в одном блоке -->
		<div class="variation-tabs-header" style="margin-bottom: 10px;">
			<div class="variation-tabs-header__name">
				<h3 class="variation-attribute-label" style="display: block; margin-bottom: 5px;"><?php echo esc_html($attribute_label); ?></h3>
			</div>
			<ul class="tabs" style="margin: 0; padding: 0; list-style: none;">
				<?php foreach ($available_variations as $index => $variation) :
					$variation_name = '';

					// Получаем значение атрибута комплектации
					if (!empty($variation['attributes']['attribute_komplektacziya'])) {
						$variation_name = $variation['attributes']['attribute_komplektacziya'];
					} else {
						// Подстраховка — если значение не задано
						$variation_name = 'Вариант ' . ($index + 1);
					}
				?>
					<li>
						<a href="#variation-tab-<?php echo esc_attr($index); ?>" data-index="<?php echo esc_attr($index); ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>">
							<?php echo esc_html($variation_name); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<?php foreach ($available_variations as $index => $variation) :
			$variation_obj = wc_get_product($variation['variation_id']); ?>

			<div id="variation-tab-<?php echo esc_attr($index); ?>" class="variation-tab-content" style="display: <?php echo $index === 0 ? 'block' : 'none'; ?>;">
				<div class="variation-description">
					<?php echo $variation_obj->get_description() ? wpautop($variation_obj->get_description()) : '<p>' . esc_html__('No description available for this variation.', 'woocommerce') . '</p>'; ?>
				</div>


				<div class="variation-add-to-cart">

					<div class="variation-price">
						<?php echo $variation_obj->get_price_html(); ?>

						<div class="quantity-wrapper" style="display: flex; align-items: center; gap: 0;">
							<button type="button" class="qty-btn minus" aria-label="Decrease quantity"><svg width="30" height="2" viewBox="0 0 30 2" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 2V0H13.8462H15H15.5H16.1538H30V2H16.1538H15.5H15H13.8462H0Z" fill="#332233" />
								</svg>
							</button>
							<input type="hidden" name="variation_id" value="<?php echo esc_attr($variation['variation_id']); ?>" />
							<?php
							woocommerce_quantity_input(array(
								'input_name'  => 'quantity',
								'input_value' => 1,
								'min_value'   => $variation_obj->get_min_purchase_quantity(),
								'max_value'   => $variation_obj->get_max_purchase_quantity(),
							));
							?>
							<button type="button" class="qty-btn plus" aria-label="Increase quantity"><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 16.1538V13.8462H13.8462V0H16.1538V13.8462H30V16.1538H16.1538V30H13.8462V16.1538H0Z" fill="#332233" />
								</svg>
							</button>
						</div>
					</div>

					<button type="submit" class="single_add_to_cart_button button alt" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>">
						<?php echo esc_html($product->single_add_to_cart_text()); ?>
					</button>
				</div>
			</div>

		<?php endforeach; ?>
	</div>
</form>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const tabs = document.querySelectorAll('.tabs a');
		const contents = document.querySelectorAll('.variation-tab-content');

		tabs.forEach(tab => {
			tab.addEventListener('click', function(e) {
				e.preventDefault();

				// Удаляем класс active со всех вкладок
				tabs.forEach(t => t.classList.remove('active'));

				// Добавляем active текущей
				this.classList.add('active');

				// Скрываем все вкладки
				contents.forEach(content => content.style.display = 'none');

				// Показываем выбранную
				const targetId = this.getAttribute('href');
				const targetContent = document.querySelector(targetId);
				if (targetContent) {
					targetContent.style.display = 'block';
				}
			});
		});
	});
</script>