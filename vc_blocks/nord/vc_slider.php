<?php 

/**
 * The Shortcode
 */
function candor_nord_slider_image_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'slider_images' 	=> NORD_PATH .'/images/featured/01.jpg',
				'pppage' 			=> '999',
				'filter' 			=> 'all',
			), $atts 
		) 
	);

	ob_start();
?>




<div id="project-carousel" class="project-carousel slide-image-carousel owl-carousel owl-theme" >
    
    <!-- Wrapper for slides -->
	<?php 
	$images = explode(',', $slider_images);
	$i = 0;

	if( is_array($images) ){
		foreach( $images as $ID ){ 

			global $post;
			$images = wp_get_attachment_image_src( $ID, 'full');
			
			$image = get_post($ID);
			$image_title = $image->post_title;
			$image_caption = $image->post_content;
		?>

          <div class="item">
            <img src="<?php echo  esc_url( $images[0] ); ?>" alt="<?php the_title_attribute();?>">
            
            <div class="featured-work-caption white lft ltb tp-resizeme">
            	<?php echo esc_attr( $image_title );?>
            	<span class="black-bg white"><?php echo esc_attr( $image_caption );?></span>
            </div>

          </div>

		<?php
				$i++;	
			}
		} 
	?>  

</div>




<?php

	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'nord_slider_image', 'candor_nord_slider_image_shortcode' );

/**
 * The VC Functions
 */
function candor_nord_slider_image_shortcode_vc() {



	vc_map( 
		array(
			"icon" => 'nord-vc-block',
			"name" => esc_html__("Image Slider", 'nord'),
			"base" => "nord_slider_image",
			"category" => esc_html__('NORD WP Theme', 'nord'),
			'description' => 'Show Masonry Blog Posts with layout options.',
			"params" => array(
				array( 
					'type' => 'attach_images', 
					'heading' => __( 'Slider Images', 'nord'), 
					'param_name' => 'slider_images',
					'admin_label' => true,
					'value' => NORD_PATH . '/images/featured/01.jpg',
					'description' => __( 'Select Slider Images from media library', 'nord') 
					), 

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_nord_slider_image_shortcode_vc');