<?php 

/**
 * The Shortcode
 */
function candor_framework_videstories_contact_map_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'map_lattitude' 		=> '-37.834812',
				'map_longitude' 		=> '144.963055',
				'map_zoom' 				=> '15',
				'map_icon'				=>	get_template_directory_uri() . '/images/marker.png',
		
			), $atts 
		) 
	);

	$output = '<section id="google-map">
			    <div class="map-container">
			      <div id="googleMaps" class="google-map-container"></div>
			    </div><!-- /.map-container -->
			  </section><!-- /#google-map-->';
	
ob_start();

$icon_url = wp_get_attachment_image_src( $map_icon, 'full');




wp_enqueue_script( 'gmap3', VIDEOSTORIES_JS . 'gmap3.min.js', array('jquery'), '', true );
wp_enqueue_script( 'google-map', '//maps.googleapis.com/maps/api/js?key=AIzaSyD5fopwUV7qSvU7HTfXhsntbAwWF0nLDqY', array(), '', true );

?>


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
	          center: {lat: <?php echo esc_attr($map_lattitude);?>, lng: <?php echo esc_attr($map_longitude);?> },
	          zoom: <?php echo esc_attr($map_zoom);?> ,
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

	        $('#googleMaps').gmap3({
	          map: {
	            options: options
	          },
	          marker: {
	            latLng: [ <?php echo esc_attr($map_lattitude);?>, <?php echo esc_attr($map_longitude);?> ],
	            options: { icon: '<?php echo esc_url_raw( $icon_url[0] );?>' }
	          }
	        });
	      }

	      init_gmap();

	    });
    
    </script>

	
<?php 

	// $output = ob_get_contents();
	// ob_end_clean();

	return $output;
}
add_shortcode( 'videostories_contact_map', 'candor_framework_videstories_contact_map_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_videstories_contact_map_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => __("Contact MAP", 'videstories'),
			"base" => "videostories_contact_map",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			'description' => 'Show Contact Map on Contact Section.',
			"params" => array(

				array(
					"type" => "textfield",
					"heading" => __("Lattitude", 'videstories'),
					"param_name" => "map_lattitude",
					'holder' => '',
					'value' => '-37.834812',
				),				
				array(
					"type" => "textfield",
					"heading" => __("Longitude", 'videstories'),
					"param_name" => "map_longitude",
					'holder' => '',
					'value' => '144.963055',
				),				
				array(
					"type" => "textfield",
					"heading" => __("Zoom", 'videstories'),
					"param_name" => "map_zoom",
					'holder' => '',
					'value' => '15',
				),					
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Map Icon', 'videstories' ),
					'param_name' => 'map_icon',
					'value' => get_template_directory_uri() . '/images/marker.png',
					"admin_label" => true,
					'description' => esc_html__( 'Select Map Icon Image from media library.', 'videstories' )
				),

			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_videstories_contact_map_shortcode_vc' );