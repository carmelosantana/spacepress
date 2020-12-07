<?php
if ( !$ads = carbon_get_theme_option( 'ads' ) )
    return false;

$ad = $ads[array_rand( $ads )];
?>
<section class="sp-support-space m-0">
    <div class="row">
      <div class="d-flex flex-column">
        <?php
            switch ( $ad['_type'] ){
                case 'image':
                    echo '<a href="' . $ad['url'] . '" title="' . $ad['name'] . '" class="position-relative top-50 left-50 translate-middle">';
                    echo wp_get_attachment_image( $ad['image'], 'original' );
                    echo '</a>';
                break;
            }
        ?>
        </div>
    </div>
  </section>