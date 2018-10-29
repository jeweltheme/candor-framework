<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_testimonial_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 				=> 'default',
				'testimonial_posts' => '5',
				'bg_image' 			=> get_template_directory_uri() . '/images/testimonial.png',
				'filter'	 		=> 'all'
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

	$testimonials = candor_get_custom_posts("testimonial", $testimonial_posts);
	$bg_image = wp_get_attachment_image_src( $bg_image, 'full' );
	ob_start();

	
?>
  	

<?php if($type=="left_bg"){ ?>
  <section class="testimonial testimonial-2 background-bg" data-image-src="<?php echo esc_url_raw( $bg_image[0] ); ?>">
    <div class="col-md-offset-6">
<?php } ?>

<?php if($type=="default"){ ?>
    <div class="row">
   		<div class="testimonials testimonial-1 bg-gray">
    		

<?php } ?>

      <div id="testimonial-slider" class="testimonial-slider bg-gray carousel slide">
        <ol class="carousel-indicators">

	        <?php for( $i=0; $i<count($testimonials);$i++){ ?>
	        	<li data-target="#testimonial-slider" data-slide-to="<?php echo esc_html__( $i );?>" class="<?php echo ($i==0)?"active":"";?>"></li>
	        <?php } ?>
        </ol>

        <div class="carousel-inner text-center">
        	<?php 
        	foreach ($testimonials as $key =>$post) {
        		setup_postdata($post);


        		$testimonial_client_name 		= get_post_meta( $post->ID, '_shopaholic_testimonial_client_name',true );
        		$testimonial_client_designation = get_post_meta( $post->ID, '_shopaholic_testimonial_client_designation',true );
        		$testimonial_client_company 	= get_post_meta( $post->ID, '_shopaholic_testimonial_client_company',true );
        		$testimonial_comments 			= get_post_meta( $post->ID, '_shopaholic_testimonial_comments',true );
        		$testimonial_client_url 		= get_post_meta( $post->ID, '_shopaholic_testimonial_client_url',true );

        		$testimonial_image 				= wp_get_attachment_url( get_post_thumbnail_id( $post->ID, array( 95, 95 )) );					
        		?>

		          <div class="item <?php echo ( ($key == 0) ? "active" : "" );?>">
		            <div class="client-avatar">
		            	<img class="img-circle" src="<?php echo $testimonial_image; ?>" alt="<?php the_title_attribute();?>">
		            </div><!-- /.client-avatar -->
		            <p class="description">
		              <?php echo esc_html__( $testimonial_comments ); ?>
		            </p><!-- /.description -->
		            <div class="client-details">
		              <span class="name"><?php echo esc_html__( $testimonial_client_name ); ?></span><!-- /.name -->
		              <span class="designation"><?php echo esc_html__( $testimonial_client_designation ); ?> <?php echo esc_html__('-', 'shopaholic-wp');?> <a href="<?php echo esc_url_raw( $testimonial_client_url );?>" target="_blank"><?php echo esc_html__( $testimonial_client_company );?></a></span><!-- /.designation -->
		            </div><!-- /.client-details -->
		          </div><!-- /.item -->

		    <?php } ?>

        </div><!-- /.carousel-inner -->
      </div><!-- /.testimonial-slider -->
    

	<?php if($type=="default"){ ?>	    	
	    	
	    	</div>
	    </div> <!-- .row -->
	<?php } ?>

	<?php if($type=="left_bg"){ ?>
	    </div> <!-- col-md-offset-6 -->
	  </section><!-- /.testimonial -->
	<?php } ?>



			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_testimonial', 'candor_framework_shopaholic_testimonial_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_shopaholic_testimonial_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Testimonial", 'shopaholic-wp'),
			"base" => "shopaholic_testimonial",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Testimonial posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'shopaholic-wp'),
					"param_name" => "testimonial_posts",
					"value" => '4'
				),
				array( 
					'type' => 'attach_image', 
					'heading' => __( 'Background', 'shopaholic-wp'), 
					'param_name' => 'bg_image',
					'value' => get_template_directory_uri() . '/images/testimonial.png',
					'dependency' => array( 
									'element' => "type", 
									'value' => array( 'left_bg')
							), 
					'description' => __( 'Select Testimonial Background from media library', 'shopaholic-wp') 
				), 

				array( 
						'param_name' => 'type', 
						'heading' => __( 'Testimonial Type', 'shopaholic-wp'), 
						'type' => 'dropdown', 
						'admin_label' => true, 
						'std' => 'default', 
						'value' => array( 
								__( 'Default', 'shopaholic-wp') 		=> 'default', 
								__( 'Left Background', 'shopaholic-wp') => 'left_bg' ) 
					), 

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_testimonial_shortcode_vc');