<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Magxpress
 */
?>
<!doctype html>
<html <?php language_attributes(); magxpress_force_dark_mode();?> >
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php do_action( 'magxpress_before_site' ); ?>
<div id="page" class="site">
    <div class="site-content-area">
    <?php get_template_part( 'template-parts/header/loader' ); ?>
    <?php $ed_header_ad = magxpress_get_option( 'ed_header_ad' );
    if ($ed_header_ad) {
        get_template_part( 'template-parts/header/welcome-screen-banner' );
    } ?>
    <?php get_template_part( 'template-parts/header/progressbar' ); ?>
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'magxpress'); ?></a>
    <?php do_action( 'magxpress_before_header' ); ?>
    <?php get_template_part('template-parts/header/theme-header'); ?>
    <?php do_action( 'magxpress_before_content' ); ?>

    <?php $is_slider_section = magxpress_get_option('enable_slider_section');
    if ((is_front_page() && is_home()) || is_page_template('template-parts/front-page-template.php')) {

        if ($is_slider_section) {
            get_template_part('template-parts/front-page/slider-section');
        }

            get_template_part('template-parts/front-page/banner-section');

            $enable_category_section = magxpress_get_option('enable_category_section');
            if ($enable_category_section) {
                get_template_part('template-parts/front-page/categories-section');
            }

            $enable_read_more_post_section = magxpress_get_option('enable_read_more_post_section');
            if ($enable_read_more_post_section) {
                get_template_part('template-parts/front-page/more-to-read');
            }

            $enable_top_widget_area = magxpress_get_option('enable_top_widget_area');

            if ($enable_top_widget_area && is_active_sidebar('frontpage-fullwidth-top-area')) { ?>
                 <section class="site-section fullwidth-widgetarea-top">
                    <div class="theme-widgetarea theme-widgetarea-full">
                        <div class="wrapper">
                          <?php dynamic_sidebar('frontpage-fullwidth-top-area'); ?>
                      </div>
                    </div>
                </section>
             <?php }


    }