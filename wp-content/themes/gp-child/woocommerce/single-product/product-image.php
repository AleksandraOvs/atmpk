<?php
defined('ABSPATH') || exit;

if (!function_exists('wc_get_gallery_image_html')) {
	return;
}

global $product;

$columns           = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
		'woocommerce-product-gallery--columns-' . absint($columns),
		'images',
	)
);
?>
<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>" data-columns="<?php echo esc_attr($columns); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="woocommerce-product-gallery__wrapper">
		<?php
		if ($post_thumbnail_id) {
			$full_size_image = wp_get_attachment_image_src($post_thumbnail_id, 'full');
			$thumbnail       = wp_get_attachment_image_src($post_thumbnail_id, 'woocommerce_single');
			$image_title     = get_post_field('post_title', $post_thumbnail_id);
			$image_html      = wp_get_attachment_image($post_thumbnail_id, 'woocommerce_single', false, array(
				'title' => $image_title,
				'class' => 'wp-post-image',
			));

			echo '<div class="woocommerce-product-gallery__image">';
			echo '<a href="' . esc_url($full_size_image[0]) . '" data-fancybox="gallery" data-caption="' . esc_attr($image_title) . '">';
			echo $image_html;
			echo '</a>';
			echo '</div>';
		} else {
			echo '<div class="woocommerce-product-gallery__image--placeholder">';
			echo '<img src="' . esc_url(wc_placeholder_img_src('woocommerce_single')) . '" alt="' . esc_attr__('Awaiting product image', 'woocommerce') . '" />';
			echo '</div>';
		}

		do_action('woocommerce_product_thumbnails');
		?>
	</div>
</div>