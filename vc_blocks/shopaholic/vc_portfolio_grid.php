<?php 

/**
 * The Shortcode
 */
function candor_shopaholic_portfolio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'portfolio_column' 	=> '2col',
				'portfolio_layout' 	=> 'grid',
				'pppage' 			=> '999',
				'pagination' 		=> 'yes',
				'filter' 			=> 'all',
				'filters' 			=> 'yes',
				'load_more' 		=> 'no',
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


	if( $portfolio_column =="2col" ){
		$class = 'col-md-6';
	} elseif( $portfolio_column =="3col" ){ 
		$class = 'col-md-4 col-sm-6';
	} else{
		$class = 'masonry-full-width';
	} 



	if( $portfolio_column =="2col" ){
		$portfolio_column_num = '2column';
	} 
	elseif( $portfolio_column =="2col-full-widght" ){ 
		$portfolio_column_num = '2column-02';
	} 
	elseif( $portfolio_column =="3col" ){ 
		$portfolio_column_num = '3column';
	} 	
	elseif( $portfolio_column =="3col-full-widght" ){ 
		$portfolio_column_num = '3column-02';
	} 
	elseif( $portfolio_column =="4col" ){ 
		$portfolio_column_num = '4column';
	} 	
	elseif( $portfolio_column =="4col-full-widght" ){ 
		$portfolio_column_num = '4column-02';
	} 



	if( $portfolio_column =="2col" ){
		$cols = 'col-sm-6';
	} 
	elseif( $portfolio_column =="2col-full-widght" ){ 
		$cols = 'col-sm-6';
	} 
	elseif( $portfolio_column =="3col" ){ 
		$cols = 'col-md-4';
	} 	
	elseif( $portfolio_column =="3col-full-widght" ){ 
		$cols = 'col-md-4';
	} 
	elseif( $portfolio_column =="4col" ){ 
		$cols = 'col-sm-3';
	} 	
	elseif( $portfolio_column =="4col-full-widght" ){ 
		$cols = 'col-sm-3';
	} 






	//Array Resize Full Thumbnail Image

	ob_start();

?>

<?php if( $portfolio_column =="2col" || $portfolio_column =="3col" || $portfolio_column =="4col"  ){ ?>		
		<div class="row">
			<div class="row">
<?php } ?>


<section class="portfolio text-center">

	<?php if( $portfolio_column =="2col-full-widght" || $portfolio_column =="3col-full-widght" || $portfolio_column =="4col-full-widght" ){ ?>
		<div class="row">
	<?php } ?>

		<?php if( 'yes' == $filters && !( is_tax() ) ) { ?>
            <ul class="filter">
    	        <li><a class="active" href="#" data-filter="*"><?php _e('All','shopaholic-wp'); ?></a></li>
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


	    <div class="portfolio-works <?php echo esc_html__( $portfolio_layout );?>-<?php echo esc_html__($portfolio_column_num);?>">
	    	
	    	
				<?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();

						global $post;
						//$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
						$height_width = candor_framework_meta('_shopaholic_portfolio_style');

						if( $portfolio_column =="2col" ){
							$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(565,460));
						} 
						elseif( $portfolio_column =="2col-full-widght" ){ 
							$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(1130,750));
						} 
						elseif( $portfolio_column =="3col" ){ 
							$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(360,290));
						} 	
						elseif( $portfolio_column =="3col-full-widght" ){ 
							if( $height_width == "item-w2" ){
								$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "full" );	
							} else{
								$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(620,500));	
							}
							
							//$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
						} 
						elseif( $portfolio_column =="4col" ){ 
							$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(450,210));
						} 	
						elseif( $portfolio_column =="4col-full-widght" ){ 
							$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(465,380));
						} 


			
						 /**
						  * Leave this portfolio item out if we didn't find a featured image.
						  */
						 if(!( $image_thumb[0] ))
						 	return false;
						 ?>
							 
								<div class="item <?php if($portfolio_layout !== "masonry"){ echo esc_html__( $cols ); }?> <?php echo shopaholic_get_the_terms('portfolio_category', ' ', 'slug'); ?> <?php if( $height_width =="item-w2" ){ echo "col-sm-8";}?> <?php echo esc_html__( $height_width );?>">

									<img height="<?php echo $image_thumb[2];?>" width="<?php echo $image_thumb[1];?>" src="<?php echo $image_thumb[0];?>" alt="<?php the_title();?>">

									<div class="item-details">
									 	<div class="item-texts">
									 		<?php the_title('<h3 class="item-title"><a href="'. get_permalink() .'">', '</a></h3>'); ?>
									 		<p class="category"><?php echo shopaholic_get_the_terms('portfolio_category', ', ', 'name'); ?> </p>
									 	</div><!-- /.item-texts -->
								 	</div><!-- /.item-details -->	    
								</div><!--/.item-->
							


					<?php 

				} } ?>

			
	        
    	</div><!--/.recent-works-->

        <?php if( 'yes' == $load_more ){ ?>
	        <div class="btn-container">
	            <a href="#" class="btn">Load more</a>
	        </div><!-- /.btn-container -->          
	    <?php } ?>

	    

	<?php if( $portfolio_column =="2col-full-widght" || $portfolio_column =="3col-full-widght" || $portfolio_column =="4col-full-widght" ){ ?>
		</div>
	<?php } ?>
	
</section>

	<?php if( $portfolio_column =="2col" || $portfolio_column =="3col" || $portfolio_column =="4col"  ){ ?>	
				</div>
			</div>
	<?php } ?>
	

<?php
	
	wp_enqueue_style( 'shopaholic-portfolio', SHOPAHOLIC_CSS . 'pages/portfolio.css', false, SHOPAHOLIC_VER );

	wp_reset_postdata();
	wp_reset_query();
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_portfolio', 'candor_shopaholic_portfolio_shortcode' );

/**
 * The VC Functions
 */
function candor_shopaholic_portfolio_shortcode_vc() {

	$portfolio_types = shopaholic_get_portfolio_layouts();
	$portfolio_column_types = shopaholic_get_portfolio_columng_type();

	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => esc_html__("Portfolio", 'shopaholic-wp'),
			"base" => "shopaholic_portfolio",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Masonry Blog Posts with layout options.',
			"params" => array(
				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__("Show How Many Posts?", 'shopaholic-wp'),
					"param_name" 	=> "pppage",
					"value" 		=> '6'
				),
				array(
					"type" 			=> "dropdown",
					"heading" 		=> __("Portfolio Layout", 'shopaholic-wp'),
					"param_name" 	=> "portfolio_layout",
					"value" 		=> $portfolio_types
				),					

				array(
					"type" 			=> "dropdown",
					"heading" 		=> __("Column Type", 'shopaholic-wp'),
					"param_name" 	=> "portfolio_column",
					"value" 		=> $portfolio_column_types
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
					"heading" 		=> __("Show Load More?", 'shopaholic-wp'),
					"param_name" 	=> "load_more",
					"value" 		=> array(
								'No' 	=> 'no',
								'Yes' 	=> 'yes',
								
					),
				),

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_shopaholic_portfolio_shortcode_vc');