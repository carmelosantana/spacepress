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

if ( !$motd = carbon_get_user_meta( $user_id, 'motd' ) )
    return false;

$cite = carbon_get_user_meta( $user_id, 'motd_cite' );
?>
<figure class="border">
    <blockquote class="blockquote p-4 m-0">
        <p ><?php echo $motd; ?></p>
    </blockquote>
    <?php
        if ( $cite ) {
            echo '<figcaption class="blockquote-footer">';
            echo $cite;
            echo '</figcaption>';
        }
    ?>
</figure>