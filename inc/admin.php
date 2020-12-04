<?php
declare(strict_types=1);

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function spacepress_carbon_attach_theme_options(){
    // start main options
    $primary_container = Container::make( 'theme_options', __( 'SpacePress' ) )
        ->set_icon( 'dashicons-groups' )
        ->add_tab( __( 'Setup'), [
            Field::make( 'radio', 'instance', __( 'User Environment' ) )
            ->set_options( [
                0 => 'Single site, single user',
                1 => 'Single site, multiple users',
                2 => 'BuddyPress',
            ] ),
        ])
        ->add_tab( __( 'Theme'), [
            Field::make( 'textarea', 'tracking_scripts', __( 'Tracking Script' ) ),
            Field::make( 'header_scripts', 'header_scripts', __( 'Header Script' ) ),
            Field::make( 'footer_scripts', 'footer_scripts', __( 'Footer Script' ) ),
        ]);

    // add new container for user options
    $user_options_container = Container::make( 'theme_options', __( 'User Options' ) )
        ->set_page_parent( $primary_container );

    // builds user options
    foreach ( spacepress_get_user_options() as $option ){
        $user_options_container->add_tab( __( $option['label'] ), [
            Field::make( 'complex', $option['name'], $option['label'] )
            ->add_fields( [                
                Field::make( 'text', 'name', __( 'Name' ) )
                ->set_width( 50 ),
                Field::make( 'text', 'label', __( 'Label' ) )
                ->set_width( 50 ),
                Field::make( 'text', 'set_width', __( 'Width' ) )
                ->set_width( 50 ),
                Field::make( 'select', 'type', __( 'Type' ) )
                ->set_width( 50 )
                ->set_options( spacepress_get_input_options() ),
                Field::make( 'select', 'select_values', __( 'Select Values' ) )
                ->set_width( 50 )
                ->set_options( spacepress_get_select_groups() ),
            ] )
            ->set_default_value( $option['set_default_value'] )              
        ]);   
    }
}

function spacepress_carbon_attach_user_meta(){  
    // return;  
    // start user meta container
    $user_meta_container = Container::make( 'user_meta', __( 'About Me' ) );

    foreach ( spacepress_get_user_options() as $id ){
        // separate sections
        $user_meta_container->add_fields( [
            Field::make( 'separator', $id['name'], $id['label'] )
        ]);
        
        // build user meta options
        foreach ( carbon_get_theme_option( $id['name'] ) as $option ){
            if ( empty($option['name']) or empty($option['type']) )
                continue;

            switch ( $option['type'] ){
                case 'select':
                    $user_meta_container->add_fields( [
                        Field::make( $option['type'], $option['name'], __( $option['label'] ) )
                        ->set_width( $option['set_width'] ?? 100 )
                        ->set_options( spacepress_get_select_values( $option['select_values'] ) )
                    ] );                    
                break;

                default:
                    $user_meta_container->add_fields( [
                        Field::make( $option['type'], $option['name'], __( $option['label'] ) )
                        ->set_width( $option['set_width'] ?? 100 )
                    ] );
                break;
            }
        }
    }

    // // enable multiple zones like this, work, study etc 
    // $user->add_tab( __( 'School' ), [
    //     Field::make( 'complex', 'school', __( 'School' ) )
    //     ->add_fields( [
    //         Field::make( 'text', 'name', __( 'Name' ) )
    //         ->set_width( 40 ),
    //         Field::make( 'text', 'location', __( 'Location' ) )
    //         ->set_width( 40 ),
    //         Field::make( 'text', 'study', __( 'Study' ) )
    //         ->set_width( 40 ),
    //         Field::make( 'date', 'attend_start', __( 'From' ) )
    //         ->set_storage_format( 'Y' )
    //         ->set_width( 40 ),
    //         Field::make( 'date', 'attend_end', __( 'To' ) )
    //         ->set_storage_format( 'Y' )
    //         ->set_width( 40 )
    //         ] )     
    // ]);    
}

function spacepress_carbon_load() {
    \Carbon_Fields\Carbon_Fields::boot();
}