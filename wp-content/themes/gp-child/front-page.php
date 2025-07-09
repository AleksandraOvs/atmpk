<?php get_header() ?>
<div <?php generate_do_attr('content'); ?>>
    <main <?php generate_do_attr('main'); ?>>
         <?php get_template_part('template-parts/hero-block') ?>
        <?php get_template_part('template-parts/categories') ?>
        <?php get_template_part('template-parts/sale-products') ?>
    </main>
</div>
<?php get_footer() ?>