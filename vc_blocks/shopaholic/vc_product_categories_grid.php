<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_product_categories_grid_shortcode( $atts, $content = null ) {

	$atts = shortcode_atts( array(
		'number'     	=> null,
		'style'		 	=>'1',
		'gutter'		=>'1',
		'orderby'    	=> 'id',
		'order'      	=> 'ASC',
		'hide_empty' 	=> 0,
		'parent'     	=> '',
		'ids'        	=> ''
	), $atts );


	
	if ( isset( $atts['ids'] ) ) {
		$ids = explode( ',', $atts['ids'] );
		$ids = array_map( 'trim', $ids );
	} else {
		$ids = array();
	}
	$hide_empty = ( $atts['hide_empty'] == true || $atts['hide_empty'] == 1 ) ? 1 : 0;

	// get terms and workaround WP bug with parents/pad counts
	$args1 = array(
		'orderby'    => $atts['orderby'],
		'order'      => $atts['order'],
		'hide_empty' => $hide_empty,
		'include'    => $ids,
		'pad_counts' => true,
		'number'	 => 1,
		'child_of'   => $atts['parent']
	);

	$args2 = array(
		'orderby'    => $atts['orderby'],
		'order'      => $atts['order'],
		'hide_empty' => $hide_empty,
		'include'    => $ids,
		'pad_counts' => true,
		'number'	 => 2,
		'offset'     => '1',
		'child_of'   => $atts['parent']
	);

	$args6 = array(
		'include'    	 => $ids,
		'post_status'    => 'publish',
		'post_type'      => 'product',
		'number'	 	 => 3,
		'child_of'   	 => $atts['parent']
	);

	$args7 = array(
		'include'    	 => $ids,
		'post_status'    => 'publish',
		'post_type'      => 'product',
		'number'	 	 => 4,
		'child_of'   	 => $atts['parent']
	);


	$product_categories1 = get_terms( 'product_cat', $args1 );
	$product_categories2 = get_terms( 'product_cat', $args2 );
	$product_categories6 = get_terms( 'product_cat', $args6 );
	$product_categories7 = get_terms( 'product_cat', $args7 );
	
	if ( $atts['orderby'] == 'order' ) {
		$args['menu_order'] = 'ASC';
		$args['orderby'] 	= 'name';
	} else {
		$args['orderby']    = $atts['orderby'];
	}

	if ( '' !== $atts['parent'] ) {
		$product_categories1 = wp_list_filter( $product_categories, array( 'parent' => $atts['parent'] ) );
	}

	if ( $hide_empty ) {
		foreach ( $product_categories1 as $key => $category ) {
			if ( $category->count == 0 ) {
				unset( $product_categories1[ $key ] );
			}
		}
	}

	if ( $atts['number'] ) {
		$product_categories1 = array_slice( $product_categories1, 0, $atts['number'] );
	}
	ob_start();
	$do_not_duplicate = array();
?>



<?php if($atts['style'] == "1"){ ?>
	<section class="collection">
	    <div class="section-padding">
	      <div class="container">
	        <div class="row">
	          <?php 
	          $i = 1;	          
	          foreach ($product_categories1 as $category){
	          	global $post;
	          	$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
	          	if ( $thumbnail_id ) {
					//$image = wp_get_attachment_url( $thumbnail_id  );
	          		$image = wp_get_attachment_image_src( $thumbnail_id, "full" );	
	          	} else {
	          		$image = wc_placeholder_img_src();
	          	}

	          	$do_not_duplicate[] = $category->term_id;
	          ?>
			          <div class="col-sm-4 left-content">
			            <div class="item">
			              <div class="item-thumb">
			                <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
			                  <img src="<?php echo esc_url_raw($image[0])?>" alt="<?php the_title_attribute(); ?>">
			                </a>
			              </div><!-- /.item-thumb -->
			              <div class="item-details">
			                <h3 class="item-title"><?php echo $category->name; ?></h3><!-- /.item-title -->
			              </div><!-- /.item-details -->
			            </div><!-- /.item -->
			          </div>

	          <?php $i++; } // end foreach query ?>

	          <div class="col-sm-8 right-content">
		          <?php 
			          $do_not_duplicate = array();
			          foreach ($product_categories2 as $category){ 
			          	$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
			          	if ( $thumbnail_id ) {
							//$image = wp_get_attachment_url( $thumbnail_id  );
			          		$image = wp_get_attachment_image_src( $thumbnail_id, "full" );	
			          	} else {
			          		$image = wc_placeholder_img_src();
			          	}
			          	if (in_array($category->term_id, $do_not_duplicate)) continue;
			        ?>
			            <div class="item">
			              <div class="item-thumb">
			                <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
			                  <img src="<?php echo esc_url_raw($image[0])?>" alt="<?php the_title_attribute(); ?>">
			                </a>
			              </div><!-- /.item-thumb -->
			              <div class="item-details">
			                <h3 class="item-title"><?php echo $category->name; ?></h3><!-- /.item-title -->
			              </div><!-- /.item-details -->
			            </div><!-- /.item -->
					
					<?php $i++; } // end foreach query ?>
	          </div>

	        </div><!-- /.row -->
	      </div><!-- /.container -->
	    </div><!-- /.section-padding -->
	</section><!-- /.collection -->
<?php } ?>




<?php if($atts['style'] == "2"){ ?>

	<section class="other-banners-02 text-center">
		<div class="row">
			<div class="row">
	          
				<div class="col-md-4 col-sm-6 left-items">
					<?php 

					// get terms and workaround WP bug with parents/pad counts
			        $args3 = array(
			          	'orderby'    => $atts['orderby'],
			          	'order'      => $atts['order'],
			          	'hide_empty' => $hide_empty,
			          	'include'    => $ids,
			          	'pad_counts' => true,
			          	'number'	 => 2,
			          	'child_of'   => $atts['parent']
			          	);

			        $args4 = array(
			          	'orderby'    => $atts['orderby'],
			          	'order'      => $atts['order'],
			          	'hide_empty' => $hide_empty,
			          	'include'    => $ids,
			          	'pad_counts' => true,
			          	'number'	 => 1,
			          	'offset'     => '2',
			          	'child_of'   => $atts['parent']
			          	);

			        $args5 = array(
			          	'orderby'    => $atts['orderby'],
			          	'order'      => $atts['order'],
			          	'hide_empty' => $hide_empty,
			          	'include'    => $ids,
			          	'pad_counts' => true,
			          	'number'	 => 2,
			          	'offset'     => '3',
			          	'child_of'   => $atts['parent']
			          	);



		          $product_categories3 = get_terms( 'product_cat', $args3 );
		          $product_categories4 = get_terms( 'product_cat', $args4 );
		          $product_categories5 = get_terms( 'product_cat', $args5 );

		          $i = 1;	          
		          foreach ($product_categories3 as $category){
		          	global $post;
		          	$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
		          	if ( $thumbnail_id ) {
						//$image = wp_get_attachment_url( $thumbnail_id  );
		          		$image = wp_get_attachment_image_src( $thumbnail_id, "full" );	
		          	} else {
		          		$image = wc_placeholder_img_src();
		          	}

					$product_cat_short_description = get_woocommerce_term_meta( $category->term_id, 'product_cat_short_description', true );
					$product_cat_heading_title = get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_title', true );
					$product_cat_heading_sub_title = get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_sub_title', true );
					$product_cat_heading_button_text = get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_button_text', true );
					$product_cat_heading_button_link = get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_button_link', true );


		          	$do_not_duplicate[] = $category->term_id;
		          ?>
					<div class="item">
						<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
							<img src="<?php echo esc_url_raw($image[0])?>" alt="<?php the_title_attribute(); ?>">
							<div class="item-details">
								<h3 class="item-title">
									<span><?php echo $product_cat_heading_title;?></span> <?php echo $product_cat_heading_sub_title;?>
								</h3><!-- /.item-title -->
							</div><!-- /.item-details -->
						</a>
					</div><!-- /.item -->

					<?php $i++; } // end foreach query ?>
				</div>

				<?php 
				$do_not_duplicate = array();
				foreach ($product_categories4 as $category){ 
					$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
					if ( $thumbnail_id ) {
							//$image = wp_get_attachment_url( $thumbnail_id  );
						$image = wp_get_attachment_image_src( $thumbnail_id, "full" );	
					} else {
						$image = wc_placeholder_img_src();
					}

					$product_cat_short_description = get_woocommerce_term_meta( $category->term_id, 'product_cat_short_description', true );
					$product_cat_heading_title = get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_title', true );
					$product_cat_heading_sub_title = get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_sub_title', true );
					$product_cat_heading_button_text = get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_button_text', true );
					$product_cat_heading_button_link = get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_button_link', true );

					if (in_array($category->term_id, $do_not_duplicate)) continue;
				?>					
					<div class="col-md-4 col-sm-6 middle-item">
						<div class="item">
							<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
							<img src="<?php echo esc_url_raw($image[0])?>" alt="<?php the_title_attribute(); ?>">
								<div class="item-details">
									<h3 class="item-title">
										<span><?php echo $product_cat_heading_title;?></span> <?php echo $product_cat_heading_sub_title;?>
									</h3><!-- /.item-title -->
								</div><!-- /.item-details -->
							</a>
						</div><!-- /.item -->
					</div>
				<?php $i++; } // end foreach query ?>


				<div class="col-md-4 col-sm-6 right-items">
					<?php 
					$do_not_duplicate = array();
					foreach ($product_categories5 as $category){ 
						$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
						if ( $thumbnail_id ) {
							//$image = wp_get_attachment_url( $thumbnail_id  );
							$image = wp_get_attachment_image_src( $thumbnail_id, "full" );	
						} else {
							$image = wc_placeholder_img_src();
						}

					$product_cat_short_description = get_woocommerce_term_meta( $category->term_id, 'product_cat_short_description', true );
					$product_cat_heading_title = get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_title', true );
					$product_cat_heading_sub_title = get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_sub_title', true );
					$product_cat_heading_button_text = get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_button_text', true );
					$product_cat_heading_button_link = get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_button_link', true );

						if (in_array($category->term_id, $do_not_duplicate)) continue;
						?>	
							<div class="item">
								<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
									<img src="<?php echo esc_url_raw($image[0])?>" alt="<?php the_title_attribute(); ?>">
									<div class="item-details">
										<h3 class="item-title">
											<span><?php echo $product_cat_heading_title;?></span> <?php echo $product_cat_heading_sub_title;?>
										</h3><!-- /.item-title -->
									</div><!-- /.item-details -->
								</a>
							</div><!-- /.item -->
						
						<?php $i++; } // end foreach query ?>

				</div>


			</div><!-- /.row -->
		</div><!-- /.container -->
	</section><!-- /.other-banners -->

<?php } ?>



<?php if($atts['style'] == "3"){ ?>
	
  <section class="other-banners other-banners-02 text-center">
    <div class="section-padding">
      <div class="container">
        <div class="row">

          <div class="banner-items">
          	
          	<?php 	        
	          foreach ($product_categories6 as $category){
	          	global $post;
	          	$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
	          	$image = wp_get_attachment_image_src( $thumbnail_id, "full" );
	          ?>


	            <div class="col-sm-4">
	              <div class="item">
	                <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
	                  <img src="<?php echo esc_url_raw($image[0])?>" alt="<?php the_title_attribute(); ?>">
	                  <div class="item-details">
	                    <h3 class="item-title">
	                      <?php echo esc_html($category->name); ?>
	                    </h3><!-- /.item-title -->
	                  </div><!-- /.item-details -->
	                </a>
	              </div><!-- /.item -->
	            </div>

            <?php } ?>

          </div><!-- /.banner-items -->
          
        </div><!-- /.row -->
      </div><!-- /.container -->
    </div><!-- /.section-padding -->
  </section><!-- /.other-banners -->



<?php } ?>



<?php if($atts['style'] == "4"){ ?>



 <div class="projects-container">
    <ul>
    	<?php 	     
    	$i = 1;
    	foreach ($product_categories7 as $category){
    		global $post;
    		$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
    		$image = wp_get_attachment_image_src( $thumbnail_id, "full" );

    		$heading_id  			= get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_thumbnail_id', true  );
    		$heading_image = wp_get_attachment_image_src( $heading_id, "full" );

    		$product_cat_short_description = get_woocommerce_term_meta( $category->term_id, 'product_cat_short_description', true );
    		$product_cat_heading_title = get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_title', true );
    		$product_cat_heading_sub_title = get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_sub_title', true );
    		$product_cat_heading_button_text = get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_button_text', true );
    		$product_cat_heading_button_link = get_woocommerce_term_meta( $category->term_id, 'product_cat_heading_button_link', true );


    		?>

			<style type="text/css">

				.projects-container .cd-single-project:nth-of-type(<?php echo $i;?>):after {
					background-image: url("<?php echo esc_url_raw($image[0])?>") !important;
				}
				.projects-container .cd-single-project:nth-of-type(<?php echo $i;?>):before {
					background-image: url('<?php echo esc_url_raw($heading_image[0])?>') !important;
				}
			</style>

    		

		      <li class="cd-single-project">
		        <div class="cd-title">
		          <div class="content-details">
		            <h2 class="item-title"><?php echo esc_attr($category->name); ?></h2><!-- /.item-title -->
		            <div class="expand-content">

		              <h2 class="main-title"><?php echo esc_attr($product_cat_heading_title); ?></h2><!-- /.main-title -->
		              <h3 class="sub-title"><?php echo esc_attr($product_cat_heading_sub_title); ?></h3><!-- /.sub-title -->		              		                
		                <?php echo category_description( $category ); ?>		              
		              <a href="<?php echo esc_attr($product_cat_heading_button_link); ?>" class="btn"><?php echo esc_attr($product_cat_heading_button_text); ?></a>
		            </div><!-- /.expand-content -->
		          </div><!-- /.content-details -->
		        </div> <!-- .cd-title -->
		      </li>

		<?php $i++; } ?>

    </ul>
    <a href="#0" class="cd-close"><i class="ti-close"></i></a>
    <!-- <a href="#0" class="cd-scroll">Scroll</a> -->
  </div> <!-- .project-container -->



<?php

wp_enqueue_style( 'expand', SHOPAHOLIC_CSS . 'home/expand.css', SHOPAHOLIC_VER );
wp_enqueue_script( 'jquery.expand', SHOPAHOLIC_JS . 'jquery.expand.js', SHOPAHOLIC_VER );

} ?>



		
<?php	
	//}
	wp_reset_query();
	wp_reset_postdata();
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_product_categories_grid', 'candor_framework_shopaholic_product_categories_grid_shortcode' );




/**
 * The VC Functions
 */
function candor_framework_shopaholic_product_categories_grid_vc() {
	

	vc_map(
				array(
					"name" => __( "Product Categories Grid", 'shopaholic-wp'),
					"base" => "shopaholic_product_categories_grid",
					"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
					"icon" => 'shopaholic-vc-block',
					"class" => "dh-vc-element dh-vc-element-dh_woo",
					'description' => __( 'Display categories with grid layout.', 'shopaholic-wp'),
					"params" => array(
						array(
								'save_always'=>true,
								"type" => "product_category",
								"heading" => __( "Categories", 'shopaholic-wp'),
								"param_name" => "ids",
								'select_field' => 'id',
								"admin_label" => true ),
						array(
								'save_always'=>true,
								"type" => "dropdown",
								"class" => "",
								'std' => '1',
								"heading" => __( "Grid Style", 'shopaholic-wp'),
								"param_name" => "style",
								'admin_label' => true,
								"value" => array( 
										__( 'Style 1', 'shopaholic-wp') => '1', 
										__( 'Style 2', 'shopaholic-wp') => '2',
										__( 'Style 3', 'shopaholic-wp') => '3',
										__( 'Style 4', 'shopaholic-wp') => '4' 

									) 
								),
						// array(
						// 		'save_always'=>true,
						// 		"type" => "dropdown",
						// 		"class" => "",
						// 		'std' => '1',
						// 		"heading" => __( "Grid Gutter", 'shopaholic-wp'),
						// 		"param_name" => "gutter",
						// 		"value" => array( __( 'Yes', 'shopaholic-wp') => '1', __( 'No', 'shopaholic-wp') => '0' ) ),
						// array(
						// 		'save_always'=>true,
						// 		"type" => "textfield",
						// 		"heading" => __( "Number", 'shopaholic-wp'),
						// 		"param_name" => "number",
						// 		"admin_label" => true,
						// 		'description' => __(
						// 			'You can specify the number of category to show (Leave blank to display all categories).',
						// 			'shopaholic-wp') ),
						// array(
						// 		'save_always'=>false,
						// 		"type" => "dropdown",
						// 		"heading" => __( "Products Ordering", 'shopaholic-wp'),
						// 		"param_name" => "orderby",
						// 		'std' => 'date',
						// 		"value" => array(
						// 			__( 'Category Order', 'shopaholic-wp') => 'order',
						// 			__( 'Name', 'shopaholic-wp') => 'name',
						// 			__( 'Term ID', 'shopaholic-wp') => 'term_id',
						// 			__( 'Taxonomy Count', 'shopaholic-wp') => 'count',
						// 			__( 'ID', 'shopaholic-wp') => 'id', ) ),
						// array(
						// 		'save_always'=>false,
						// 		"type" => "dropdown",
						// 		"class" => "",
						// 		'std' => 'ASC',
						// 		"heading" => __( "Ascending or Descending", 'shopaholic-wp'),
						// 		"param_name" => "order",
						// 		"value" => array(
						// 			__( 'Descending', 'shopaholic-wp') => 'DESC',
						// 			__( 'Ascending', 'shopaholic-wp') => 'ASC',
						// 			 ) ),
						array(
								'save_always'=>true,
								"type" => "dropdown",
								"class" => "",
								'std' => '1',
								"heading" => __( "Hide Empty", 'shopaholic-wp'),
								"param_name" => "hide_empty",
								"value" => array( __( 'Yes', 'shopaholic-wp') => '1', __( 'No', 'shopaholic-wp') => '0' ) 
							) 
						) 
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_product_categories_grid_vc');