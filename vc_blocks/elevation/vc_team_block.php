<?php 

/**
 * The Shortcode
 */
function candor_team_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 			=> 'carousel',
				'pppage' 		=> '5',
				'style' 		=> 'default',
				'filter' 		=> 'all',
				//'team_cat' 		=> ''
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'team',
		'posts_per_page' => $pppage
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
	<?php if( $style =="default" ){ ?>
		<div class="section-details">
	        <div id="volunteers-slider" class="volunteers-slider owl-carousel owl-theme">

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

	<?php } elseif($style == "grid"){ ?>

		<div class="section-details">
			<div id="volunteers-grid" class="volunteers-grid">

				<?php 
				if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();

						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('template-parts/content', 'team-grid');

						} }
					?>
				</div>
			</div>

	<?php } ?>
				
<?php	
	wp_reset_postdata();
	wp_reset_query();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'elevation_team', 'candor_team_shortcode' );


/**
 * The VC Functions
 */
function candor_team_shortcode_vc() {

	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => __("Team Feeds", 'elevation'),
			"base" => "elevation_team",
			"category" => esc_html__('Elevation WP Theme', 'elevation'),
			'description' => 'Show team posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'elevation'),
					"param_name" => "pppage",
					"value" => '4'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Style", 'elevation'),
					"param_name" => "style",
					"value" => array(
						'Default Style' 	=> 'default',
						'Grid Style' 		=> 'grid'
					),
				),
				// array(
				// 	'type' => 'dropdown',
				// 	'heading' => esc_html__( 'Team Category', 'elevation' ),
				// 	'param_name' => 'team_cat',
				// 	'value'		  => $categories_array,
				// 	'description' => esc_html__( 'List of Team categories', 'elevation' ),
				// ),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_team_shortcode_vc');