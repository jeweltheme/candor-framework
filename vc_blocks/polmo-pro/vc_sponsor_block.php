<?php 

/**
 * The Shortcode
 */
function candor_vc_polmo_sponsors_block_shortcode( $atts, $content = null ) {
  extract( 
    shortcode_atts( 
      array(
        'title'       => '<span>Our</span> Elite Sponsors',
        'sponsor_images'      => ''
      ), $atts 
    ) 
  );

  ob_start();
?>


  <div class="sponsors text-center" data-stellar-background-ratio="0.1" data-stellar-vertical-offset="0">
    <div class="section-pattern">
      <div class="section-padding">
        <div class="container">
          <div class="row">
            <div class="wow animated fadeInUp" data-wow-delay=".5s">
              <h2 class="section-title"><span>Our</span> Elite Sponsors</h2><!-- /.section-title -->

              <div class="section-details">
                <div class="sponsors-logo">

                  <?php $images = explode(',', $sponsor_images);
                  $i = 0;

                  if( is_array($images) ){
                    foreach( $images as $ID ){ 
                      $partners_url = get_post_meta( $ID,'_partners_url',true );

                      echo '<div class="col-sm-3 col-xs-6"><a href="' . $partners_url  . '" target="_blank">'. wp_get_attachment_image( $ID, 'full' ) .'</a></div>';
                      $i++; 
                    }
                  }?>


                </div><!-- /.sponsors-logo -->
              </div><!-- /.section-details -->
            </div>
          </div><!-- /.row -->
        </div><!-- /.container -->
      </div><!-- /.section-padding -->
    </div><!-- /.section-pattern -->
  </div><!-- /#sponsors -->


<?php   
  //wp_reset_postdata();
  
  $output = ob_get_contents();
  ob_end_clean();
  
  return $output;

}
add_shortcode( 'polmo_sponsors', 'candor_vc_polmo_sponsors_block_shortcode' );



/**
 * The VC Functions
 */
function candor_polmo_sponsors_block_shortcode_vc() {
  
  
  vc_map( 
    array(
      "icon" => 'polmo-pro-vc-block',
      "name" => esc_html__("Sponsors", 'polmo-pro'),
      "base" => "polmo_sponsors",
      "category" => esc_html__('Polmo Pro WP Theme', 'polmo-pro'),
      "params" => array(
        array(
          "type" => "textfield",
          "heading" => esc_html__("Section Title", 'elevation'),
          "param_name" => "title",
          'holder' => 'h2',
          'value' => '<span>Our</span> Elite Sponsors'
        ),
        array(
          'type' => 'attach_images',
          'heading' => esc_html__( 'Background Parallax Image', 'elevation' ),
          'param_name' => 'sponsor_images',
          'value' => '',
          "admin_label" => true,
          'description' => esc_html__( 'Select images from media library.', 'elevation' )
        )        

      )
    ) 
  );
}
add_action( 'vc_before_init', 'candor_polmo_sponsors_block_shortcode_vc' );