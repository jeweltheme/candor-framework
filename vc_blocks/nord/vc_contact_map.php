<?php 

/**
 * The Shortcode
 */
function candor_framework_nord_contact_map_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'map_lattitude' 		=> '49.2741087',
				'map_longitude' 		=> '-123.1162723',
				'map_zoom' 				=> '11',
		
			), $atts 
		) 
	);
	
	$output = '<div class="container">
                    <div class="row">
                        <article class="col-md-12 map-wrap no-pad">
                            <div id="map" class="halfheight"></div>
                        </article>
                    </div>
              </div>';
	
ob_start();



wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?sensor=false', false, NORD_VER );

	?>
	<script type="text/javascript">
	jQuery(document).ready(function(){

            // When the window has finished loading create our google map below
            google.maps.event.addDomListener(window, 'load', init);
        
            function init() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: <?php echo esc_attr($map_zoom);?>,

                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(<?php echo esc_attr($map_lattitude);?>, <?php echo esc_attr($map_longitude);?>), // New York

                    // How you would like to style the map. 
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},
	                    {"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},
	                    {"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},
	                    {"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},
	                    {"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},
	                    {"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},
	                    {"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},
	                    {"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},
	                    {"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},
	                    {"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},
	                    {"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},
	                    {"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},
	                    {"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
                };

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');

                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);

                // Let's also add a marker while we're at it
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(<?php echo esc_attr($map_lattitude);?>, <?php echo esc_attr($map_longitude);?>),
                    map: map,
                    title: 'Snazzy!'
                });
            }

            });
        </script>

	
<?php 

	// $output = ob_get_contents();
	// ob_end_clean();

	return $output;
}
add_shortcode( 'nord_contact_map', 'candor_framework_nord_contact_map_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_nord_contact_map_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'nord-vc-block',
			"name" => __("Contact MAP", 'nord'),
			"base" => "nord_contact_map",
			"category" => esc_html__('NORD WP Theme', 'nord'),
			'description' => 'Show Counter Parts on Contact Section.',
			"params" => array(

				array(
					"type" => "textfield",
					"heading" => __("Lattitude", 'nord'),
					"param_name" => "map_lattitude",
					'holder' => '',
					'value' => '49.2741087',
				),				
				array(
					"type" => "textfield",
					"heading" => __("Longitude", 'nord'),
					"param_name" => "map_longitude",
					'holder' => '',
					'value' => '-123.1162723',
				),				
				array(
					"type" => "textfield",
					"heading" => __("Zoom", 'nord'),
					"param_name" => "map_zoom",
					'holder' => '',
					'value' => '11',
				),					


			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_nord_contact_map_shortcode_vc' );