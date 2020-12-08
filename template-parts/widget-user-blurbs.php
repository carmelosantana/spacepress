<?php
declare(strict_types=1);

$args = extract(wp_parse_args($args, [
    'user_id' => 0,
]));

// if no user id provided and we can't guess, we don't output anything
if ( !$user_id and !$user_id = spacepress_get_user_id() )
    return false;
?>
<section class="sp-blurbs mt-4">
    <div class="row">
        <div class="col">
            <p class="h6 sp-heading "><?php echo spacepress_get_display_name( $user_id ) . __( '\'s latest blurbs', 'spacepress' ); ?>
            <?php
                foreach ( carbon_get_theme_option( 'blurbs' ) as $option ){
                    echo '<dt class="sp-header-' . $option['name'] . ' h6">' . $option['label'] . ':</dt>';
                    echo '<dd class="sp-details">' . carbon_get_user_meta( $user_id, $option['name'] ) . '</dd>';
                }
            ?>
        </div>
    </div>
</section>