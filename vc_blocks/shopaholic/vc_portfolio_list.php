<?php 

/**
 * The Shortcode
 */
function candor_shopaholic_portfolio_list_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' 			=> '999',
				'pagination' 		=> 'yes',
				'filter' 			=> 'all',
				'filters' 			=> 'yes',
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
		'post_type' => 'portfolio',
		'posts_per_page' => $pppage,
		'paged' => $paged
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'portfolio_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'portfolio_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}


	if( $filter == 'all' ){
		$cats = get_categories('taxonomy=portfolio_category');
	} else {
		$cats = get_categories('taxonomy=portfolio_category&exclude='. $filter .'&child_of='. $filter);
	}

	
	$block_query = new WP_Query( $query_args );
	//Array Resize Full Thumbnail Image

	ob_start();

?>

<section class="portfolio text-center">
    <div class="section-padding">
      <div class="container">
        <div class="row">


		<?php if( 'yes' == $filters && !( is_tax() ) ) { ?>
            <ul class="filter">
    	        <li><a class="active" href="#" data-filter="*"><?php echo  esc_html__('All','shopaholic-wp'); ?></a></li>
	            <?php
		            $cats = get_categories('taxonomy=portfolio_category');
		            if(is_array($cats)){
		            	foreach($cats as $cat){
		            		echo '<li><a href="#" data-filter=".'. esc_attr($cat->slug) .'">'. $cat->name .'</a></li>';
		            	}
		            }
	            ?>
        	</ul>
        <?php } ?>


	    <div class="portfolio-works list-view">
	    	
	    	
				<?php 
				$i = 0;
				if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();
					
						global $post;
						/**
						  * Leave this portfolio item out if we didn't find a featured image.
						*/
						 $image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'shopaholic_portfolio_thumb_list');
						 if(!( $image_thumb[0] ))
						 	return false;
						 ?>
						

								<div class="item <?php echo shopaholic_get_the_terms('portfolio_category', ' ', 'slug'); ?>">

									<div class="col-sm-6 <?php echo (($i % 2) == 0)? "pull-left":"pull-right";?>" >
										<img src="<?php echo $image_thumb[0];?>" alt="<?php the_title();?>">
									</div>

									<div class="col-sm-6 <?php echo (($i % 2) == 0)? "pull-right":"pull-left";?>">
										<div class="item-texts">
											<?php the_title('<h3 class="item-title"><a href="'. get_permalink() .'">', '</a></h3>'); ?>
											<p class="description">
												<?php the_content();?>
											</p><!-- /.description -->
											<a href="<?php the_permalink();?>" class="btn"><?php echo esc_html__('View Details', 'shopaholic-wp');?></a><!-- /.btn -->
										</div><!-- /.item-texts -->
									</div>


								</div><!--/.item-->


					<?php 
					$i++;
				} } ?>

			
	        
    	</div><!--/.recent-works-->

        <?php if( 'yes' == $pagination ){ ?>
	        <div class="btn-container">
	            <a href="#" class="btn">Load more</a>
	        </div><!-- /.btn-container -->          
	    <?php } ?>
			</div>
		</div>
	</div>
</section>

<?php
	
	wp_enqueue_style( 'shopaholic-portfolio', SHOPAHOLIC_CSS . 'pages/portfolio.css', false, SHOPAHOLIC_VER );

	wp_reset_postdata();
	wp_reset_query();
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_portfolio_list', 'candor_shopaholic_portfolio_list_shortcode' );

/**
 * The VC Functions
 */
function candor_shopaholic_portfolio_list_shortcode_vc() {

	$portfolio_types = shopaholic_get_portfolio_layouts();
	$portfolio_column_types = shopaholic_get_portfolio_columng_type();

	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => esc_html__("Portfolio List", 'shopaholic-wp'),
			"base" => "shopaholic_portfolio_list",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Section Title and Description',
			"params" => array(
				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__("Show How Many Posts?", 'shopaholic-wp'),
					"param_name" 	=> "pppage",
					"value" 		=> '6'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Filters?", 'do'),
					"param_name" => "filters",
					"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					),
				),							
				array(
					"type" 			=> "dropdown",
					"heading" 		=> __("Show Pagination?", 'shopaholic-wp'),
					"param_name" 	=> "show_pagination",
					"value" 		=> array(
								'No' 	=> 'no',
								'Yes' 	=> 'yes',
								
					),
				),

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_shopaholic_portfolio_list_shortcode_vc');