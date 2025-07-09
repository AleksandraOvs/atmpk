<?php
get_header();
?>
<div <?php generate_do_attr('site-content'); ?>>
	<?php do_action( 'woocommerce_before_main_content' ); ?>
	<?php
	$term = get_queried_object();
	if ($term && ! is_wp_error($term)) {
		echo '<h1 class="category-title">' . esc_html($term->name) . '</h1>';
	}
	?>
	<?php
	$parent_cat = get_queried_object(); // текущая категория (lab-mebel)
	$child_cats = get_terms([
		'taxonomy' => 'product_cat',
		'hide_empty' => false,
		'parent' => $parent_cat->term_id,
		'orderby'    => 'id',     // Сортировка по ID (приближенно к дате создания)
		'order'      => 'ASC'     // От меньшего к большему (от старых к новым)
	]);
	?>

	<div class="lab-tabs-wrapper">
		<?php if (!empty($child_cats)) : ?>
			<ul class="lab-tabs-nav" style="display: flex; list-style: none;">
				<?php foreach ($child_cats as $index => $child) : ?>
					<?php
					// Получить ID изображения категории
					$thumbnail_id = get_term_meta($child->term_id, 'thumbnail_id', true);
					$image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : wc_placeholder_img_src();
					?>
					<li style="text-align: center;">
						<a href="#tab-<?php echo esc_attr($child->term_id); ?>"
							class="lab-tab-link <?php echo $index === 0 ? 'active' : ''; ?>"
							data-tab="<?php echo esc_attr($child->term_id); ?>"
							style="display: block; text-decoration: none; color: inherit;">
							<img src="<?php echo esc_url($image_url); ?>"
								alt="<?php echo esc_attr($child->name); ?>">
							<span><?php echo esc_html($child->name); ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>

			<div class="lab-tabs-content">
				<?php foreach ($child_cats as $index => $child) : ?>
					<div class="lab-tab-content" id="tab-<?php echo esc_attr($child->term_id); ?>" style="<?php echo $index !== 0 ? 'display:none;' : ''; ?>">
						<?php
						$products = new WP_Query([
							'post_type' => 'product',
							'posts_per_page' => -1,
							'tax_query' => [
								[
									'taxonomy' => 'product_cat',
									'field'    => 'term_id',
									'terms'    => $child->term_id,
								],
							],
						]);

						if ($products->have_posts()) :
							echo '<ul class="products columns-3">';
							while ($products->have_posts()) : $products->the_post();
								wc_get_template_part('content', 'product');
							endwhile;
							echo '</ul>';
							wp_reset_postdata();
						else :
							echo '<p>Нет товаров в этой категории.</p>';
						endif;
						?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p>Нет подкатегорий.</p>
		<?php endif; ?>
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const links = document.querySelectorAll('.lab-tab-link');
			const contents = document.querySelectorAll('.lab-tab-content');

			links.forEach(link => {
				link.addEventListener('click', function(e) {
					e.preventDefault();
					const tabId = this.dataset.tab;

					// Снять активные классы
					links.forEach(l => l.classList.remove('active'));
					contents.forEach(c => c.style.display = 'none');

					// Назначить активную вкладку
					this.classList.add('active');
					document.getElementById('tab-' + tabId).style.display = 'flex';
				});
			});
		});
	</script>
</div>
<?php get_footer(); ?>