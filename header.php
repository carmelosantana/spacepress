<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SpacePress
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="container">
        <header class="sp-header">
            <?php get_template_part( 'template-parts/widget-ads' ); ?>
        </header>
        <nav class="navbar navbar-expand-lg sp-primary-menu" role="navigation">
            <div class="container-fluid">
                <button class="navbar-toggler bg-light" type="button" data-toggle="collapse"
                    data-target="#sp-primary-menu" aria-controls="sp-primary-menu"
                    aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'spacepress' ); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php
                    wp_nav_menu( [ 
                        'theme_location' => 'menu-1',
                        'menu_id' => 'primary-menu',
                        'depth' => 2,
                        'container' => 'div',
                        'container_class' => 'collapse navbar-collapse',
                        'container_id' => 'sp-primary-menu',
                        'menu_class' => 'navbar-nav mr-auto mb-2 mb-lg-0',
                        'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                        'walker' => new WP_Bootstrap_Navwalker(),
                    ] );
                ?>
                <form class="d-flex">
                    <input class="form-control mr-2 p-1 rounded-0 border-0 lh-1" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn rounded-0 border-0 btn-light" type="submit">Search</button>
                </form>
            </div>
        </nav>      
        <div class="row sp-body-wrap">
