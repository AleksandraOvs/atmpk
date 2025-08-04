<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'site_carbon');
function site_carbon()
{
    Container::make('theme_options', 'Контакты')
        ->set_page_menu_position(2)
        ->set_icon('dashicons-admin-comments')
        ->add_tab(__('Способы связи'), array(
            Field::make('complex', 'contacts', 'Ссылки')
                ->add_fields(array(
                    Field::make('text', 'contact_link', 'Ссылка на способ связи')
                        ->set_width(50),
                    Field::make('image', 'contact_image', 'Изображение способа связи')
                        ->set_width(50),
                )),
        ))

        ->add_tab(__('Форма обратной связи'), array(
            Field::make('text', 'crb_contact_form_shortcode', 'Шорткод')
            ->help_text('Форма отображается в блоке категорий на главной странице')
                ->set_width(33),
        ));

    Container::make('theme_options', 'Блоки')
        ->set_page_menu_position(3)
        ->set_icon('dashicons-admin-comments')
        ->add_tab(__('Слайдер первого экрана'), array(

            Field::make('complex', 'crb_hero_slider', 'Слайды')
                ->add_fields(array(
                    Field::make('image', 'crb_hero_slide_image', 'Изображение слайда')
                        ->set_width(33),
                    Field::make('text', 'crb_hero_slide_haeding', 'Заголовок слайда')
                        ->set_width(33),
                    Field::make('text', 'crb_hero_slide_description', 'Текст слайда')
                        ->set_width(33),
                    Field::make('text', 'crb_hero_slide_link', 'Ссылка для слайдера')
                        ->set_width(25),
                    Field::make('text', 'crb_hero_slide_link_text', 'Текст ссылки для слайдера')
                        ->set_width(25),
                ))
        ))

        ->add_tab(__('Контактная форма'), array(
            Field::make('text', 'crb_contact_shortcode', 'Шорткод')
            
        ))

        ->add_tab(__('Этапы'), array(
            Field::make('rich_text', 'crb_steps_head', 'Заголовок')
                ->set_width(50),
            Field::make('rich_text', 'crb_steps_desc', 'Подзаголовок')
                ->set_width(50),

            Field::make('complex', 'crb_steps', 'Контент этапа')
                ->add_fields(array(
                    Field::make('image', 'crb_step_image', 'Иконка этапа')
                        ->set_width(15),
                    Field::make('color', 'crb_step_image_bg', 'Фон иконки')
                        ->set_width(15),
                    Field::make('text', 'crb_step_head', 'Заголовок этапа')
                        ->set_width(20),
                    Field::make('rich_text', 'crb_step_text', 'Текст этапа')
                        ->set_width(50),
                )),
        ));

    Container::make('post_meta', 'Контент главной страницы')
        ->show_on_page('for-customers')
        ->add_tab(__('Ссылки страницы'), array(
            Field::make('complex', 'crb_links', 'Ссылки')
                ->add_fields(array(
                    Field::make('text', 'crb_fc_link_text', 'Текст ссылки'),
                    Field::make('text', 'crb_fc_link', 'Ссылки (якорь или ссылка на страницу)'),
                ))
        ))

        ->add_tab(__('Преимущества Вордпресс'), array(
            Field::make('rich_text', 'crb_adv_head', 'Заголовок')
                ->set_width(40),
            Field::make('rich_text', 'crb_adv_desc', 'Подзаголовок')
                ->set_width(60),
            Field::make('rich_text', 'crb_adv_button', 'Кнопка перехода')
                ->set_width(50),
            Field::make('rich_text', 'crb_adv_button_link', 'Ссылка кнопки перехода')
                ->set_width(50),

            Field::make('complex', 'crb_advantages', 'Преимущества')
                ->add_fields(array(
                    Field::make('image', 'crb_adv_image', 'Изображение')
                        ->set_width(50),
                    // Field::make('color', 'crb_step_image_bg', 'Фон иконки')
                    //     ->set_width(50),
                    Field::make('text', 'crb_adv_item_head', 'Заголовок Преимущества')
                        ->set_width(50),
                    Field::make('rich_text', 'crb_adv_item_text', 'Текст Преимущества')
                        ->set_width(50),
                    Field::make('text', 'crb_adv_item_link', 'Ссылка слайда')
                        ->set_width(50),
                )),
        ));



    Container::make('post_meta', 'Слайдер для портфолио')
        ->show_on_post_type('portfolio')
        //->where( 'post_type', '=', 'portfolio' )
        ->add_fields(array(
            Field::make('image', 'crb_portfolio_header_pic', 'картинка для шапки')
                ->help_text('нужна картинка шириной 1600пикс на 350пикс'),

            Field::make('complex', 'crb_portfolio_siteparts', 'Сайт в портфолио')
                ->add_fields('parts_of_site', 'Блоки сайта', array(
                    Field::make('image', 'crb_sitepart_img', 'Изображение блока')
                ))
        ));

    Container::make('post_meta', 'Стоимость услуг')
        ->show_on_page('price')
        //->where( 'post_type', '=', 'portfolio' )
        ->add_fields(array(
            Field::make('complex', 'crb_price_chapters', 'Раздел')
                ->add_fields('chapters_titles', 'Добавить раздел', array(
                    Field::make('text', 'crb_price_chapter', 'Название')
                        ->set_width(50),
                    Field::make('rich_text', 'crb_price_chapter_desc', 'Краткое описание')
                        ->set_width(50),

                    Field::make('complex', 'crb_price_services', 'Услуги раздела')
                        ->add_fields('chapters_services', 'Добавить услугу', array(
                            Field::make('text', 'crb_service_head', 'Название услуги')
                                ->set_width(33),
                            Field::make('rich_text', 'crb_service_desc', 'Описание услуги')
                                ->set_width(33),
                            Field::make('text', 'crb_service_price', 'Цена услуги')
                                ->set_width(33),
                        ))
                ))
        ));

    Container::make('term_meta', 'Tags Properties')
        ->show_on_taxonomy('post_tag')
        ->add_fields(array(
            Field::make('color', 'crb_title_color', 'Цвет обводки')
                ->help_text('Выбрать цвет фона для этой метки'),
        ));

    Container::make('term_meta', 'Category')
        ->show_on_taxonomy('category')
        ->add_fields(array(
            Field::make('image', 'crb_cat_image', 'Изображение категории')
                ->help_text('Выбрать изображение для отоюражения в архивах этой категории'),
        ));
}
