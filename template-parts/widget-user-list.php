<?php
declare(strict_types=1);

$args = extract(wp_parse_args($args, [
    'user_id' => 0,
    'name' => null,
    'label' => null,
]));

// if no user id provided and we can't guess, we don't output anything
if ( !$user_id and !$user_id = spacepress_get_user_id() )
    return false;
?>
<section class="sp-details-interests my-2">
    <h6 class="sp-heading m-0"><?php echo $label; ?></h6>
    <table class="table m-0">
        <tbody>    
        <?php
            foreach ( carbon_get_theme_option( $name ) as $option ){      
                echo '<tr>';
                echo '<th scope="row" class="sp-heading sp-header-' . $option['name'] . '">' . $option['label'] . '</th>';
                echo '<td class="sp-details">' . carbon_get_user_meta( $user_id, $option['name'] ) . '</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>    
</section>