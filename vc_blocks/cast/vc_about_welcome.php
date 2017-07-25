<?php 

/**
 * The Shortcode
 */
function cast_about_company_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' 			=> 'About our company',
				'title_right' 		=> 'WE ENSURE BEST SERVICES',
				'more_link' 		=> '#',
				'description' 		=> 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident <br><br>	                                    
	                                   Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut',								

				'style' 			=> 'style1',
				'type' 				=> 'service_icon',
				
				'service_link' 		=> '#',
				'service_icon' 		=> 'fa fa-user',
				
				'video_url' 		=> 'http://vimeo.com/167409747',
				'video_title' 		=> 'Company Video Presentation',
				'video_desc' 		=> 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
				'video_thumb' 		=> get_template_directory_uri() . '/images/icons/02.svg',
				'about_company_img' => get_template_directory_uri() . '/images/icons/02.svg',

			), $atts 
		) 
	);


	ob_start();

	$video_thumb = wp_get_attachment_image_src( $video_thumb, 'full' );
	$about_company_img = wp_get_attachment_image_src( $about_company_img, 'full' );
	
?>

<?php if( $style =="style1" ){ ?>

	    <section class="welcome welcome-2">
	        <div class="section-padding">
	            <div class="container">
	                <div class="items">
	                    <div class="col-sm-8">
	                        <div class="inner-bg">
	                            <h2 class="section-title">
	                            	<?php echo esc_attr( $title );?>
	                            </h2><!-- /.section-title -->
	                            <div class="padding"> 
	                                <p class="description">
	                                	<?php echo wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode($content)));?>
	                                </p><!-- /.description -->     
	                                <a href="<?php echo esc_url( $more_link );?>" class="btn read-more"><?php echo esc_html__('Read more','cast');?><i class="ti-arrow-right"></i></a>
	                            </div><!-- /.padding -->

	                            <img src="<?php echo $about_company_img[0];?>" alt="<?php the_title_attribute();?>">  
	                        </div>
	                    </div>

	                    <div class="col-sm-4">
	                        <div class="inner-bg">
	                        	<?php 
	                        	$company_services = vc_param_group_parse_atts( $atts['company_services'] );
	                        	foreach ($company_services as $key => $value ) {?>

		                            <div class="item">
		                                <div class="item-icon"><i class="<?php echo esc_attr( $value['service_icon'] );?>"></i></div><!-- /.item-icon -->
		                                <div class="item-details">
		                                    <h3 class="item-title">
		                                    	<?php echo strip_tags( $value['title'] );?>
		                                    </h3><!-- /.item-title -->
		                                    <p class="description">
		                                        <?php echo esc_attr( $value['service_desc'] );?>
		                                    </p><!-- /.description -->
		                                </div><!-- /.item-details -->
		                            </div><!-- /.item -->

		                        <?php } ?>

	                        </div><!-- /.inner-bg -->
	                    </div>
	                </div><!-- /.items -->
	            </div><!-- /.container -->
	        </div><!-- /.section-padding -->
	    </section><!-- /.welcome -->



<?php } elseif( $style =="style2" ){ ?>

    <section class="welcome">
        <div class="section-padding">
            <div class="container">
                <div class="items">
                    <div class="col-sm-7">
                        <div class="inner-bg">
                            <h2 class="section-title"><?php echo esc_attr( $title );?></h2><!-- /.section-title -->
                            <div class="padding">  

                            	<?php 
                            	$company_services = vc_param_group_parse_atts( $atts['company_services'] );
                            	foreach ($company_services as $key => $value ) {?>                          
	                                <div class="item media">
	                                    <div class="item-icon media-left"><i class="<?php echo esc_attr( $value['service_icon'] );?>"></i></div><!-- /.item-icon -->
	                                    <div class="item-details media-body">
	                                        <h3 class="item-title"><?php echo strip_tags( $value['title'] );?></h3><!-- /.item-title -->
	                                        <p class="description">
	                                            <?php echo esc_attr( $value['service_desc'] );?>
	                                        </p><!-- /.description -->
	                                    </div><!-- /.item-details -->
	                                </div><!-- /.item -->
	                            <?php } ?>

                            </div><!-- /.padding -->
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="inner-bg">
                            <img src="<?php echo $about_company_img[0];?>" alt="<?php the_title_attribute();?>">  
                            <h2 class="section-title"><?php echo $title_right;?></h2><!-- /.section-title -->
                            <div class="padding">
                                <p class="description">                                     
                                    <?php echo wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode($content)));?>
                                </p><!-- /.description -->
                                <a href="<?php echo esc_url( $more_link );?>" class="btn read-more"><?php echo esc_html__('Read more','cast');?><i class="ti-arrow-right"></i></a>
                            </div><!-- /.padding -->
                        </div>
                    </div>
                </div><!-- /.items -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.welcome -->


<?php } elseif( $style =="style3" ){ ?>

    <section class="welcome welcome-3">
        <div class="section-padding">
            <div class="container">
                <div class="items">
                    <div class="col-sm-7">
                        <div class="inner-bg">
                            <h2 class="section-title"><?php echo esc_attr( $title );?> </h2><!-- /.section-title -->
                            <div class="padding"> 
                                <p class="description">
                                    <?php echo wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode($content)));?>
                                </p><!-- /.description -->     
                                <a href="<?php echo esc_url( $more_link );?>" class="btn read-more"><?php echo esc_html__('Read more','cast');?><i class="ti-arrow-right"></i></a>
                            </div><!-- /.padding --> 
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <img src="<?php echo $about_company_img[0];?>" alt="<?php the_title_attribute();?>">  
                    </div>
                </div><!-- /.items -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.welcome -->


<?php } elseif( $style =="style4" ){ ?>

	    <section class="about-us about-us-4">
	        <div class="section-padding">
	            <div class="container">

					<?php 
					$company_services = vc_param_group_parse_atts( $atts['company_services'] );
					foreach ($company_services as $key => $value ) {?>	
		                <div class="col-sm-3">
		                    <div class="item">
		                        <a href="<?php echo esc_attr( $value['service_link'] );?>">
		                            <i class="<?php echo esc_attr( $value['service_icon'] );?>"></i>
		                            <h4 class="item-title"><?php echo strip_tags( $value['title'] );?></h4><!-- /.item-title -->
		                        </a>
		                    </div><!-- /.item -->
		                </div>
		            <?php } ?>

	            </div><!-- /.container -->
	        </div><!-- /.section-padding -->
	    </section><!-- /.about-us -->


<?php } elseif( $style =="style5" ){ ?>

    <section class="welcome welcome-5">
        <div class="section-padding">
            <div class="container">
                <div class="items">
                    <div class="col-sm-8">
                        <div class="inner-bg media">
                            <div class="image media-left">
                                <img src="<?php echo $about_company_img[0];?>" alt="<?php the_title_attribute();?>">  
                            </div>
                            <div class="padding media-body"> 
                                <h2 class="section-title"><?php echo esc_attr( $title );?></h2><!-- /.section-title -->
                                <p class="description">
                                	<?php echo wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode($content)));?>
                                </p><!-- /.description -->     
                            </div><!-- /.padding -->
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="inner-bg">

                        	<?php 
                        	$company_services = vc_param_group_parse_atts( $atts['company_services'] );
                        	foreach ($company_services as $key => $value ) {?>	
	                        	<div class="item">
	                        		<div class="item-icon"><i class="<?php echo esc_attr( $value['service_icon'] );?>"></i></div><!-- /.item-icon -->
	                        		<div class="item-details">
	                        			<h3 class="item-title"><?php echo strip_tags( $value['title'] );?></h3><!-- /.item-title -->
	                        			<p class="description">
	                        				<?php echo esc_attr( $value['service_desc'] );?>
	                        			</p><!-- /.description -->
	                        		</div><!-- /.item-details -->
	                        	</div><!-- /.item -->
                        	<?php } ?>
                            
                        </div><!-- /.inner-bg -->
                    </div>
                </div><!-- /.items -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.welcome -->

<?php } elseif( $style =="style6" ){ ?>

	
    <section class="about about-5">
        <div class="section-padding">
            <div class="container">
                <div class="items">
                    <div class="col-sm-4">
                        <div class="item">
                            <div class="inner-bg">
                                <div class="item-thumb">

                                    <img src="<?php echo $video_thumb[0];?>" alt="<?php the_title_attribute();?>"> 
                                    <a class="iframe" href="<?php echo esc_url( $video_url );?>"><i class="fa fa-play"></i></a>
                                </div><!-- /.item-thumb -->
                                <div class="item-details">
                                    <div class="padding">
                                        <h3 class="item-title"><?php echo $video_title;?></h3>
                                        <p class="description">
                                            <?php echo $video_desc;?>
                                        </p><!-- /.description -->
                                    </div><!-- /.padding -->
                                </div><!-- /.item-details -->
                            </div><!-- /.inner-bg -->
                        </div><!-- /.item -->
                    </div>

                    <div class="col-sm-8">
                        <div class="inner-bg">
                            <h2 class="section-title"><?php echo $title;?></h2><!-- /.section-title -->
                            <div class="padding">
                                <p class="description">
                                    <?php echo wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode($content)));?>
                                </p><!-- /.description -->
                                <img src="<?php echo $about_company_img[0];?>" alt="<?php the_title_attribute();?>"> 
                            </div>
                        </div>
                    </div>
                </div><!-- /.items -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.about-5 -->


<?php } ?>


<?php
  	$output = ob_get_contents();
  	ob_end_clean();

  	return $output;
}
add_shortcode( 'cast_about_company', 'cast_about_company_shortcode' );



/**
 * The VC Functions
 */
function cast_about_company_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'cast-vc-block',
			"name" => esc_html__("About Company", 'cast'),
			"base" => "cast_about_company",
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
						'Left Video, Right Content' => 'style6',
						),
					),	

				// Style 1
				array(
						"type" => "textfield",
						"heading" => __("Title", 'cast'),
						"param_name" => "title",
						'holder' => 'div',
						'value' => 'About our company',
						// 'dependency' => array( 
						// 		'element' 	=> "style", 
						// 		'value' 	=> array( 'style1', 'style2' )
						// 	), 
					),					

						
				array(
						"type" => "textarea_html",
						"heading" => __("Short Description", 'cast'),
						"param_name" => "content",
						'holder' => 'p',
						// 'dependency' => array( 
						// 		'element' 	=> "style", 
						// 		'value' 	=> array( 'style1', 'style2')
						// 	), 
						'value' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident <br><br>	                                    
                                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut',
					),	


				// Style 6
				array(
						"type" => "textfield",
						"heading" => __("Video URL", 'cast'),
						"param_name" => "video_url",
						'holder' => 'div',
						'value' => 'http://vimeo.com/167409747',
						'dependency' => array( 
								'element' 	=> "style", 
								'value' 	=> array( 'style6' )
							), 
					),	
				array( 
					'type' => 'attach_image', 
					'heading' => __( 'Video Thumb Image', 'cast'), 
					'param_name' => 'video_thumb',
					'value' => get_template_directory_uri() . '/images/icons/02.svg',
					'dependency' => array( 
						'element' 	=> "style", 
						'value' 	=> array( 'style6')
						), 
					'description' => __( 'Select Service Background from media library', 'cast') 
					), 
				array(
					"type" => "textfield",
					"heading" => __("Title", 'cast'),
					"param_name" => "video_title",
					'holder' => 'div',
					'value' => 'COMPANY VIDEO PRESENTATION',
					'dependency' => array( 
							'element' 	=> "style", 
							'value' 	=> array( 'style6' )
						), 
					),		
				array(
						"type" => "textarea",
						"heading" => __("Video Description", 'cast'),
						"param_name" => "video_desc",
						'holder' => 'p',
						'dependency' => array( 
								'element' 	=> "style", 
								'value' 	=> array(  'style6')
							), 
						'value' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
					),	
				
				// Style 2				
				array( 
						'type' => 'attach_image', 
						'heading' => __( 'Background', 'cast'), 
						'param_name' => 'about_company_img',
						'value' => get_template_directory_uri() . '/images/icons/02.svg',
						// 'dependency' => array( 
						// 	'element' 	=> "style", 
						// 	'value' 	=> array( 'style1' , 'style2', 'style3')
						// 	), 
						'description' => __( 'Select Service Background from media library', 'cast') 
					), 
				array(
						"type" => "textfield",
						"heading" => __("More Link", 'cast'),
						"param_name" => "more_link",
						'holder' => 'div',
						'value' => '#',
						'dependency' => array( 
								'element' 	=> "style", 
								'value' 	=> array( 'style1', 'style2', 'style3', 'style4', 'style5' )
							), 
					),	
				
				array(
					"type" => "textfield",
					"heading" => __("Company Title", 'cast'),
					"param_name" => "title_right",
					'holder' => 'div',
					'value' => 'OUR PROCESS',
						'dependency' => array( 
								'element' 	=> "style", 
								'value' 	=> array( 'style2' )
							), 
					),	



				// params group
	            array(
	                'type' => 'param_group',
	                'value' => '',
	                'heading'      => esc_html__( 'Company Services', 'cast' ),
	                'param_name' => 'company_services',
	                'dependency' => array( 
								'element' 	=> "style", 
								'value' 	=> array( 'style1', 'style2', 'style5')
							), 
	                // Note params is mapped inside param-group:
	                'params' => array(

						array(
							'type'         => 'iconpicker',
							'heading'      => esc_html__( 'Icon', 'cast' ),
							'param_name'   => 'service_icon',
							'value'        => 'fa fa-user',
							'settings'     => array(
									           'emptyIcon'    => false, // default true, display an "EMPTY" icon?
									           'iconsPerPage' => 100, // default 100, how many icons per/page to display
									           ),
							'description'  => esc_html__( 'Select icon from library.', 'cast' ),
						),
		

						array(
							"type" => "textfield",
							"heading" => __("Service Title", 'cast'),
							"param_name" => "title",
							'holder' => 'div',
							'value' => 'Qualified Experts',
						),				
						array(
							"type" => "textfield",
							"heading" => __("Service Description", 'cast'),
							"param_name" => "service_desc",
							'holder' => 'div',
							'value' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
						),
						// array(
						// 	"type" => "textfield",
						// 	"heading" => __("Service Link", 'cast'),
						// 	"param_name" => "service_link",
						// 	'holder' => 'div',
						// 	'value' => '#',
						// ),	
	                )
	            ),
				

			)
		) 
	);
}
add_action( 'vc_before_init', 'cast_about_company_shortcode_vc' );