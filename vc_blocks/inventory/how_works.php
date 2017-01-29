<?php 

/**
 * The Shortcode
 */
function inventory_how_works_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'how_works_title' 		=> 'Add Your Listing',
				'how_works_content' 	=> 'Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.',
				'how_works_image' 		=>  get_template_directory_uri() . '/images/46.png' ,

			), $atts 
		) 
	);

	ob_start();

	$how_works = vc_param_group_parse_atts( $atts['how_works'] );	
	//print_r($how_works);
	?>
<div class="container">

	<?php 
	$i=1;
	foreach ($how_works as $key => $value ) {
	$how_works_image = wp_get_attachment_image_src( $value['how_works_image'], 'full' ); 
	?>
	    <div class="row">
	        <div class="col-md-6 <?php if($i==1) echo 'padd-lr0';?> <?php if($i==2) echo 'col-md-push-6';?> ">
	            
	            <?php if( $i==1 ){ ?>
	            	<div class="inv-it-work-info padding-lg-t265 padding-sm-t50 margin-lg-b55">
	            <?php } if( $i==2 ){ ?>
	            	<div class="inv-it-work-info padding-lg-t175 padding-sm-t0 margin-lg-b55">
	            <?php } if( $i==3 ){ ?>
	            	<div class="inv-it-work-info padding-lg-t175 padding-sm-t50">
	            <?php } ?>
	            
	                <h3><?php echo esc_attr( $value['how_works_title'] );?></h3>
	                <p><?php // echo wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode( $value['how_works_content'] )));?></p>
	                <p><?php echo esc_attr( $value['how_works_content'] );?></p>
	            </div>
	        </div>


	        <div class="col-md-6 <?php if($i==2) echo 'col-md-pull-6';?>">

   	        	<?php if( $i==1 ){ ?>
	            	<div class="inv-it-work-img padding-lg-t150 padding-sm-t0 margin-lg-b55">
	            <?php } if( $i==2 ){ ?>
	            	<div class="inv-it-work-img padding-lg-t60 padding-sm-t50 padding-lg-b60">
	            <?php } if( $i==3 ){ ?>
	            	<div class="inv-it-work-img padding-lg-t60">
	            <?php } ?>

	                <img src="<?php echo esc_url_raw( $how_works_image[0] ); ?>" alt="<?php the_title_attribute();?>">
	            </div>
	        </div>
	        
	            <?php if( $i==1 ){ ?>
	            	<div class="col-xs-12">
		            	<div class="inv-it-pseudoelem"><div class="inv-it-pseudo1"></div>
		            	<div class="inv-it-pseudo2"></div></div>
		            </div>
	            <?php } if( $i==2 ){ ?>
			        <div class="col-xs-12">
			            <div class="inv-it-pseudoelem2"><div class="inv-it-pseudo1"></div>
			            <div class="inv-it-pseudo2"></div></div>
			        </div>
	            <?php } ?>
	            

	        </div>
	    
	<?php $i++; 
	} ?>

</div>

<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'inventory_how_works', 'inventory_how_works_shortcode' );

/**
 * The VC Functions
 */
function inventory_how_works_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'inventory-vc-block',
			"name" => esc_html__("How Works", 'inventory'),
			"base" => "inventory_how_works",
			"category" => esc_html__('Inventory WP Theme', 'inventory'),
			'description' => 'Show How Works with layout options.',
			'wrapper_class'   => 'clearfix',
			"params" => array(
	            array(
	                'type' => 'param_group',
	                'value' => '',
	                'param_name' => 'how_works',
	                // Note params is mapped inside param-group:
	                'params' => array(

						array(
							"type" => "textfield",
							"heading" => __("Title", 'inventory'),
							"param_name" => "how_works_title",
							'holder' => 'div',
							'value' => 'Add Your Listing',
						),				
						array(
							"type" => "textarea_html",
							"heading" => __("Works Content", 'inventory'),
							"param_name" => "how_works_content",
							'holder' => 'div',
							'value' => 'Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.',
						),
						array( 
							'type' => 'attach_image', 
							'heading' => __( 'Image', 'inventory'), 
							'param_name' => 'how_works_image',
							'admin_label' => true,							
							'description' => __( 'Select How Works Image from media library', 'inventory') 
							), 




	                )
	            ),

			array(
				"type" => "textfield",
				"heading" => __("Title", 'inventory'),
				"param_name" => "how_works_title",
				'holder' => 'div',
				'value' => 'Add Your Listing',
			),	

				

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'inventory_how_works_shortcode_vc');