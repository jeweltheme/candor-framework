<?php 

/**
 * The Shortcode
 */
function cast_blog_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'blog_title' 	=> '<span>Our</span> Latest Blog Post',
				'style' 		=> 'style1',
				'pppage' 		=> '3',
				'pagination' 	=> 'yes',
				'filter' 		=> 'all'
			), $atts 
		) 
	);
	
	// Fix for pagination
	if( is_front_page() ) { 
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; 
	} else { 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
	}
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'post',
		'posts_per_page' => $pppage,
		'paged' => $paged
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}

	$block_query = new WP_Query( $query_args );

	ob_start();
?>
		


<?php if( $style =="style1" ){ ?>

	<?php 
		if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();
		
				get_template_part( 'template-parts/content');

				echo function_exists('cast_pagination') ? cast_pagination() : posts_nav_link();

				wp_reset_postdata();
			}
		}   

		if( 'yes' == $pagination ){
			echo function_exists('cast_pagination') ? cast_pagination($block_query->max_num_pages) : posts_nav_link();
		}		
	?>
<?php } elseif( $style =="style2" ){ ?>
	
	<div class="tile-layout">
		<?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();
			
					get_template_part( 'template-parts/content','blog-two');

					
					
					wp_reset_postdata();
				}
			}   	
			if( 'yes' == $pagination ){
				echo function_exists('cast_pagination') ? cast_pagination($block_query->max_num_pages) : posts_nav_link();
			}
		?>
	</div>

<?php } ?>



			
<?php	
	
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'cast_blog', 'cast_blog_shortcode' );

/**
 * The VC Functions
 */
function cast_blog_shortcode_vc() {
	
	$blog_types = candor_get_blog_layouts();
	
	vc_map( 
		array(
		    "icon" => 'cast-vc-block',
		    "name" => esc_html__("Blog Layout", 'cast'),
		    "base" => "cast_blog",
		    "category" => esc_html__('CAST WP Theme', 'cast'),
			'description' => 'Show Blog posts with layout options.',
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __("Style", 'cast'),
					"param_name" => "style",
					"value" => array(
						'Style 1' => 'style1',
						'Style 2' => 'style2',
						'Style 3' => 'style3',
						),
					),					
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'cast'),
					"param_name" => "pppage",
					"value" => '3'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Pagination?", 'cast'),
					"param_name" => "pagination",
					"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
						),
					),


			)
		) 
	);
	
}
add_action( 'vc_before_init', 'cast_blog_shortcode_vc');