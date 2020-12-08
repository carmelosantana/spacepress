<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SpacePress
 */
?>
<div class="col-md-4">
	<?php
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		dynamic_sidebar( 'sidebar-1' );
		
	} else {
		get_template_part( 'template-parts/widget-user-avatar');
				
		get_template_part( 'template-parts/widget-user-list', null, [
			'name' => 'interests',
			'label' => 'Interests',
		] );
		
		get_template_part( 'template-parts/widget-user-list', null, [
			'name' => 'details',
			'label' => 'Details',
		] );
	}
	?>
        </div>

