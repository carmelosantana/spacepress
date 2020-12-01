<?php
declare(strict_types=1);

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function spacepress_default_options( string $option ): array {
    switch ( $option ){
        case 'dashboard':
            return [
                [
                    'name' => 'mood',                        
                    'label' => 'Mood',
                    'type' => 'text',
                    'set_width' => 50,
                ],
                [
                    'name' => 'emoji',                        
                    'label' => '',
                    'type' => 'text',
                    'set_width' => 50,
                ],                
                [
                    'name' => 'description',                        
                    'label' => 'Description',
                    'type' => 'text',
                ],    
                [
                    'name' => 'motd',                        
                    'label' => 'Message of the day',
                    'type' => 'textarea',
                ],                
            ];

        case 'details':
            return [
                [
                    'name' => 'status',                        
                    'label' => 'Status',
                    'type' => 'text',
                ],
                [
                    'name' => 'here_for',                        
                    'label' => 'Here for',
                    'type' => 'text',
                ],
                [
                    'name' => 'hometown',                        
                    'label' => 'Hometown',
                    'type' => 'text',
                ],
                [
                    'name' => 'ethnicity',                        
                    'label' => 'Ethnicity',
                    'type' => 'text',
                ],
                [
                    'name' => 'zodiac_sign',                        
                    'label' => 'Zodiac Sign',
                    'type' => 'text',
                ],
                [
                    'name' => 'smoke_drink',                        
                    'label' => 'Smoke / Drink',
                    'type' => 'text',
                ],
                [
                    'name' => 'education',                        
                    'label' => 'Education',
                    'type' => 'text',
                ],
                [
                    'name' => 'occupation',                        
                    'label' => 'Occupation',
                    'type' => 'text',
                ],
            ];

        case 'interests':
            return [
                [
                    'name' => 'general',
                    'label' => 'General',
                    'type' => 'rich_text',
                ],
                [
                    'name' => 'music',
                    'label' => 'Music',
                    'type' => 'rich_text',
                ],
                [
                    'name' => 'movies',
                    'label' => 'Movies',
                    'type' => 'rich_text',
                ],
                [
                    'name' => 'television',
                    'label' => 'Television',
                    'type' => 'rich_text',
                ],
                [
                    'name' => 'books',
                    'label' => 'Books',
                    'type' => 'rich_text',
                ],
                [
                    'name' => 'heroes',
                    'label' => 'Heroes',
                    'type' => 'rich_text',
                ],        
            ];

            case 'layout':
                return [
                    [
                        'name' => 'top_8_limit',                        
                        'label' => 'How many in your top "8"?',
                        'type' => 'text',
                    ],
                    [
                        'name' => 'blog_limit',                        
                        'label' => 'How many blog posts to list on profile page?',
                        'type' => 'text',
                    ],
                ];    
    }

    return [];
}

function spacepress_carbon_attach_theme_options(){
    $text_inputs = [
        'text' => 'text',
        'textarea' => 'textarea',
        'rich_text' => 'rich_text',
    ];

    $define_user_meta = [
        [
            'name' => 'dashboard',
            'label' => 'Dashboard',
            'set_options' => $text_inputs,
            'set_default_value' => spacepress_default_options( 'dashboard' ),
        ],
        [
            'name' => 'interests',
            'label' => 'Interests',
            'set_options' => $text_inputs,
            'set_default_value' => spacepress_default_options( 'interests' ),
        ],
        [
            'name' => 'details',
            'label' => 'Details',
            'set_options' => $text_inputs,
            'set_default_value' => spacepress_default_options( 'details' ),
        ]        
    ];

    $container = Container::make( 'theme_options', __( 'SpacePress' ) )
        // ->set_page_menu_position( 60 )
        // ->set_page_menu_title( 'Options' )
        ->set_icon( 'dashicons-groups' );

    foreach ( $define_user_meta as $option ){
        $container->add_tab( __( $option['label'] ), [
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
                ->set_options( $option['set_options'] ),
                ] )
                ->set_default_value( $option['set_default_value'] )              
        ]);   
    }  

    $user = Container::make( 'user_meta', __( 'About Me' ) );
    foreach ( $define_user_meta as $id ){
        $user->add_fields( [
            Field::make( 'separator', $id['name'], $id['label'] )
        ]); 
        foreach ( carbon_get_theme_option( $id['name'] ) as $option ){
            $user->add_fields( [
                Field::make( $option['type'], $option['name'], __( $option['label'] ) )
                ->set_width( $option['set_width'] ?? 100 ),
            ] );
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