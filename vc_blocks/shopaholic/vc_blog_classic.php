<?php 

/**
 * The Shortcode
 */
function candor_shopaholic_blog_classic_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				//'type' => 'strip',
				'pppage' => '6',
				'pagination' => 'yes',
				'filter' => 'all'
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

		$sidebar = shopaholic_get_page_sidebar_layouts_class();
	?>
		
	<div class="blog-classic">
		<?php if( $sidebar == 'right-sidebar' ) { ?>

	          <div class="col-md-8">

				<?php
				if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					} } else{
						get_template_part( 'template-parts/content', 'none' );
					}

					if( 'yes' == $pagination ){
						/**
						* Post pagination, use ebor_pagination() first and fall back to default
						*/
						echo function_exists('shopaholic_pagination') ? shopaholic_pagination($block_query->max_num_pages) : posts_nav_link();
					}								
				?>
			</div>

			<?php shopaholic_page_sidebar();?>


		<?php } elseif( $sidebar == 'left-sidebar' ){ ?>
	          <div class="col-md-8 pull-right">

				<?php
				if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					} } else{
						get_template_part( 'template-parts/content', 'none' );
					}

					if( 'yes' == $pagination ){
						/**
						* Post pagination, use ebor_pagination() first and fall back to default
						*/
						echo function_exists('shopaholic_pagination') ? shopaholic_pagination($block_query->max_num_pages) : posts_nav_link();
					}								
				?>
			</div>

			<?php shopaholic_page_sidebar();?>

		<?php } else{?>

				<?php
				if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					} } else{
						get_template_part( 'template-parts/content', 'none' );
					}

					if( 'yes' == $pagination ){
						/**
						* Post pagination, use ebor_pagination() first and fall back to default
						*/
						echo function_exists('shopaholic_pagination') ? shopaholic_pagination($block_query->max_num_pages) : posts_nav_link();
					}								
				?>
		<?php } ?>

		</div>

	<?php
	wp_enqueue_style( 'shopaholic-blog-classic-style', SHOPAHOLIC_CSS . 'blog/classic-01.css', false, SHOPAHOLIC_VER );
	
	wp_reset_postdata();
	wp_reset_query();
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_blog_classic', 'candor_shopaholic_blog_classic_shortcode' );

/**
 * The VC Functions
 */
function candor_shopaholic_blog_classic_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => esc_html__("Blog Classic", 'shopaholic-wp'),
			"base" => "shopaholic_blog_classic",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Classic Blog Posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'shopaholic-wp'),
					"param_name" => "pppage",
					"value" => '6'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Pagination?", 'shopaholic-wp'),
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
add_action( 'vc_before_init', 'candor_shopaholic_blog_classic_shortcode_vc');