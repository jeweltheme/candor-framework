<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_category_product_products( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'product_category'	=> '',
				'pppage' 			=> 3,
				'filter' 			=> 'all',
			), $atts 
		) 
	);
	
	$args = array(
			'post_type'             => 'product',
			'post_status'           => 'publish',
			'ignore_sticky_posts'   => 1,
			'hide_empty' => 0,
			'posts_per_page'        => $pppage,
			'product_cat'        	=> $product_category,
		);
	$product_query = new WP_Query($args);
	ob_start();
?>

	<div class="categories column">
		<div class="section-padding">


			<h3 class="title"><?php echo esc_attr( $product_category );?><span></span></h3><!-- /.title -->


          	<?php if ( $product_query->have_posts() ) { while ( $product_query->have_posts() ) { $product_query->the_post();				
          		global $post, $product;
          		$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
          		$price_html = $product->get_price_html();
          		$average      = $product->get_average_rating();
          	?>

            <div class="item">              
              <div class="item-details media">
                <div class="item-thumbnail media-left">
                  <img src="<?php echo $image_thumb[0];?>" alt="<?php the_title();?>">
                </div><!-- /.item-thumbnail -->
                <div class="item-content media-body">
                  <h4 class="item-title"><a href="<?php the_permalink();?>"><?php echo the_title(); ?></a></h4><!-- /.item-title -->

	              	<div itemscope itemtype="http://schema.org/Product">
	              	    <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		                  	<div class="rating">
			                  	<div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'shopaholic-wp' ), $average ); ?>">
			                  		<meta itemprop="ratingValue" content="<?php echo ( ( $average / 5 ) * 100 ); ?>" />
			                  		<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%"></span>
			                  	</div>		
		                  	</div>
		                 </div>
		            </div>

              	<?php if ( $price_html = $product->get_price_html() ){?>
                  	<div class="item-price">		                    
                  		<span class="price"><?php echo $price_html; ?></span><!-- /.price -->
                  	</div><!-- /.item-price -->
              	<?php } ?>
                  
                </div><!-- /.item-content -->
              </div><!-- /.item-details -->
            </div><!-- /.item -->
		   

		    	<?php } }  ?>

		</div>
	</div>

<?php	
	wp_reset_query();
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_category_product', 'candor_framework_shopaholic_category_product_products' );

/**
 * The VC Functions
 */
function candor_framework_shopaholic_category_product_products_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => esc_html__("Category Products", 'shopaholic-wp'),
			"base" => "shopaholic_category_product",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Category Products with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'shopaholic-wp'),
					"param_name" => "pppage",
					"value" => '3'
				),
				array(
					'type' => 'text',
					'heading' => esc_html__( 'Product Category', 'shopaholic-wp' ),
					'param_name' => 'product_category',
					'value'		  => 'Design',
					'description' => esc_html__( 'List of product categories', 'shopaholic-wp' ),
					),

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_category_product_products_vc');