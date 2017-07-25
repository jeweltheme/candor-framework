<?php 

/**
 * The Shortcode
 */
function cast_about_features_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'style' 			=> 'style1',
				'type' 				=> 'service_icon',
				'service_link' 		=> '#',
				'service_icon' 		=> 'fa fa-user',
				'bg_image' 			=> get_template_directory_uri() . '/images/icons/02.svg',
				'title' 			=> 'PROJECT PLANING',
				'service_desc' 		=> 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',				
			), $atts 
		) 
	);


	ob_start();
	$about_services = vc_param_group_parse_atts( $atts['about_services'] );
?>

<?php if( $style =="style1" ){ ?>

    <section class="about-us about-us-2">
        <div class="section-padding">
            <div class="container">
                <div class="items">
                	<?php foreach ($about_services as $key => $value ) {
                		$service_img = wp_get_attachment_image_src( $value['bg_image'], 'full' );
                		?>
	                    <div class="col-sm-4">
	                        <div class="item">
	                        	<?php if( $value['service_icon']  ){ ?>
	                        		<i class="<?php echo esc_attr( $value['service_icon'] );?>"></i>
	                        	<?php } elseif( $value['service_img']  ){ ?>
	                        		<img src="<?php echo esc_attr( $service_img[0] );?>" alt="<?php the_title_attribute();?>">
	                        	<?php } ?>
	                            <h4 class="item-title"><?php echo strip_tags( $value['title'] );?></h4><!-- /.item-title -->
	                            <p class="description">	                                
	                                <?php echo esc_attr( $value['service_desc'] );?>
	                            </p><!-- /.description -->
	                        </div><!-- /.item -->
	                    </div>
	                <?php } ?>

                </div><!-- /.items -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.about-us -->

<?php } elseif( $style =="style2" ){ ?>

	<section class="about-us">
		<div class="section-padding">
			<div class="container">
				<div class="items">
					<?php foreach ($about_services as $key => $value ) {
						$service_img = wp_get_attachment_image_src( $value['bg_image'], 'full' );
						?>
						<div class="col-sm-3">
							<div class="item">
								<a href="<?php echo esc_attr( $value['service_link'] );?>">
									
									<?php if( $value['service_icon']  ){ ?>
										<i class="<?php echo esc_attr( $value['service_icon'] );?>"></i>
									<?php } elseif( $value['service_img']  ){ ?>
										<img src="<?php echo esc_attr( $service_img[0] );?>" alt="<?php the_title_attribute();?>">
									<?php } ?>

									<h4 class="item-title"><?php echo strip_tags( $value['title'] );?></h4><!-- /.item-title -->
								</a>
							</div><!-- /.item -->
						</div>
					<?php } ?>
				</div><!-- /.items -->
			</div><!-- /.container -->
		</div><!-- /.section-padding -->
	</section><!-- /.about-us -->

<?php } elseif( $style =="style3" ){ ?>

	<section class="about-us about-us-3">
		<div class="section-padding">
			<div class="container">
				<div class="items">

					<?php foreach ($about_services as $key => $value ) {
						$service_img = wp_get_attachment_image_src( $value['bg_image'], 'full' );
						?>
						<div class="col-sm-6">
							<div class="item media">
								<div class="padding">
									<div class="item-icon media-left">
									
										<?php if( $value['service_icon']  ){ ?>
											<i class="<?php echo esc_attr( $value['service_icon'] );?>"></i>
										<?php } elseif( $value['service_img']  ){ ?>
											<img src="<?php echo esc_attr( $service_img[0] );?>" alt="<?php the_title_attribute();?>">
										<?php } ?>

									</div><!-- /.item-icon -->

									<div class="item-details media-body">
										<h4 class="item-title"><?php echo strip_tags( $value['title'] );?></h4><!-- /.item-title -->
										<p class="description">
											<?php echo esc_attr( $value['service_desc'] );?>
										</p><!-- /.description -->
									</div><!-- /.item-details -->
								</div><!-- /.padding -->
							</div><!-- /.item -->
						</div>
					<?php } ?>

				</div><!-- /.items -->
			</div><!-- /.container -->
		</div><!-- /.section-padding -->
	</section><!-- /.about-us -->

<?php } elseif( $style =="style4" ){ ?>

	    <section class="about-us about-us-4">
	        <div class="section-padding">
	            <div class="container">

					<?php foreach ($about_services as $key => $value ) {
						$service_img = wp_get_attachment_image_src( $value['bg_image'], 'full' );
						?>	
		                <div class="col-sm-3">
		                    <div class="item">
		                        <a href="<?php echo esc_attr( $value['service_link'] );?>">

									<?php if( $value['service_icon']  ){ ?>
										<i class="<?php echo esc_attr( $value['service_icon'] );?>"></i>
									<?php } elseif( $value['service_img']  ){ ?>
										<img src="<?php echo esc_attr( $service_img[0] );?>" alt="<?php the_title_attribute();?>">
									<?php } ?>

		                            <h4 class="item-title"><?php echo strip_tags( $value['title'] );?></h4><!-- /.item-title -->
		                        </a>
		                    </div><!-- /.item -->
		                </div>
		            <?php } ?>

	            </div><!-- /.container -->
	        </div><!-- /.section-padding -->
	    </section><!-- /.about-us -->

<?php } elseif( $style =="style5" ){ ?>

    <section class="features">
        <div class="section-padding">
            <div class="container">
                <div class="items">
                	
                	<?php foreach ($about_services as $key => $value ) {
                		$service_img = wp_get_attachment_image_src( $value['bg_image'], 'full' );
                		?>
	                    <div class="col-sm-4">
	                        <div class="item">
	                            <div class="item-thumb">
									<img src="<?php echo esc_attr( $service_img[0] );?>" alt="<?php the_title_attribute();?>">	                            	
	                            </div><!-- /.item-thumb -->
	                            <div class="item-details">
	                                <h3 class="item-title"><?php echo strip_tags( $value['title'] );?></h3><!-- /.item-title -->
	                                <p class="description">
	                                    <?php echo esc_attr( $value['service_desc'] );?>
	                                </p><!-- /.description -->
	                            </div><!-- /.item-details -->
	                        </div><!-- /.item -->
	                    </div>
	                <?php } ?>

                </div><!-- /.items -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.features -->


<?php } ?>


<?php
  	$output = ob_get_contents();
  	ob_end_clean();

  	return $output;
}
add_shortcode( 'cast_about_features', 'cast_about_features_shortcode' );



/**
 * The VC Functions
 */
function cast_about_features_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'cast-vc-block',
			"name" => esc_html__("Features", 'cast'),
			"base" => "cast_about_features",
			"category" => esc_html__('CAST WP Theme', 'cast'),
			'description' => 'Types of About Us Features and in Short Description',
			'wrapper_class'   => 'clearfix',
			"params" => array(

				array(
					"type" => "dropdown",
					"heading" => __("Style", 'cast'),
					"param_name" => "style",
					"value" => array(
						'Style 1' => 'style1',
						'Style 2' => 'style2',
						'Style 3' => 'style3',
						'Style 4' => 'style4',
						'Style 5' => 'style5',
						),
					),	

				// params group
	            array(
	                'type' => 'param_group',
	                'value' => '',
	                'param_name' => 'about_services',
	                // Note params is mapped inside param-group:
	                'params' => array(

	                	array( 
	                		'param_name' => 'type', 
	                		'heading' => __( 'Icon Type', 'cast'), 
	                		'type' => 'dropdown', 
	                		'admin_label' => true, 
	                		'std' => 'service_icon', 
	                		'value' => array( 
	                			__( 'Icons', 'cast') 		=> 'service_icon', 
	                			__( 'Image', 'cast') 		=> 'service_img' ) 
	                		), 

						array(
							'type'         => 'iconpicker',
							'heading'      => esc_html__( 'Icon', 'cast' ),
							'param_name'   => 'service_icon',
							'value'        => 'fa fa-user',
							'settings'     => array(
									           'emptyIcon'    => false, // default true, display an "EMPTY" icon?
									           'iconsPerPage' => 100, // default 100, how many icons per/page to display
									           ),
							'dependency' => array( 
								'element' 	=> "type", 
								'value' 	=> array( 'service_icon')
								), 
							'description'  => esc_html__( 'Select icon from library.', 'cast' ),
						),
			
						array( 
							'type' => 'attach_image', 
							'heading' => __( 'Background', 'cast'), 
							'param_name' => 'bg_image',
							'value' => get_template_directory_uri() . '/images/icons/02.svg',
							'dependency' => array( 
								'element' 	=> "type", 
								'value' 	=> array( 'service_img')
								), 
							'description' => __( 'Select Service Background from media library', 'cast') 
							), 

						array(
							"type" => "textfield",
							"heading" => __("Features Title", 'cast'),
							"param_name" => "title",
							'holder' => 'div',
							'value' => 'PROJECT PLANING',
						),				
						array(
							"type" => "textfield",
							"heading" => __("Features Description", 'cast'),
							"param_name" => "service_desc",
							'holder' => 'div',
							'value' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
						),
						array(
							"type" => "textfield",
							"heading" => __("Features Link", 'cast'),
							"param_name" => "service_link",
							'holder' => 'div',
							'value' => '#',
						),	
	                )
	            ),
				

			)
		) 
	);
}
add_action( 'vc_before_init', 'cast_about_features_shortcode_vc' );