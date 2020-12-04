<?php
$args = extract(wp_parse_args($args, [
    'user_id' => 0,
    'name' => null,
    'label' => null,
]));

// if no user id provided and we can't guess, we don't output anything
if ( !$user_id and !$user_id = spacepress_get_user_id() )
    return false;
?>
<section class="sp-details-interests">
    <div class="card mb-4 float-left">
        <h5 class="card-header p-1"><?php echo $label; ?></h5>
        <div class="card-body p-0">
            <?php
                foreach ( carbon_get_theme_option( $name ) as $option ){
                    echo '<div class="clearfix p-0 sp-' . $option['name'] . '">';
                    echo '<h6 class="card-title col-5 float-left p-1">' . $option['label'] . '</h6>';
                    echo '<p class="card-text col-7 float-right p-1">' . carbon_get_user_meta( $user_id, $option['name'] ) . '</p>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
</section>