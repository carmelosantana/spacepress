<?php
declare(strict_types=1);

$args = extract(wp_parse_args($args, [
    'user_id' => 0,
]));

// if no user id provided and we can't guess, we don't output anything
if ( !$user_id and !$user_id = spacepress_get_user_id() )
    return false;
?>
<section class="sp-top">
    <?php
        foreach ( carbon_get_theme_option( 'top' ) as $top ){
            echo '<p class="sp-heading h6">' . spacepress_get_display_name( $user_id ) . __( '\'s ', 'spacepress' ) . strtolower( $top['label'] ) . '</p>';
            echo '<div class="d-flex flex-row">';
            echo '<div class="col-12">';
            
            switch ( $top['_type'] ){
                case 'url':
                    foreach ( carbon_get_user_meta( $user_id, $top['name'] ) as $option ){
                        echo '<div class="float-left sp-image">';
                        echo '<a href="' . $option['url'] . '" class="d-inline-block">' . $option['name'] . '</a><br>';
                        echo wp_get_attachment_image( $option['image'] );
                        echo '</div>';
                    }        
                break;
            }

            echo '</div>';
            echo '</div>';
        }
    ?>
</section>