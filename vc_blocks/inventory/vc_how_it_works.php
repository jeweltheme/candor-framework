<?php 

/**
 * The Shortcode
 */
function candor_framework_inventory_how_it_works_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'title'           => 'How it Works',
				'subtitle'        => 'Appropriately Strategize Performance Based Intellectual Capital Before Premier Users',
				'style' 		  => 'style1',
				'works_bg_image' => get_template_directory_uri() . '/images/bg9.jpg',


			), $atts 
		) 
	);

	ob_start();

	$how_it_works = vc_param_group_parse_atts( $atts['how_it_works'] );
	$works_bg_image = wp_get_attachment_image_src( $works_bg_image, 'full' );
?>
<?php if( $style =="style1" ){ ?>

	<div class="inv-works">
	    <div class="bg7">
	        <div class="container padd-lr0">
	            <div class="row">
	                <div class="col-xs-12">
	                    <div class="row">
	                        <div class="col-xs-12">
	                            <header class=" inv-block-header margin-lg-b360 margin-lg-t135 margin-sm-b100 margin-sm-t100 ">
	                                <h3><?php echo $title;?></h3>
	                                <span><?php echo $subtitle;?></span>
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
	                <div class="inv-works-body margin-lg-b225 margin-sm-b30">

						<?php 
						$i =1;
						foreach ($how_it_works as $key => $value ) {
							$bg_image = wp_get_attachment_image_src( $value['works_image'], 'full' );
							?>
		                    <div class="inv-works-item">
		                        <span><?php echo $i;?></span>
		                        <img src="<?php echo $bg_image[0];?>" alt="<?php the_title_attribute();?>">
		                        <h5><?php echo esc_attr( $value['works_title'] );?></h5>
		                        <p><?php echo esc_attr( $value['works_subtitle'] );?></p>
		                    </div>
		                <?php $i++; } ?>

	                </div>
	            </div>
	        </div>
	    </div>
	</div>
<?php } elseif( $style =="style2" ){ ?>

	<div class="inv-works inv-works2 bg7">
	    <div class="container padd-only-xs">
	            <div class="row">
	                <div class="col-xs-12">
	                    <div class="row">
	                        <div class="col-xs-12">
	                            <header class=" inv-block-header margin-lg-b50 margin-lg-t140 margin-sm-b50 margin-sm-t100 ">
	                                <h3><?php echo $title;?></h3>
	                                <span><?php echo $subtitle;?></span>
	                            </header>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        <div class="row">

			<?php 
				$i =1;
				foreach ($how_it_works as $key => $value ) {
					$bg_image = wp_get_attachment_image_src( $value['works_image'], 'full' );
					?>
                    <div class="col-md-4 ">
                    	<div class="inv-works-body inv-works-arrow margin-lg-t50 margin-lg-b155 margin-sm-b30">
                    		<div class="inv-works-item">
                    			<span><?php echo $i;?></span>
                    			<img src="<?php echo $bg_image[0];?>" alt="<?php the_title_attribute();?>">
		                        <h5><?php echo esc_attr( $value['works_title'] );?></h5>
		                        <p><?php echo esc_attr( $value['works_subtitle'] );?></p>
                    		</div>
                    	</div>
                    </div>
                <?php $i++; } ?>



	        </div>
	    </div>
	</div>

<?php } elseif( $style =="style3" ){ ?>



	<div class="inv-works inv-bg-block inv-works3 bg7">
	    <img src="<?php echo $works_bg_image[0];?>" alt="<?php the_title_attribute();?>" class="inv-img">
	    <div class="container ">
	        <div class="row">
	            <div class="col-xs-12">
	                <header class=" inv-block-header margin-lg-b15 margin-lg-t140  margin-sm-t100 ">
	                    <h3><?php echo $title;?></h3>
	                    <span><?php echo $subtitle;?></span>
	                </header>
	            </div>
	        </div>
	        <div class="row">
	        	<?php 
	        	$i =1;
	        	foreach ($how_it_works as $key => $value ) {
	        		$bg_image = wp_get_attachment_image_src( $value['works_image'], 'full' );
	        		?>
			            <div class="col-md-4 ">
			                <div class="inv-works-body inv-works-arrow2 margin-lg-t50 margin-lg-b70 margin-sm-b30">
			                    <div class="inv-works-item">
	                    			<span><?php echo $i;?></span>
	                    			<img src="<?php echo $bg_image[0];?>" alt="<?php the_title_attribute();?>">
			                        <h5><?php echo esc_attr( $value['works_title'] );?></h5>
			                        <p><?php echo esc_attr( $value['works_subtitle'] );?></p>
			                    </div>
			                </div>
			            </div>

			    <?php $i++; } ?>


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
add_shortcode( 'inventory_how_it_works', 'candor_framework_inventory_how_it_works_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_inventory_how_it_works_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'inventory-vc-block',
			"name" => __("How It Works", 'inventory'),
			"base" => "inventory_how_it_works",
			"category" => esc_html__('Inventory WP Theme', 'inventory'),
			'description' => 'Show Most Popular Listings Places',
			"params" => array(

				array(
					"type" => "textfield",
					"heading" => __("Title", 'inventory'),
					"param_name" => "title",
					"value" => 'How it Works'
				),				

				array(
					"type" => "textfield",
					"heading" => __("Sub Title", 'inventory'),
					"param_name" => "subtitle",
					"value" => 'Appropriately Strategize Performance Based Intellectual Capital Before Premier Users'
				),				

	            // params group
	            array(
	                'type' => 'param_group',
	                'value' => '',
	                'param_name' => 'how_it_works',
	                // Note params is mapped inside param-group:
	                'params' => array(
						array(
							"type" => "textfield",
							"heading" => __("Title", 'inventory'),
							"param_name" => "works_title",
							'value' => 'Choose Category',
						),				
						array(
							"type" => "textfield",
							"heading" => esc_html__("Sub Title", 'inventory'),
							"param_name" => "works_subtitle",
							'holder' => 'p',
							'value'	=> 'Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.'
						),							
						array(
							'type' => 'attach_image',
							'heading' => esc_html__( 'Works Images', 'inventory'),
							'param_name' => 'works_image',
							'value' => get_template_directory_uri() . '/images/l1.png',							
							'description' => esc_html__( 'Select images from media library.', 'inventory')
							),

	                )
	            ),
				array( 
					'type' => 'attach_image', 
					'heading' => __( 'Background Image', 'inventory'), 
					'param_name' => 'works_bg_image',
					'value' => get_template_directory_uri() . '/images/bg9.jpg',
					'dependency' => array( 
						'element' => "style", 
						'value' => array( 'style3')
						), 
					'description' => __( 'Select Featured Listings Background from media library', 'inventory') 
					), 
				array(
					"type" => "dropdown",
					"heading" => __("Style", 'inventory'),
					"param_name" => "style",
					"value" => array(
						'Style 1' => 'style1',
						'Style 2' => 'style2',
						'Style 3' => 'style3'
						),
					),


			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_inventory_how_it_works_shortcode_vc');