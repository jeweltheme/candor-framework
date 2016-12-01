<?php 

/**
 * The Shortcode
 */
function candor_nord_fashion_slider_shortcode( $atts ) {
  extract( 
    shortcode_atts( 
      array(
        'fashion_images'     => NORD_PATH .'/images/fashion/01.jpg',
        'fashion_title_one'  => 'Nord',
        'fashion_title_two'  => 'NYC',
        'fashion_sub_title'  => 'Fashion / Mid Summer 2',
      ), $atts 
    ) 
  );

  ob_start();
?>




      <section class="intro-fashion fullheight add-top-half">

         <div class="valign">
          <div class="container-fluid">

            <div class="row">
              <div class="col-md-6 col-md-offset-3 text-center header-caps">
                <h1 class="black font2 fashion"><?php echo esc_attr( $fashion_title_one );?><span class="font2ultralight dark"><?php echo esc_attr( $fashion_title_two );?></span></h1>
                <h5><span class="color-bg white font2"><?php echo esc_attr( $fashion_sub_title );?></span></h5>
              </div>
            </div>

          </div>
        </div>

    </section>


  <!-- CASE STUDIES MODULE - BG SLIDER SCRIPT  -->
  <script>
  jQuery(document).ready(function($){

    jQuery('.intro-fashion').backstretch([
    <?php 
        $images = explode(',', $fashion_images);
        $i = 0;
        if( is_array($images) ){
          foreach( $images as $ID ){ 
            global $post;
            $images = wp_get_attachment_image_src( $ID, 'full');
            ?>
            "<?php echo  esc_url( $images[0] ); ?>",
        <?php } } ?>

    ], {duration: 1500, fade: 750});


  });
  </script>


<?php

  $output = ob_get_contents();
  ob_end_clean();
  
  return $output;
}
add_shortcode( 'nord_fashion_slider', 'candor_nord_fashion_slider_shortcode' );

/**
 * The VC Functions
 */
function candor_nord_fashion_slider_shortcode_vc() {



  vc_map( 
    array(
      "icon" => 'nord-vc-block',
      "name" => esc_html__("Fashion Slider", 'nord'),
      "base" => "nord_fashion_slider",
      "category" => esc_html__('NORD WP Theme', 'nord'),
      'description' => 'Show Fashion Slider Images',
      "params" => array(
        array( 
            'type' => 'attach_images', 
            'heading' => esc_html__( 'Slider Images', 'nord'), 
            'param_name' => 'fashion_images',
            'admin_label' => true,
            'value' => NORD_PATH . '/images/fashion/01.jpg',
            'description' => esc_html__( 'Select Slider Images from media library', 'nord') 
          ), 
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title One", 'nord'),
            "param_name" => "fashion_title_one",
            'holder' => '',
            'value' => esc_html__('Nord', 'nord'),
          ),          
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title Two", 'nord'),
            "param_name" => "fashion_title_two",
            'holder' => '',
            'value' => esc_html__('NYC', 'nord'),
          ),            
        array(
            "type" => "textfield",
            "heading" => esc_html__("Sub Title", 'nord'),
            "param_name" => "fashion_sub_title",
            'holder' => '',
            'value' => esc_html__('Fashion / Mid Summer 2016','nord'),
          ),    

      )
    ) 
  );
  
}
add_action( 'vc_before_init', 'candor_nord_fashion_slider_shortcode_vc');