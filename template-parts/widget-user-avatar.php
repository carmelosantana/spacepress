<?php
$args = extract(wp_parse_args($args, [
    'user_id' => 0,
]));

// if no user id provided and we can't guess, we don't output anything
if ( !$user_id and !$user_id = spacepress_get_user_id() )
    return false;


?>
<div class="col">
    <div class="row">
        <div class="site-branding col">
            <?php
            the_custom_logo();
            if ( is_front_page() && is_home() ) :
                ?>
                <h1 class="site-title mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php
            else :
                ?>
                <p class="site-title mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php
            endif;
            $spacepress_description = get_bloginfo( 'description', 'display' );
            if ( $spacepress_description || is_customize_preview() ) :
                ?>
                <p class="site-description mb-1 text-muted"><?php echo $spacepress_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
            <?php endif; ?>
        </div><!-- .site-branding -->
    </div>
    <div class="row">
        <div class="col-6">
            <?php echo get_avatar( $user_id, 300 ); ?>
        </div>        
        <div class="col-6">
            <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
            <a href="#">Continue reading</a>
        </div>
    </div>
</div>