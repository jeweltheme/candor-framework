<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_featured_products( $atts ) {
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
	$query_args_1 = array(
		'post_type' 		=> 'product',
		'posts_per_page' 	=> $pppage,
		'meta_key' 			=> '_featured',  
		'meta_value' 		=> 'yes', 
		'filter'	 		=> 'all'
	);	

	$query_args_2 = array(
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


	$product_query_1 = new WP_Query( $query_args_1 );
	$product_query_2 = new WP_Query( $query_args_2 );

	ob_start();
	
	

?>
	

  <section class="featured <?php echo ($style =="style1")? "style1": "style2";?>">
    <div class="section-padding">
      <div class="container">

        <!-- Nav tabs -->
        <div class="featured-navs">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#featured" aria-controls="featured" role="tab" data-toggle="tab"><?php echo esc_html__('Featured','shopaholic-wp');?></a></li>
            <li role="presentation"><a href="#new" aria-controls="new" role="tab" data-toggle="tab"><?php echo esc_html__('New','shopaholic-wp');?></a></li>
          </ul><!-- /.nav-tabs -->
        </div><!-- /.featured-navs -->

        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="featured">
            <div class="featured-slider owl-carousel owl-them">


			<?php if ( $product_query_1->have_posts() ) { while ( $product_query_1->have_posts() ) { $product_query_1->the_post();				
				
				global $post, $product;

				$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
				$price_html = $product->get_price_html();
				$average      = $product->get_average_rating();
				?>
              	
              	<div class="item">


	                <?php if($style == "style1"){ ?>

		                <div class="item-top">
		                	<div class="item-thumbnail">
		                		<img src="<?php echo esc_url_raw( $image_thumb['0']); ?>" alt="<?php the_title_attribute();?>">
		                		<?php if ( $product->is_on_sale() ) { ?>
		                			<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="ribbon sale">' . esc_html__( 'Sale', 'shopaholic-wp' ) . '</span>', $post, $product ); ?>
		                		<?php } ?>
		                	</div><!-- /.item-thumbnail -->

		                	<div class="item-inner">
		                		<div class="wish-list">
		                			<?php
		                			if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ){
		                				echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
		                			}
		                			?>
		                		</div>
		                		<div class="add-cart-details">
		                			<span>
		                				<?php woocommerce_template_loop_add_to_cart();?>
		                			</span>
		                		</div>
		                		<div class="quick_view_item">	                					                		
			                		<?php $nonce = wp_create_nonce("ya_quickviewproduct_nonce");
			                		$link = admin_url('admin-ajax.php?ajax=true&amp;action=shopaholic_quickviewproduct&amp;post_id='.$product->id.'&amp;nonce='.$nonce);
			                		$linkcontent ='<a href="'. $link .'" data-fancybox-type="ajax" class="fancybox fancybox.ajax" title="Quick View Product"><i class="fa fa-search"></i> <span>'.apply_filters( 'out_of_stock_add_to_cart_text', __( 'Quick View', 'yatheme' ) ).'</span></a>';
			                		echo $linkcontent; 
			                		?>
		                		</div>
		                	</div><!-- /.item-inner -->
		                </div><!-- /.item-top -->

		                <div class="item-bottom">
		                  <h3 class="item-title"><a href="<?php the_permalink(); ?>"  title="<?php the_title_attribute(); ?>"> <?php the_title(); ?> </a></h3><!-- /.item-title -->
		                  
		                  	<?php if ( $price_html = $product->get_price_html() ){?>
			                  <div class="item-price">		                    
			                    <span class="price"><?php echo $price_html; ?></span><!-- /.price -->
			                  </div><!-- /.item-price -->
			                <?php } ?>
		                </div><!-- /.item-bottom -->


	                <?php } elseif( $style =="style2" ) { ?>

		                <div class="item-top">
		                  <div class="item-thumbnail">
		                    <img src="<?php echo esc_url_raw( $image_thumb['0']); ?>" alt="<?php the_title_attribute();?>">
		                    <?php if ( $product->is_on_sale() ) { ?>
			                    <?php echo apply_filters( 'woocommerce_sale_flash', '<span class="ribbon sale">' . esc_html__( 'Sale', 'shopaholic-wp' ) . '</span>', $post, $product ); ?>
		                    <?php } ?>
		                  </div><!-- /.item-thumbnail -->
		                </div><!-- /.item-top -->

		                <div class="item-bottom">
		                	
		                	<div class="add-cart-details">
		                		<span>
		                			<?php woocommerce_template_loop_add_to_cart();?>
		                		</span>
		                	</div>	                		
		                	
		                	<div itemscope itemtype="http://schema.org/Product">
			                	<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
			                		<div  class="rating" >
				                		<div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'shopaholic-wp' ), $average ); ?>">
				                			<meta itemprop="ratingValue" content="<?php echo ( ( $average / 5 ) * 100 ); ?>" />
				                			<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%"></span>
				                		</div>		
				                	</div>
			                	</div>
			                </div>
		                	
		                	<h3 class="item-title"><a href="<?php the_permalink(); ?>"  title="<?php the_title_attribute(); ?>"> <?php the_title(); ?> </a></h3><!-- /.item-title -->

		                  	<?php if ( $price_html = $product->get_price_html() ){?>
			                  <div class="item-price">		                    
			                    <span class="price"><?php echo $price_html; ?></span><!-- /.price -->
			                  </div><!-- /.item-price -->
			                <?php } ?>

		                </div><!-- /.item-bottom -->

	            <?php } ?>

              </div><!-- /.item -->
            
            <?php } } wp_reset_postdata(); ?>


            </div>
          </div>

          <div role="tabpanel" class="tab-pane" id="new">
            <div class="featured-slider owl-carousel owl-theme">

            	<?php if ( $product_query_2->have_posts() ) { while ( $product_query_2->have_posts() ) { $product_query_2->the_post();
            						
					global $post, $product;
					//$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
					$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(266,340));

					$price_html = $product->get_price_html();
            		?>
	              	<div class="item">
		                <div class="item-top">
		                  <div class="item-thumbnail">
		                    <img src="<?php echo esc_url_raw( $image_thumb['0']); ?>" alt="<?php the_title();?>">
		                  </div><!-- /.item-thumbnail -->

		                  <div class="item-inner">
		                  	<div class="wish-list">
		                  		<?php
		                  		if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ){
		                  			echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
		                  		}
		                  		?>
		                  	</div>

		                  	<div class="add-cart-details">
		                  		<i class="fa fa-shopping-cart"></i>
		                  		<span>
		                  			<?php woocommerce_template_loop_add_to_cart();?>
		                  		</span>
		                  	</div>

		                  	<div class="quick_view_item">
								<?php $nonce = wp_create_nonce("ya_quickviewproduct_nonce");
									$link = admin_url('admin-ajax.php?ajax=true&amp;action=shopaholic_quickviewproduct&amp;post_id='.$product->id.'&amp;nonce='.$nonce);
									$linkcontent ='<a href="'. $link .'" data-fancybox-type="ajax" class="fancybox fancybox.ajax sm_quickview_handler" title="Quick View Product"><i class="fa fa-search"></i> <span>'.apply_filters( 'out_of_stock_add_to_cart_text', __( 'Quick View', 'yatheme' ) ).'</span></a>';
									echo $linkcontent; 
								?>
							</div>

		                  </div><!-- /.item-inner -->
		                </div><!-- /.item-top -->
		                <div class="item-bottom">
		                  <h3 class="item-title"><a href="<?php the_permalink(); ?>"  title="<?php the_title_attribute(); ?>"> <?php the_title(); ?> </a></h3><!-- /.item-title -->
		                  
	                  		<?php if ( $price_html = $product->get_price_html() ){?>
			                  <div class="item-price">		                    
			                    <span class="price"><?php echo $price_html; ?></span><!-- /.price -->
			                  </div><!-- /.item-price -->
			                <?php } ?>

		                </div><!-- /.item-bottom -->
		            </div><!-- /.item -->

		        <?php } } wp_reset_postdata(); ?>

            </div>
          </div>

        </div><!-- /.tab-content -->
      </div><!-- /.container -->
    </div><!-- /.section-padding -->
  </section><!-- /.featured -->



			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_featured_products', 'candor_framework_shopaholic_featured_products' );

/**
 * The VC Functions
 */
function candor_framework_shopaholic_featured_products_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Featured & New Products", 'shopaholic-wp'),
			"base" => "shopaholic_featured_products",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Featured Products with layout options.',
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
add_action( 'vc_before_init', 'candor_framework_shopaholic_featured_products_vc');