<?php
$args = extract(wp_parse_args($args, [
    'user_id' => 0,
    'name' => null,
    'label' => null,
]));

// if no user id provided and we can't guess, we don't output anything
if ( !$user_id and !$user_id = spacepress_get_user_id() )
    return false;

if ( !$motd = carbon_get_user_meta( $user_id, 'motd' ) )
    return false;

$cite = carbon_get_user_meta( $user_id, 'motd_cite' );
?>
<section class="container sp-blurbs">
    <div class="row">
        <?php
            foreach ( carbon_get_theme_option( 'blurbs' ) as $option ){
                echo '<div class="col-12 m-0 p-0">';
                echo '<h5 class="">' . $option['label'] . '</h5>';
                echo '<p class="">' . carbon_get_user_meta( $user_id, $option['name'] ) . '</p>';
                echo '</div>';
            }
        ?>
    </div>
  </section>