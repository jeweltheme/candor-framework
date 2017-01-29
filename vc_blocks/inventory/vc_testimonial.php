<?php 

/**
 * The Shortcode
 */
function inventory_testimonial_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 					=> 'carousel',
				'testimonial_posts' 	=> '5',
				'title' 				=> 'Our Client’s Reviews',
				'subtitle' 				=> 'Appropriately Strategize Performance Based Intellectual Capital Before Premier Users',
				'style' 				=> 'style1',
				'testimonial_bg_image' 	=> get_template_directory_uri() . '/images/bg3.jpg',
				'filter'	 			=> 'all'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' 		=> 'testimonial',
		'posts_per_page' 	=> $testimonial_posts
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'testimonial_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'testimonial_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}

	ob_start();

	
	$testimonial_bg_image = wp_get_attachment_image_src( $testimonial_bg_image, 'full' );
?>


<?php if( $style =="style1" ){ ?>

	<div class="inv-bg-block inv-clients padding-lg-b110">
	    <img src="<?php echo $testimonial_bg_image[0];?>" alt="<?php the_title_attribute();?>" class="inv-img">
	        <div class="container padd-lr0">
	            <div class="row">
	                <div class="col-xs-12">
	                    <header class=" inv-block-header margin-lg-t140 margin-sm-t100 margin-lg-b105">
	                    	<h3><?php echo $title;?></h3>
	                    	<?php if ( ! empty( $subtitle ) ) { ?>
	                    		<span><?php echo $subtitle; ?></span>
	                    	<?php } ?>
	                    </header>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-xs-12">
	                <div class="inv-clients-slider">
	                    <div class="swiper-container inv-clients-slide" data-autoplay="5000" data-loop="1" data-speed="1000" data-slides-per-view="responsive" data-add-slides="1" data-xs-slides="1" data-sm-slides="1" data-md-slides="1" data-lg-slides="1">
	                        <div class="swiper-wrapper">


	                        	<?php 
	                        	global $post;
	                        	$testimonials = candor_get_custom_posts("testimonial", $testimonial_posts);

	                        	foreach ($testimonials as $key =>$post) {
	                        		setup_postdata($post);


	                        		$testimonial_client_name 		= get_post_meta( $post->ID, '_inventory_testimonial_client_name',true );
	                        		$testimonial_client_designation = get_post_meta( $post->ID, '_inventory_testimonial_client_designation',true );
	                        		$testimonial_client_company 	= get_post_meta( $post->ID, '_inventory_testimonial_client_company',true );
	                        		$testimonial_comments 			= get_post_meta( $post->ID, '_inventory_testimonial_comments',true );
	                        		$testimonial_client_url 		= get_post_meta( $post->ID, '_inventory_testimonial_client_url',true );

	                        		$testimonial_image 				= wp_get_attachment_url( get_post_thumbnail_id( $post->ID, array( 110, 110 )) );					
	                        		?>

			                            <div class="swiper-slide">
			                                <div class="inv-clients-item bg11">
			                                    <div class="inv-clients-img-wrap">
			                                        <img src="<?php echo $testimonial_image; ?>" alt="<?php the_title_attribute();?>">
			                                    </div>
			                                    <div class="inv-clients-info">
			                                        <p><?php echo esc_attr( $testimonial_comments ); ?></p>
			                                    </div>
			                                    <div class="inv-clients-user">
			                                        <h6><?php echo esc_attr( $testimonial_client_name ); ?></h6>
			                                    </div>
			                                </div>
			                            </div>


			                    <?php } ?>

	                        </div>
	                        <div class="pagination"></div>
	                    </div>
	                        <div class="swiper-outer-left"></div>
	                        <div class="swiper-outer-right"></div>
	                </div>
	                </div>
	            </div>
	        </div>
	</div>

<?php } elseif( $style =="style2" ){ ?>


		<div class="inv-works">
		    <div class="bg7">
		        <div class="container padd-lr0">
		            <div class="row">
		                <div class="col-xs-12">
		                    <div class="row">
		                        <div class="col-xs-12">
		                            <header class=" inv-block-header margin-lg-b360 margin-lg-t140 margin-sm-b100 margin-sm-t100 ">
		                                <h3><?php echo $title;?></h3>
				                    	<?php if ( ! empty( $subtitle ) ) { ?>
				                    		<span><?php echo $subtitle; ?></span>
				                    	<?php } ?>
		                            </header>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		    <div class="container padd-lr0">
		        <div class="row">
		            <div class="col-xs-12">
		                <div class="inv-works-body inv-works-body2 inv-works-slide">
		                    <div class="swiper-container " data-autoplay="5000" data-loop="1" data-speed="1000" data-slides-per-view="responsive" data-add-slides="3" data-xs-slides="1" data-sm-slides="1" data-md-slides="2" data-lg-slides="3">
		                        <div class="swiper-wrapper">

		                        	<?php 
		                        	global $post;
		                        	$testimonials = candor_get_custom_posts("testimonial", $testimonial_posts);

		                        	foreach ($testimonials as $key =>$post) {
		                        		setup_postdata($post);


		                        		$testimonial_client_name 		= get_post_meta( $post->ID, '_inventory_testimonial_client_name',true );
		                        		$testimonial_client_designation = get_post_meta( $post->ID, '_inventory_testimonial_client_designation',true );
		                        		$testimonial_client_company 	= get_post_meta( $post->ID, '_inventory_testimonial_client_company',true );
		                        		$testimonial_comments 			= get_post_meta( $post->ID, '_inventory_testimonial_comments',true );
		                        		$testimonial_client_url 		= get_post_meta( $post->ID, '_inventory_testimonial_client_url',true );

		                        		$testimonial_image 				= wp_get_attachment_url( get_post_thumbnail_id( $post->ID, array( 110, 110 )) );					
		                        		?>


				                            <div class="swiper-slide">
				                                <div class="inv-works-item">
				                                    <div class="inv-works-img-wrap">
				                                        <img src="<?php echo $testimonial_image; ?>" alt="<?php the_title_attribute();?>">
				                                    </div>
				                                    <h5><?php echo esc_attr( $testimonial_client_name ); ?></h5>
				                                    <p><?php echo esc_attr( $testimonial_comments ); ?></p>
				                                </div>
				                                <div class="inv-works-footer"></div>
				                            </div>

				                    <?php } ?>

		                        </div>
		                        <div class="pagination"></div>
		                    </div>
		                </div>
		            </div>

		        </div>
		    </div>
</div>


<?php } elseif( $style =="style3" ){ ?>
	<div class="inv-bg-block3 inv-bg-block inv-index5-article ">
		<img src="<?php echo $testimonial_bg_image[0];?>" alt="<?php the_title_attribute();?>" class="inv-img">
		<div class="container padd-only-xs">
			<div class="row margin-lg-t300 margin-lg-b300 margin-sm-t50 margin-sm-b100">
				<div class="col-xs-12">
					<?php 
					global $post;
					$testimonials = candor_get_custom_posts("testimonial", '1' );

					foreach ($testimonials as $key =>$post) {
						setup_postdata($post);


						$testimonial_client_name 		= get_post_meta( $post->ID, '_inventory_testimonial_client_name',true );
						$testimonial_client_designation = get_post_meta( $post->ID, '_inventory_testimonial_client_designation',true );
						$testimonial_client_company 	= get_post_meta( $post->ID, '_inventory_testimonial_client_company',true );
						$testimonial_comments 			= get_post_meta( $post->ID, '_inventory_testimonial_comments',true );
						$testimonial_client_url 		= get_post_meta( $post->ID, '_inventory_testimonial_client_url',true );

						$testimonial_image 				= wp_get_attachment_url( get_post_thumbnail_id( $post->ID, array( 110, 110 )) );					
						?>
							<div class="inv-index5-article-content">
								<q><?php echo esc_attr( $testimonial_comments ); ?></q>
								<cite><?php echo esc_attr( $testimonial_client_name ); ?></cite>
							</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

<?php } ?>
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'inventory_testimonial', 'inventory_testimonial_shortcode' );


/**
 * The VC Functions
 */
function inventory_testimonial_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'inventory-vc-block',
			"name" => __("Testimonial", 'inventory'),
			"base" => "inventory_testimonial",
			"category" => esc_html__('Inventory WP Theme', 'inventory'),
			'description' => 'Show Testimonial posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'inventory'),
					"param_name" => "title",
					"value" => 'Our Client’s Reviews'
					),				

				array(
					"type" => "textfield",
					"heading" => __("Sub Title", 'inventory'),
					"param_name" => "subtitle",
					"value" => 'Appropriately Strategize Performance Based Intellectual Capital Before Premier Users'
					),		
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'inventory'),
					"param_name" => "testimonial_posts",
					"value" => '3'
				),
				array( 
					'type' => 'attach_image', 
					'heading' => __( 'Background Image', 'inventory'), 
					'param_name' => 'testimonial_bg_image',
					'value' => get_template_directory_uri() . '/images/bg3.jpg',
					'dependency' => array( 
						'element' => "style", 
						'value' => array( 'style1', 'style3')
						), 
					'description' => __( 'Select Testimonial Background from media library', 'inventory') 
					), 

				array(
					"type" => "dropdown",
					"heading" => __("Testimonial Style", 'inventory'),
					"param_name" => "style",
					"value" => array(
						'Style 1' => 'style1',
						'Style 2' => 'style2',
						'Style 3' => 'style3',
						),
					),	


			)
		) 
	);
	
}
add_action( 'vc_before_init', 'inventory_testimonial_shortcode_vc');