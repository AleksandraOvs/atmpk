<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package GeneratePress
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<div <?php generate_do_attr('content'); ?>>
    <main <?php generate_do_attr('main'); ?>>
        <div <?php generate_do_attr('site-content'); ?>>
            <?php do_action( 'woocommerce_before_main_content' ); ?>
            <?php
            /**
             * generate_before_main_content hook.
             *
             * @since 0.1
             */
            do_action('generate_before_main_content');

            if (generate_has_default_loop()) {
                while (have_posts()) :

                    the_post();

                    generate_do_template_part('page');

                endwhile;
            }

            /**
             * generate_after_main_content hook.
             *
             * @since 0.1
             */
            do_action('generate_after_main_content');
            ?>
        </div>
    </main>
</div>

<?php
/**
 * generate_after_primary_content_area hook.
 *
 * @since 2.0
 */
do_action('generate_after_primary_content_area');

generate_construct_sidebars();

get_footer();
