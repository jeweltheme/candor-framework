<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_featured_category_products( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' 		=> 8,
				'filter' 		=> 'all',
				'pricing_type' 	=> 'no',
				'style'			=> 'style1'
			), $atts 
		) 
	);

	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' 		=> 'product',
		'posts_per_page' 	=> $pppage,
		'meta_key' 			=> '_featured',  
		'meta_value' 		=> 'yes', 
		'filter'	 		=> 'all'
	);	


$meta_query = array( 
	'post_type'  => 'product', 
    'order'      => 'ASC', //ASC
    'orderby'    => 'meta_value', //meta_value
    'meta_query' => array(
    	'relation' => 'OR',
    	array(
	    		'key'   => '_featured',
	    		'value' => 'yes'
    		),    	
    	array(
	        	'key' => '_sale_price',
	        	'value' => 0,
	        	'compare' => '>',
	        	'type' => 'numeric'
    		),
    	array(
	    		'key'   => '_is_hot_item',
	    		'value' => 'yes'
    		)
    	)

    ); 


	// $meta_query = array(
	// 	'post_type' 		=> 'product',
	// 	'posts_per_page' 	=> $pppage,
	// 	'relation' => 'OR',
	// 	                array( // Simple products type
	// 	                	'key' => '_sale_price',
	// 	                	'value' => 0,
	// 	                	'compare' => '>',
	// 	                	'type' => 'numeric'
	// 	                	),
	// 	                array( // Variable products type
	// 	                	'key' => '_min_variation_sale_price',
	// 	                	'value' => 0,
	// 	                	'compare' => '>',
	// 	                	'type' => 'numeric'
	// 	                	)
	// 	                ); 
	
	//$product_sale_query = new WP_Query( $meta_query );
	

	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'product_cat', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}


	$product_query = new WP_Query( $query_args );

	ob_start();
	
	$featured_products = array('hot','new','sale');	

?>
	
  <section class="featured featured-02 text-center">
    <div class="section-padding">
      <div class="container">
        <div class="row">
          <div class="section-top">
            <h2 class="section-title">
            	<?php echo esc_html__('Featured','shopaholic-wp');?><span></span>
            </h2>
          </div><!-- /.section-top -->

          <ul class="filter">
            <li><a class="active" href="#" data-filter="*"><?php echo  esc_html__('All','shopaholic-wp'); ?></a></li>
            <li><a href="#" data-filter=".<?php echo esc_attr($featured_products[0]);?>"><?php echo  esc_html__('Hot','shopaholic-wp'); ?></a></li>
            <li><a href="#" data-filter=".<?php echo esc_attr($featured_products[1]);?>"><?php echo  esc_html__('New','shopaholic-wp'); ?></a></li>
            <li><a href="#" data-filter=".<?php echo esc_attr($featured_products[2]);?>"><?php echo  esc_html__('Sale','shopaholic-wp'); ?></a></li>
          </ul>

          <div class="featured-sorting">


			<?php if ( $product_query->have_posts() ) { while ( $product_query->have_posts() ) { $product_query->the_post();				
				
				global $post, $product;

				$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
				$price_html = $product->get_price_html();		

				$is_hot = get_post_meta( $product->id, '_is_hot_item', true );
				$sale_price = get_post_meta( $product->id, '_sale_price', true );
				
			?>

		            <div class="item col-md-3 col-sm-6 <?php echo esc_attr($featured_products[1]);?> <?php echo ($is_hot=="yes")?"$featured_products[0]":"";?> <?php echo ($product->is_on_sale())?"$featured_products[2]":""; ?>">
		              <div class="item-top">
		                <div class="item-thumbnail">
		                  <a href="<?php echo esc_url_raw( $image_thumb['0']); ?>" class="fancybox">
		                    <img src="<?php echo esc_url_raw( $image_thumb['0']); ?>" alt="<?php the_title_attribute();?>">
		                  </a>
		                </div><!-- /.item-thumbnail -->
		              </div><!-- /.item-top -->
		              <div class="item-bottom">
		                <h3 class="item-title"><a href="<?php the_permalink(); ?>"  title="<?php the_title_attribute(); ?>"> <?php the_title(); ?> </a></h3><!-- /.item-title -->

		                <?php if ( $price_html = $product->get_price_html() ){?>
			                <div class="item-price">		                    
			                	<span class="price"><?php echo $price_html; ?></span><!-- /.price -->
			                </div><!-- /.item-price -->
		                <?php } ?>

		                <button class="btn">
		                	<?php woocommerce_template_loop_add_to_cart();?>
		                </button>

		              </div><!-- /.item-bottom -->
		            </div><!-- /.item -->


            <?php } } wp_reset_postdata(); ?>


            



          </div><!-- /.featured-sorting -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </div><!-- /.section-padding -->
  </section><!-- /.featured -->


			
<?php	
	
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_featured_category', 'candor_framework_shopaholic_featured_category_products' );

/**
 * The VC Functions
 */
function candor_framework_shopaholic_featured_category_products_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Featured Category", 'shopaholic-wp'),
			"base" => "shopaholic_featured_category",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Featured Category Products with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'shopaholic-wp'),
					"param_name" => "pppage",
					"value" => '16'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Style", 'shopaholic-wp'),
					"param_name" => "style",
					"value" => array(
						'Style 1' => 'style1',
						'Style 2' => 'style2'
						),
				),				

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_featured_category_products_vc');