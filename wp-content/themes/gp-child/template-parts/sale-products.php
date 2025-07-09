<section class="section-sale">
    <div <?php generate_do_attr('site-content'); ?>>
        <h2 class="section-title">Акции</h2>
        <?php
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 4, // Кол-во товаров
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_tag',
                    'field'    => 'slug',
                    'terms'    => 'sale', // Замените на "акция" на латинице (slug тега)
                ),
            ),
        );
        $loop = new WP_Query($args);

        if ($loop->have_posts()) :
            woocommerce_product_loop_start();
            while ($loop->have_posts()) : $loop->the_post();
                wc_get_template_part('content', 'product');
            endwhile;
            woocommerce_product_loop_end();
            wp_reset_postdata();
        else :
            echo '<p>Нет акционных товаров.</p>';
        endif;
        ?>
    </div>
</section>