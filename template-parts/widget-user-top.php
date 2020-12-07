<?php
$args = extract(wp_parse_args($args, [
    'user_id' => 0,
]));

// if no user id provided and we can't guess, we don't output anything
if ( !$user_id and !$user_id = spacepress_get_user_id() )
    return false;
?>
<section class="sp-top">
    <p class="sp-heading sp-header-top h6">Top</p>
    <div class="row">
        <?php
            foreach ( carbon_get_user_meta( $user_id, 'top' ) as $option ){
                echo '<div class="col-3 my-3 mx-auto p-0">';
                echo '<a href="' . $option['url'] . '" class="">' . $option['name'] . '</a>';
                echo wp_get_attachment_image( $option['image'] );
                echo '</div>';
            }
        ?>
    </div>
  </section>