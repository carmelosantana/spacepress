<?php
declare(strict_types=1);

// setup default user options 
function spacepress_get_user_options(): array {
    return [
        [
            'name' => 'dashboard',
            'label' => 'Dashboard',
            'set_default_value' => spacepress_get_theme_options_default( 'dashboard' ),
        ],       
        [
            'name' => 'details',
            'label' => 'Details',
            'set_default_value' => spacepress_get_theme_options_default( 'details' ),
        ],
        [
            'name' => 'personal',
            'label' => 'Personal',
            'set_default_value' => spacepress_get_theme_options_default( 'personal' ),
        ],                
        [
            'name' => 'interests',
            'label' => 'Interests',
            'set_default_value' => spacepress_get_theme_options_default( 'interests' ),
        ],
        [
            'name' => 'blurbs',
            'label' => 'Blurbs',
            'set_default_value' => spacepress_get_theme_options_default( 'blurbs' ),
        ],              
    ];
}

// default values for user options
function spacepress_get_theme_options_default( string $option ): array {
    switch ( $option ){
        case 'blurbs':
            return [
                [
                    'name' => 'about_me',                        
                    'label' => 'About me',
                    'type' => 'rich_text',
                ],
                [
                    'name' => 'who_meet',                        
                    'label' => 'Who I\'d like to meet',
                    'type' => 'rich_text',
                ],
            ];

        case 'dashboard':
            return [
                [
                    'name' => 'mood',                        
                    'label' => 'Mood',
                    'type' => 'text',
                ],
                [
                    'name' => 'emoji',                        
                    'label' => 'Emoji',
                    'type' => 'text',
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
                    'name' => 'zodiac',                        
                    'label' => 'Zodiac',
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
                    'name' => 'streaming',
                    'label' => 'Streaming',
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

            case 'personal':
                return [
                    [
                        'name' => 'gender',                        
                        'label' => 'Gender',
                        'type' => 'select',
                        'select_values' => 'genders',
                    ],
                    [
                        'name' => 'date_of_birth',                        
                        'label' => 'Birthday',
                        'type' => 'date',
                    ],                
                    [
                        'name' => 'location',                        
                        'label' => 'Location',
                        'type' => 'text',
                    ]
            ];
            
            case 'top':
                return [
                    [
                        'name' => 'name',                        
                        'label' => 'Name',
                        'type' => 'text',
                    ],
                    [
                        'name' => 'label',                        
                        'label' => 'Label',
                        'type' => 'text',
                    ],
                ];
            break;
    }

    return [];
}

function spacepress_get_input_options( string $option='' ): array {
    switch ( $option ){
        default:
            return [
                'date' => 'date',
                'map' => 'map',
                'rich_text' => 'rich_text',
                'select' => 'select',
                'text' => 'text',
                'textarea' => 'textarea', 
            ];
    }

    return [];
}

function spacepress_get_select_groups(){
    return [
        '' => '',
        'genders' => 'Genders',
    ];
}

function spacepress_get_select_values( string $option ): array {
    switch ( $option ){
        case 'genders':
            return [
                'Agender' => 'Agender',
                'Androgyne' => 'Androgyne',
                'Aporagender' => 'Aporagender',
                'Autigender' => 'Autigender',
                'Bigender' => 'Bigender',
                'Cisgender' => 'Cisgender',
                'Demiboy' => 'Demiboy',
                'Demigirl' => 'Demigirl',
                'Female' => 'Female',
                'Genderfluid' => 'Genderfluid',
                'Genderflux' => 'Genderflux',
                'Genderqueer' => 'Genderqueer',
                'Gender' => 'Gender',
                'Male' => 'Male',
                'Man' => 'Man',
                'Maverique' => 'Maverique',
                'Neutrois' => 'Neutrois',
                'Nonbinary' => 'Nonbinary',
                'Pangender' => 'Pangender',
                'Polygender' => 'Polygender',
                'Third' => 'Third',
                'Transfeminine' => 'Transfeminine',
                'Transgender' => 'Transgender',
                'Transmasculine' => 'Transmasculine',
                'Trigender' => 'Trigender',
                'Two-spirit' => 'Two-spirit',
                'Woman' => 'Woman',
            ];            
        break;
    }

    return [];
}