<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_contact_map_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'lattitude' 		=> '-37.834812',
				'longitude' 		=> '144.963055',
				'zoom' 				=> '15',
				'map_icon' 			=> get_template_directory_uri() . '/images/map-icon.png',
	
			), $atts 
		) 
	);

	ob_start();
?>

		<div id="google-map">
          <div class="map-container">
            <div id="googleMaps" class="google-map-container"></div>
          </div><!-- /.map-container -->
        </div><!-- /#google-map-->

        
	<script type="text/javascript">

    			jQuery(document).ready(function($) {
    				"use strict";


    				/*----------- Google Map - with support of gmaps.js ----------------*/
    				function isMobile() {
    					return ('ontouchstart' in document.documentElement);
    				}

    				function init_gmap() {
    					if ( typeof google == 'undefined' ) return;
    					var options = {
    						center: {lat: '<?php echo esc_html__($lattitude);?>', lng: '<?php echo esc_html__($longitude);?>' },
    						zoom: <?php echo esc_html__($zoom);?>,
    						mapTypeControl: true,
    						mapTypeControlOptions: {
    							style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
    						},
    						navigationControl: true,
    						scrollwheel: false,
    						streetViewControl: true,
    						styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#cdcdcd"},{"visibility":"on"}]}]
    					}

    					if (isMobile()) {
    						options.draggable = false;
    					}

    					jQuery('#googleMaps').gmap3({
    						map: {
    							options: options
    						},
    						marker: {
    							latLng: ['<?php echo esc_html__($lattitude);?>', '<?php echo esc_html__($longitude);?>'],
    							options: { icon: '<?php echo esc_url_raw( $map_icon );?>' }
    						}
    					});
    				}

    				init_gmap();

    			});
			</script>
    		
<?php

	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_contact_map', 'candor_framework_shopaholic_contact_map_shortcode' );



/**
 * The VC Functions
 */
function candor_framework_shopaholic_contact_map_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Contact MAP", 'shopaholic-wp'),
			"base" => "shopaholic_contact_map",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Google MAP Details.',
			"params" => array(


				array(
					"type" => "textfield",
					"heading" => __("Lattitude", 'shopaholic-wp'),
					"param_name" => "lattitude",
					'holder' => 'div',
					'value' => '-37.834812',
				),					
				array(
					"type" => "textfield",
					"heading" => __("Longitude", 'shopaholic-wp'),
					"param_name" => "longitude",
					'holder' => 'div',
					'value' => '144.963055',
				),		
				array(
					"type" => "textfield",
					"heading" => __("ZOOM", 'shopaholic-wp'),
					"param_name" => "zoom",
					'holder' => 'div',
					'value' => '15',
				),		
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'MAP Icon', 'shopaholic-wp' ),
					'param_name' => 'map_icon',
					'value' => get_template_directory_uri() . '/images/map-icon.png',
					"admin_label" => true,
					'description' => esc_html__( 'Select image from media library.', 'shopaholic-wp' )
					),			



			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_contact_map_shortcode_vc' );