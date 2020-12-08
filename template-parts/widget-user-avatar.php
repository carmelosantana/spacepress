<?php
$args = extract(wp_parse_args($args, [
    'user_id' => 0,
]));

// if no user id provided and we can't guess, we don't output anything
if ( !$user_id and !$user_id = spacepress_get_user_id() )
    return false;

// define callback, defaults to getting carbon_get_meta
$details = [ 
    'gender' => null,
    'date_of_birth' => 'age',
    'location' => null,
];
foreach ( $details as $detail => $callback ){
    $value = carbon_get_user_meta( $user_id, $detail );

    switch ( $callback ){
        case 'age':
            if ( $value )
                $value = spacepress_get_age( $value ) . ' years old';

        case 'gender':
            $key = $detail . '_custom';
            if ( $custom_value = carbon_get_user_meta( $user_id, $key ) ){
                $value = $custom_value;
            }

        default:
            $details[$detail] = $value;
        break;
    }
}
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
                <p class="site-title mb-0 h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
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
            <ul class="list-unstyled mx-auto">
                <?php
                    foreach ( $details as $detail => $data ){
                        if ( $data )
                            echo '<li>' . $data . '</li>';
                    }
                ?>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-flex sp-mood">
        <?php
            /**
             * Mood
             */
            $mood = carbon_get_user_meta( $user_id, 'mood' );
            $emoji = carbon_get_user_meta( $user_id, 'emoji' );
            if ( $mood or $emoji )
                echo __( '<strong>Mood: </strong>' ) . ( $mood ? $mood . ' ' : null ) . ( $emoji ? $emoji : null );

            /**
             * Photos, videos
             */
            ?>
        </div>
    </div>
</div>