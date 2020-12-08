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

function spacepress_get_age( $date, $format='%y' ){
    $diff = date_diff( date_create( $date ), date_create( date("Y-m-d") ) );
    
    return $diff->format( $format );   
}

function spacepress_get_display_name( int $user_id=null, string $get='first_name' ): string {
    if ( !$user = new WP_User( $user_id ) )
        return bloginfo( 'name' );

    switch ( $get ){
        case 'display_name':
        case 'first_name':
        case 'last_name':
        	if ( $user->$get )
                return $user->first_name;
    }

    return bloginfo( 'name' );
}