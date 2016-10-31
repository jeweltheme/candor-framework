<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_trending_products( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'trending_title'	=> 'Trending',
				'pppage' 			=> 8,
				'filter' 			=> 'all',
				'pricing_type' 		=> 'no'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' 		=> 'product',
		'posts_per_page' 	=> $pppage,
		'filter'	 		=> 'all'
	);	

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
?>
	

<div class="row">
  <section class="trending bg-gray">
    <div class="section-padding">
      <div class="container">
        <div class="section-top">
          <h2 class="section-title">
          	<?php echo strip_tags($trending_title);?><span></span>
          </h2><!-- /.section-title -->
        </div><!-- /.section-top -->

        <div class="row">
          <div class="trending-slider owl-carousel owl-theme">

          	<?php if ( $product_query->have_posts() ) { while ( $product_query->have_posts() ) { $product_query->the_post();				
          		global $post, $product;
          		$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
          		$price_html = $product->get_price_html();
          		$average      = $product->get_average_rating();
          		?>

		            <div class="item">
		              <div class="col-md-6">
		                <div class="item-thumbnail">
		                  <img src="<?php echo esc_url_raw( $image_thumb['0']); ?>" alt="<?php the_title_attribute();?>">
		                </div>

		                <div class="item-inner">
		                  	<button class="wish-list">
			                  	<?php
			                    	if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ){
			                    		echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
			                    	}
		                    	?>
	                    	</button>
		                
		                  <?php $nonce = wp_create_nonce("ya_quickviewproduct_nonce");
							$link = admin_url('admin-ajax.php?ajax=true&amp;action=shopaholic_quickviewproduct&amp;post_id='.$product->id.'&amp;nonce='.$nonce);
							$linkcontent ='<a href="'. $link .'" data-fancybox-type="ajax" class="fancybox fancybox.ajax" title="Quick View Product"><i class="fa fa-search"></i> <span>'.apply_filters( 'out_of_stock_add_to_cart_text', __( 'Quick View', 'yatheme' ) ).'</span></a>';
							echo $linkcontent; 
						?>

		                </div><!-- /.item-inner -->
		              </div>

		              <div class="col-md-6">
		                <div class="item-details">
		                  <h3 class="item-title">
		                  	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
		                  </h3><!-- /.item-title -->
		                  

							<div class="rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
								<div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'shopaholic-wp' ), $average ); ?>">
									<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%"></span>
								</div>		
							</div>
		                  
		                  	<?php if ( $price_html = $product->get_price_html() ){?>
			                  	<div class="item-price">		                    
			                  		<span class="price"><?php echo $price_html; ?></span><!-- /.price -->
			                  	</div><!-- /.item-price -->
		                  	<?php } ?>

		                  	<p class="description">
		                    	<?php echo wp_trim_words( get_the_content(), 8, ' '  ); ?>
		                  	</p><!-- /.description -->
		                  
		                  	<?php woocommerce_template_loop_add_to_cart();?>
		                </div>
		              </div>
		            </div>

		    	<?php } } wp_reset_postdata(); ?>

          	</div><!-- /.trending-slider -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </div><!-- /.section-padding -->
  </section><!-- /.trending -->
</div><!-- /.row -->


			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_trending_products', 'candor_framework_shopaholic_trending_products' );

/**
 * The VC Functions
 */
function candor_framework_shopaholic_trending_products_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Trending Products", 'shopaholic-wp'),
			"base" => "shopaholic_trending_products",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Trending Products with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'shopaholic-wp'),
					"param_name" => "trending_title",
					"value" => 'Trending'
				),				
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'shopaholic-wp'),
					"param_name" => "pppage",
					"value" => '16'
				),

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_trending_products_vc');