<?php
declare(strict_types=1);

require __DIR__ . '/admin.php';

/**
 * Setup Carbon Fields
 */
add_action( 'carbon_fields_register_fields', 'spacepress_carbon_attach_theme_options' );
add_action( 'after_setup_theme', 'spacepress_carbon_load' );