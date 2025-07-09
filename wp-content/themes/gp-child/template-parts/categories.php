<section class="section-categories">
    <div <?php generate_do_attr('site-content'); ?>>
        <h2 class="section-title">Каталог</h2>
        <?php
        // Получаем ID категории по слагу 'misc'
        $excluded_term = get_term_by('slug', 'misc', 'product_cat');
        $exclude_id = $excluded_term ? $excluded_term->term_id : 0;

        // Аргументы для получения категорий товаров
        $args = array(
            'taxonomy'     => 'product_cat',
            'orderby'      => 'name',
            'show_count'   => false,
            'pad_counts'   => false,
            'hierarchical' => true,
            'title_li'     => '',
            'exclude'      => $exclude_id,
            'hide_empty'   => false,
            'parent'       => 0 // Только родительские категории
        );

        // Получаем список категорий
        $categories = get_categories($args);

        // Проверяем наличие категорий
        if (!empty($categories)) {
            echo '<ul class="product-categories with-thumbnails">';
            foreach ($categories as $category) {
                // Получаем ID миниатюры
                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : wc_placeholder_img_src(); // Плейсхолдер если нет изображения

                // Вывод категории с изображением и ссылкой
                echo '<li class="product-category">';
                echo '<a href="' . esc_url(get_term_link($category)) . '">';
                echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($category->name) . '" />';
                echo '<h3><span>' . esc_html($category->name) . '</span></h3>';
                echo '</a>';
                echo '</li>';
            }
            echo '</ul>';
        }

        $all_categories_url = get_permalink(wc_get_page_id('shop')); // или свой URL
        echo '<div class="all-categories-link">';
        echo '<a href="' . esc_url($all_categories_url) . '" class="btn center">Смотреть весь каталог</a>';
        echo '</div>';
        ?>
    </div>
</section>