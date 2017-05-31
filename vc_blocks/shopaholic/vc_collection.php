<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_collection_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(

				'collection_img_1'		=> get_template_directory_uri() . '/images/home01/thumb/1.png',
				'collection_img_text_1'	=> 'Kids',
				'collection_img_link_1'	=> '#',

				'collection_img_2'		=> get_template_directory_uri() . '/images/home01/thumb/2.png',
				'collection_img_text_2'	=> 'Men',
				'collection_img_link_2'	=> '#',

				'collection_img_3'		=> get_template_directory_uri() . '/images/home01/thumb/3.png',
				'collection_img_text_3'	=> 'Women',
				'collection_img_link_3'	=> '#',

			), $atts 
		) 
	);
	

	$collection_img_1 = wp_get_attachment_image_src( $collection_img_1, 'full' );
	$collection_img_2 = wp_get_attachment_image_src( $collection_img_2, 'full' );
	$collection_img_3 = wp_get_attachment_image_src( $collection_img_3, 'full' );

	ob_start();
?>
	
  <section class="collection">
    <div class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-sm-4 left-content">
            <div class="item">
              <div class="item-thumb">
                <a href="<?php echo esc_url_raw( $collection_img_link_1 ); ?>">
                  <img src="<?php echo esc_url_raw( $collection_img_1[0] ); ?>" alt="<?php echo get_the_title();?>">
                </a>
              </div><!-- /.item-thumb -->
              <div class="item-details">
                <h3 class="item-title">
                	<?php echo esc_attr( $collection_img_text_1 );?>
                </h3><!-- /.item-title -->
              </div><!-- /.item-details -->
            </div><!-- /.item -->
          </div>

          <div class="col-sm-8 right-content">
            <div class="item">
              <div class="item-thumb">
                <a href="<?php echo esc_url_raw( $collection_img_link_2 ); ?>">
                  <img src="<?php echo esc_url_raw( $collection_img_2[0] ); ?>" alt="<?php echo get_the_title();?>">
                </a>
              </div><!-- /.item-thumb -->
              <div class="item-details">
                <h3 class="item-title">
                	<?php echo esc_attr( $collection_img_text_2 );?>
                </h3><!-- /.item-title -->
              </div><!-- /.item-details -->
            </div><!-- /.item -->

            <div class="item">
              <div class="item-thumb">
                <a href="<?php echo esc_url_raw( $collection_img_link_3 ); ?>">
                  <img src="<?php echo esc_url_raw( $collection_img_3[0] ); ?>" alt="<?php echo get_the_title();?>">
                </a>
              </div><!-- /.item-thumb -->
              <div class="item-details">
                <h3 class="item-title">
                	<?php echo esc_attr( $collection_img_text_3 );?>
                </h3><!-- /.item-title -->
              </div><!-- /.item-details -->
            </div><!-- /.item -->
          </div>

        </div><!-- /.row -->
      </div><!-- /.container -->
    </div><!-- /.section-padding -->
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_collection', 'candor_framework_shopaholic_collection_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_shopaholic_collection_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Collection", 'shopaholic-wp'),
			"base" => "shopaholic_collection",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Collection Images Section',
			"params" => array(
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Collection Image 1', 'shopaholic-wp' ),
					'param_name' => 'collection_img_1',
					'value' => get_template_directory_uri() . '/images/home01/thumb/1.png',
					"admin_label" => true,
					'description' => esc_html__( 'Select images from media library.', 'shopaholic-wp' )
				),
				array(
					"type" => "textfield",
					"heading" => __("Collection Image 1 Text", 'shopaholic-wp'),
					"param_name" => "collection_img_text_1",
					'holder' => 'div',
					'value' => 'Kids',
				),
				array(
					"type" => "textfield",
					"heading" => __("Collection Image 1 Link", 'shopaholic-wp'),
					"param_name" => "collection_img_link_1",
					'value' => '#',
				),


				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Collection Image 2', 'shopaholic-wp' ),
					'param_name' => 'collection_img_2',
					'value' => get_template_directory_uri() . '/images/home01/thumb/2.png',
					"admin_label" => true,
					'description' => esc_html__( 'Select images from media library.', 'shopaholic-wp' )
				),
				array(
					"type" => "textfield",
					"heading" => __("Collection Image 2 Text", 'shopaholic-wp'),
					"param_name" => "collection_img_text_2",
					'holder' => 'div',
					'value' => 'Kids',
				),
				array(
					"type" => "textfield",
					"heading" => __("Collection Image 2 Link", 'shopaholic-wp'),
					"param_name" => "collection_img_link_2",
					'value' => '#',
				),


				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Collection Image 3', 'shopaholic-wp' ),
					'param_name' => 'collection_img_3',
					'value' => get_template_directory_uri() . '/images/home01/thumb/3.png',
					"admin_label" => true,
					'description' => esc_html__( 'Select images from media library.', 'shopaholic-wp' )
				),
				array(
					"type" => "textfield",
					"heading" => __("Collection Image 3 Text", 'shopaholic-wp'),
					"param_name" => "collection_img_text_3",
					'holder' => 'div',
					'value' => 'Kids',
				),
				array(
					"type" => "textfield",
					"heading" => __("Collection Image 3 Link", 'shopaholic-wp'),
					"param_name" => "collection_img_link_3",
					'value' => '#',
				),




			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_collection_shortcode_vc');