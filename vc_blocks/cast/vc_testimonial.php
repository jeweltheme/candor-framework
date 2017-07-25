<?php 

/**
 * The Shortcode
 */
function cast_testimonial_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 				=> 'carousel',
				'pppage' 			=> '5',
				'title'				=> 'Why choose us?',
				'why_choose_desc'	=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
				'why_choose_icon'	=> 'fa fa-user',
				'pppage' 			=> '5',
				'filter'	 		=> 'all'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' 		=> 'testimonial',
		'posts_per_page' 	=> $pppage
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
	$testimonials = candor_get_custom_posts("testimonial", $pppage);
	$testimonial_services = vc_param_group_parse_atts( $atts['testimonial_services'] );	
?>
     <section class="choose">
        <div class="section-padding">
            <div class="container">
                <div class="items">
                    <div class="col-sm-6">
                        <div class="inner-bg">
                            <h2 class="section-title"><?php echo $title;?></h2><!-- /.section-title -->
                            <div class="padding"> 

                            	<?php foreach ($testimonial_services as $key => $value ) {?>
	                                <div class="item media">
	                                    <div class="item-icon media-left"><i class="<?php echo strip_tags( $value['why_choose_icon'] );?>"></i></div><!-- /.item-icon -->
	                                    <div class="item-details media-body">
	                                        <p class="description">
	                                            <?php echo strip_tags( $value['why_choose_desc'] );?>
	                                        </p><!-- /.description -->
	                                    </div><!-- /.item-details -->
	                                </div><!-- /.item -->
	                            <?php } ?>

                            </div><!-- /.padding -->
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="inner-bg">
                            <div class="padding">
                                <div id="testimonial-slider" class="testimonial-slider carousel slide">

                                    <ol class="carousel-indicators">
                                    	<?php for ($i=0; $i < count($testimonials); $i++) { ?>
                                    		<li data-target="#testimonial-slider" data-slide-to="<?php echo $i;?> " class="<?php echo ( ($i == 0) ? "active" : "" );?>"></li>
                                    	<?php } ?>
                                    </ol>

                                    <div class="carousel-inner">

                                    	<?php 
                                    	

                                    	foreach ($testimonials as $key =>$post) {
                                    		setup_postdata($post);


                                    		$testimonial_client_name 		= get_post_meta( $post->ID, '_cast_testimonial_client_name',true );
                                    		$testimonial_client_designation = get_post_meta( $post->ID, '_cast_testimonial_client_designation',true );
                                    		$testimonial_client_company 	= get_post_meta( $post->ID, '_cast_testimonial_client_company',true );
                                    		$testimonial_comments 			= get_post_meta( $post->ID, '_cast_testimonial_comments',true );
                                    		$testimonial_client_url 		= get_post_meta( $post->ID, '_cast_testimonial_client_url',true );

                                    		$testimonial_image 				= wp_get_attachment_url( get_post_thumbnail_id( $post->ID, array( 110, 110 )) );					
                                    		?>

		                                        <div class="item <?php echo ( ($key == 0) ? "active" : "" );?>">
		                                            <div class="author-avatar">
		                                                <img class="img-circle" src="<?php echo $testimonial_image; ?>" alt="Author Avatar">
		                                            </div><!-- /.author-avatar -->
		                                            <p class="description">
		                                                <?php echo esc_attr( $testimonial_comments ); ?>
		                                            </p><!-- /.description -->
		                                            <div class="author-details">
		                                                <h4 class="name"><?php echo esc_attr( $testimonial_client_name ); ?></h4><!-- /.name -->
		                                                <span class="designation"><?php echo esc_attr( $testimonial_client_designation ); ?></span><!-- /.designation -->
		                                            </div><!-- /.author-details -->
		                                        </div><!-- /.item -->

		                                    <?php } ?>

                                    </div><!-- /.carousel-inner -->
                                </div><!-- /#testimonial-slider -->
                            </div><!-- /.padding -->
                        </div>
                    </div>
                </div><!-- /.items -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.choose -->
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'cast_testimonial', 'cast_testimonial_shortcode' );


/**
 * The VC Functions
 */
function cast_testimonial_shortcode_vc() {
	
	vc_map( 
		array(
		    "icon" => 'cast-vc-block',
		    "name" => esc_html__("Testimonial", 'cast'),
		    "base" => "cast_testimonial",
		    "category" => esc_html__('CAST WP Theme', 'cast'),
		    'description' => 'Types of About Us Features and in Short Description',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Testimonial Posts?", 'elevation'),
					"param_name" => "pppage",
					"value" => '4'
				),

				array(
					"type" => "textfield",
					"heading" => __("Title", 'cast'),
					"param_name" => "title",
					'holder' => 'div',
					'value' => 'Why choose us?',
					),		

				// params group
	            array(
	                'type' => 'param_group',
	                'value' => '',
	                'param_name' => 'testimonial_services',
	                // Note params is mapped inside param-group:
	                'params' => array(

						array(
							'type'         => 'iconpicker',
							'heading'      => esc_html__( 'Icon', 'cast' ),
							'param_name'   => 'why_choose_icon',
							'value'        => 'fa fa-user',
							'settings'     => array(
									           'emptyIcon'    => false, // default true, display an "EMPTY" icon?
									           'iconsPerPage' => 100, // default 100, how many icons per/page to display
									           ),
							'description'  => esc_html__( 'Select icon from library.', 'cast' ),
						),
						array(
							"type" => "textfield",
							"heading" => __("Features Description", 'cast'),
							"param_name" => "why_choose_desc",
							'holder' => 'div',
							'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
						),

	                )
	            ),


			)
		) 
	);
	
}
add_action( 'vc_before_init', 'cast_testimonial_shortcode_vc');