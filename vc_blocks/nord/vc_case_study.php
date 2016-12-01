<?php 

/**
 * The Shortcode
 */
function candor_nord_case_studies_shortcode( $atts ) {
  extract( 
    shortcode_atts( 
      array(
        'case_images'     => NORD_PATH .'/images/case/01/01.jpg',
        'case_title'      => 'Oxenn',
        'case_btn'        => 'View Case Study',
        'case_link'       => '#',
      ), $atts 
    ) 
  );

  ob_start();

  $case_studies = vc_param_group_parse_atts( $atts['case_studies'] );  

$i=1;
foreach ($case_studies as $key => $value ) { ?>
  <section class="case-study-item case-study-item-0<?php echo esc_attr($i);?> fullheight">
   
      <div class="valign">     
        <div class="container-fluid">
          
              <div class="row">
                  <div class="col-md-6 col-md-offset-3 text-center header-caps">
                    <h1 class="black font2"><?php echo esc_attr( $value['case_title'] );?></h1>
                    <a class="btn btn-nord btn-nord-dark" href="<?php echo esc_attr( $value['case_link']  );?>"><?php echo esc_attr( $value['case_btn'] );?></a>
                  </div>
              </div>

          </div>
      </div>

  </section>



  <!-- CASE STUDIES MODULE - BG SLIDER SCRIPT  -->
  <script>
  jQuery(document).ready(function($){

    jQuery('.case-study-item-0<?php echo esc_attr($i);?>').backstretch([
    <?php 
        $images = explode(',', $value['case_images']);
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


<?php $i++; } ?>

<?php

  $output = ob_get_contents();
  ob_end_clean();
  
  return $output;
}
add_shortcode( 'nord_case_studies', 'candor_nord_case_studies_shortcode' );

/**
 * The VC Functions
 */
function candor_nord_case_studies_shortcode_vc() {



  vc_map( 
    array(
      "icon" => 'nord-vc-block',
      "name" => esc_html__("Case Studies", 'nord'),
      "base" => "nord_case_studies",
      "category" => esc_html__('NORD WP Theme', 'nord'),
      'description' => 'Show Case Studies Slider Images',
      "params" => array(

        array(
          'type' => 'param_group',
          'value' => '',
          'param_name' => 'case_studies',
                  // Note params is mapped inside param-group:
          'params' => array(

              array( 
                  'type' => 'attach_images', 
                  'heading' => esc_html__( 'Slider Images', 'nord'), 
                  'param_name' => 'case_images',
                  'admin_label' => true,
                  //'value' => NORD_PATH . '/images/case/01/01.jpg',
                  'description' => esc_html__( 'Select Slider Images from media library', 'nord') 
                ), 
              array(
                  "type" => "textfield",
                  "heading" => esc_html__("Title", 'nord'),
                  "param_name" => "case_title",
                  'holder' => '',
                  'value' => esc_html__('Oxenn', 'nord'),
                ),  
              array(
                  "type" => "textfield",
                  "heading" => esc_html__("Case Button Text", 'nord'),
                  "param_name" => "case_btn",
                  'holder' => '',
                  'value' => esc_html__('View Case Study', 'nord'),
                ),  
              array(
                  "type" => "textfield",
                  "heading" => esc_html__("Case Link", 'nord'),
                  "param_name" => "case_link",
                  'holder' => '',
                  'value' => esc_html__('#', 'nord'),
                ),  

              )
          ),


      )
    ) 
  );
  
}
add_action( 'vc_before_init', 'candor_nord_case_studies_shortcode_vc');