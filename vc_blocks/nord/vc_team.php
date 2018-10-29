<?php 

/**
 * The Shortcode
 */
function candor_framework_nord_team_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '3',
				'filter' => 'all'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'team',
		'posts_per_page' => $pppage,
		'order'			=>"ASC"
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'team_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'team_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}

	$block_query = new WP_Query( $query_args );

	ob_start();
?>


	<div class="container">
		<div class="row add-top-quarter">
			<div class="row">
				<div class="row">

					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('template-parts/content', 'team');
						
						endwhile;	
						else : 
							
							/**
							 * Display no posts message if none are found.
							 */
							get_template_part('template-parts/content','none');
							
						endif;
					?>

				</div>
			</div>
		</div>
	</div>    



<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'nord_team', 'candor_framework_nord_team_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_nord_team_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'nord-vc-block',
			"name" => __("Team Feeds", 'nord'),
			"base" => "nord_team",
			"category" => esc_html__('NORD WP Theme', 'nord'),
			'description' => 'Show team posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'nord'),
					"param_name" => "pppage",
					"value" => '3'
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_nord_team_shortcode_vc');