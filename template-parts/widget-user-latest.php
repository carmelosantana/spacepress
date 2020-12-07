<?php
$args = extract(wp_parse_args($args, [
    'user_id' => 0,
    'name' => null,
    'label' => null,
]));

// if no user id provided and we can't guess, we don't output anything
if ( !$user_id and !$user_id = spacepress_get_user_id() )
    return false;

$query = new WP_Query( [
    'author' => $user_id,
] );
?>
<div class="row">
    <div class="col">
        <p class="h6">Latest entries</p>
        <ul class="list-unstyled">
        <?php
            if ( $query->have_posts() ){
                while ( $query->have_posts() ){
                    $query->the_post();
                    echo get_the_title() . ' (<a href="' . get_the_permalink() . '" >' . __('view more') . '</a>)';
                }
            }
        ?>
        </ul>
        [<a href=""><?php echo __( 'View all blog entries', 'spacepress' ); ?></a>]
    </div>
</div>