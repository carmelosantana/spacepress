<?php
declare(strict_types=1);

// tries to resolve a user ID 
function spacepress_get_user_id() {
    // we should have an ID before needing this function
    if ( function_exists( 'buddypress' ) )
        return 0;
    
    // get admins and site users
    $administrators = get_users( [ 'role__in' => [ 'author', 'administrator' ] ] );
    $users = get_users();

    // if we have only 1 user, the site admin, lets assume they are the primary user
    if ( count( $administrators ) == 1 and count( $users ) == 1 )
        return $administrators[0]->ID;
}