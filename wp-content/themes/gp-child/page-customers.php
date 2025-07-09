<?php

/**
 * Template name: for-customers
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<div <?php generate_do_attr('content'); ?>>
    <main <?php generate_do_attr('main'); ?>>
        <div <?php generate_do_attr('site-content'); ?>>
            <?php
            /**
             * generate_before_main_content hook.
             *
             * @since 0.1
             */
            do_action('generate_before_main_content');
            ?>
            <section>
                <h1 class="section-title">Покупателю</h1>

                <?php
                if ($links = carbon_get_post_meta(get_the_ID(), 'crb_links')) {
                    echo '<div class="links-list">';
                    foreach ($links as $link) {

                        echo '<a href="' . $link['crb_fc_link'] . '">' . $link['crb_fc_link_text'] . ' <span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
  <path d="M1 19L19 1M19 1V18.28M19 1L1.72 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg></span></a>
                            ';
                    }
                    echo '</div>';
                }
                ?>

            </section>

            <section class="page-section">
                <?php the_content() ?>
            </section>

            <?php
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
