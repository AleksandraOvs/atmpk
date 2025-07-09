<?php
$slides = carbon_get_theme_option('crb_hero_slider');

if ($slides): ?>
    <div class="swiper-container hero-slider">
        <div class="swiper-wrapper">
            <?php foreach ($slides as $slide): ?>
                <div class="swiper-slide hero-slider__slide">

                    <?php if (!empty($slide['crb_hero_slide_image'])): ?>
                        <img src="<?= wp_get_attachment_image_url($slide['crb_hero_slide_image'], 'full') ?>" alt="">
                    <?php endif; ?>

                    <div <?php generate_do_attr('site-content'); ?>>

                        <?php if (!empty($slide['crb_hero_slide_haeding'])): ?>
                            <h2><?= esc_html($slide['crb_hero_slide_haeding']) ?></h2>
                        <?php endif; ?>

                        <?php if (!empty($slide['crb_hero_slide_description'])): ?>
                            <p><?= esc_html($slide['crb_hero_slide_description']) ?></p>
                        <?php endif; ?>

                        <?php if (!empty($slide['crb_hero_slide_link']) && !empty($slide['crb_hero_slide_link_text'])): ?>
                            <a class="btn" href="<?= esc_url(strip_tags($slide['crb_hero_slide_link'])) ?>" class="slide-link">
                                <?= wp_kses_post($slide['crb_hero_slide_link_text']) ?>
                            </a>
                        <?php endif; ?>


                    </div>

                </div>
            <?php endforeach; ?>
        </div>
        <div class="slider-hero-pagination"></div>
        <!-- Навигация Swiper -->
        <!-- <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div> -->

        </div>
    <?php endif; ?>