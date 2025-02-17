<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Magxpress
 */
get_header();
// Add a main container in case if sidebar is present
$class = '';
$page_layout = magxpress_get_page_layout();
$current_id = '';
if (have_posts()) :
    while (have_posts()) :
        the_post();
        $current_id  = get_the_ID();
    endwhile;
    wp_reset_postdata();
endif;
?>
<?php
global $post;
$magxpress_post_layout = esc_html(get_post_meta($current_id, 'magxpress_post_layout', true));
$featured_image = "";
if (has_post_thumbnail($post->ID)) {
    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
    $featured_image = isset($featured_image[0]) ? $featured_image[0] : '';
}
if ($magxpress_post_layout == "layout-2") { ?>
    <div class="single-featured-banner">
        <div class="featured-banner-media">
            <div class="data-bg data-bg-large data-bg-fixed" data-background="<?php echo esc_url($featured_image); ?>"></div>
        </div>
        <div class="featured-banner-content">
            <div class="wrapper">
                <?php $display_read_time_in = magxpress_get_option('display_read_time_in');
                if (in_array('single-page', $display_read_time_in)) {
                    magxpress_read_time();
                } ?>

                <header class="entry-header">
                    <?php
                    if (is_singular()) :
                        the_title('<h1 class="entry-title entry-title-xlarge">', '</h1>');
                    else :
                        the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                    endif; ?>
                </header><!-- .entry-header -->
                <?php
                if ('post' === get_post_type()) :
                ?>
                <div class="magxpress-meta-group">
                        <?php
                        magxpress_posted_on();
                        magxpress_posted_by();
                        ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php } elseif ($magxpress_post_layout == "layout-3"){ ?>
    <div class="featured-banner-style3">
        <div class="featured-banner-media">
            <div class="data-bg data-bg-large data-bg-fixed" data-background="<?php echo esc_url($featured_image); ?>"></div>
        </div>
        <div class="featured-banner-content">
            <div class="wrapper">

                <header class="entry-header has-box-shadow">
                    <?php $display_read_time_in = magxpress_get_option('display_read_time_in');
                    if (in_array('single-page', $display_read_time_in)) {
                        magxpress_read_time();
                    } ?>
                    <?php
                    if (is_singular()) :
                        the_title('<h1 class="entry-title entry-title-xlarge">', '</h1>');
                    else :
                        the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                    endif; ?>
                    <?php
                    if ('post' === get_post_type()) :
                    ?>
                    <div class="magxpress-meta-group">
                            <?php
                            magxpress_posted_on();
                        magxpress_posted_by();
                            ?>
                    </div>
                    <?php endif; ?>
                </header><!-- .entry-header -->
            </div>
        </div>
    </div>
<?php } ?>

<main id="site-content" role="main">
    <div class="wrapper">
        <div id="primary" class="content-area theme-sticky-component">

            <?php
            while (have_posts()) :
                the_post();

                get_template_part('template-parts/content', get_post_type());

                the_post_navigation(
                    array(
                        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'magxpress') . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'magxpress') . '</span> <span class="nav-title">%title</span>',
                    )
                );

                if ('post' === get_post_type()) :

                    // Get Author Info & related/Author posts
                    $show_author_info = magxpress_get_option('show_author_info');
                    $show_related_posts = magxpress_get_option('show_related_posts');
                    $show_author_posts = magxpress_get_option('show_author_posts');

                    if ($show_author_info) :
                        get_template_part('template-parts/single/author-info');
                    endif;

                    if ($show_related_posts) :
                        get_template_part('template-parts/single/related-posts');
                    endif;

                    if ($show_author_posts) :
                        get_template_part('template-parts/single/author-posts');
                    endif;

                endif;

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>

        </div><!-- #primary -->
        <?php
        if ('no-sidebar' != $page_layout) {
            get_sidebar();
        }
        ?>
    </div>
</main>

<!--sticky-article-navigation starts-->
<?php $show_sticky_article_navigation = magxpress_get_option('show_sticky_article_navigation');
if ($show_sticky_article_navigation) {
    $next_post = get_next_post();
    $prev_post = get_previous_post(); ?>
    <div class="sticky-article-navigation">
        <?php if (isset($prev_post->ID)) {

            $prev_link = get_permalink($prev_post->ID); ?>
            <a class="sticky-article-link sticky-article-prev" href="<?php echo esc_url($prev_link); ?>">
                <div class="sticky-article-icon">
                    <?php magxpress_theme_svg('arrow-left'); ?>
                </div>
                <article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-sticky-article'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="entry-image entry-image-thumbnail">
                                <?php if (get_the_post_thumbnail($prev_post->ID, 'medium')) { ?>
                                    <?php echo wp_kses_post(get_the_post_thumbnail($prev_post->ID, 'medium')); ?>
                                <?php } ?>
                        </div>
                    <?php endif; ?>
                    <div class="entry-details">
                        <h3 class="entry-title entry-title-small">
                            <?php echo esc_html(get_the_title($prev_post->ID)); ?>
                        </h3>
                    </div>
                </article>
            </a>

        <?php }

        if (isset($next_post->ID)) {

            $next_link = get_permalink($next_post->ID); ?>

            <a class="sticky-article-link sticky-article-next" href="<?php echo esc_url($next_link); ?>">
                <div class="sticky-article-icon">
                    <?php magxpress_theme_svg('arrow-right'); ?>
                </div>
                <article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-sticky-article'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="entry-image entry-image-thumbnail">

                                <?php if (get_the_post_thumbnail($next_post->ID, 'medium')) { ?>
                                    <?php echo wp_kses_post(get_the_post_thumbnail($next_post->ID, 'medium')); ?>
                                <?php } ?>

                        </div>
                    <?php endif; ?>
                    <div class="entry-details">
                        <h3 class="entry-title entry-title-small">
                            <?php echo esc_html(get_the_title($next_post->ID)); ?>
                        </h3>
                    </div>
                </article>
            </a>

        <?php
        } ?>
    </div>


<?php } ?>
<!--sticky-article-navigation ends-->

<?php
get_footer();
