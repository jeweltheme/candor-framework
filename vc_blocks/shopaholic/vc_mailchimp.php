<?php 

/**
 * The Shortcode
 */
function candor_shopaholic_mailchimp_shortcode( $atts, $content = null  ) {
  extract( 
    shortcode_atts( 
      array(
        'mailchimp_title'     => 'Stay up to date',
        'mailchimp_desc'      => 'Solemn time travelling north that day, it was fine May weather',
        'mailchimp_shortcode' => '[mc4wp_form id="2310"]'
      ), $atts 
    ) 
  );
  
  ob_start();
?>

  <section class="subscribe subscribe-01">
    <div class="container">
      <div class="subscribe-details">
        <div class="row">
          <div class="col-sm-5">
            <div class="section-top">
              <h3 class="section-title">
                <?php echo strip_tags($mailchimp_title);?><span></span>
              </h3><!-- /.section-title -->
            </div>
            <p class="description">
              <?php echo strip_tags($mailchimp_desc);?>
            </p><!-- /.description -->
          </div>
          <div class="col-sm-7">
            <?php echo do_shortcode( '[mc4wp_form id="' . $mailchimp_shortcode . '"]');?>
          </div>
        </div><!-- /.row -->
      </div><!-- /.subscribe-details -->
    </div><!-- /.section-padding -->
  </section><!-- /.subscribe -->


<?php
  wp_reset_postdata();
  wp_reset_query();
  $output = ob_get_contents();
  ob_end_clean();
  
  return $output;
}
add_shortcode( 'shopaholic_mailchimp', 'candor_shopaholic_mailchimp_shortcode' );

/**
 * The VC Functions
 */
function candor_shopaholic_mailchimp_shortcode_vc() {
  
  vc_map( 
    array(
      "icon" => 'shopaholic-vc-block',
      "name" => esc_html__("Mailchimp", 'shopaholic-wp'),
      "base" => "shopaholic_mailchimp",
      "category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
      'description' => 'Show Mailchimp options.',
      "params" => array(

        array(
          "type"        => "textfield",
          "heading"     => esc_html__("Title", 'shopaholic-wp'),
          "param_name"  => "mailchimp_title",
          "value"       => 'Stay up to date'
        ),  
        array(
          "type"        => "textfield",
          "heading"     => esc_html__("Short Description", 'shopaholic-wp'),
          "param_name"  => "mailchimp_desc",
          "value"       => 'Solemn time travelling north that day, it was fine May weather'
        ),          

        array(
          "type"        => "textfield",
          "heading"     => esc_html__("Mailchim Form ID", 'shopaholic-wp'),
          "param_name"  => "mailchimp_shortcode",
          "value"       => '2310'
        ),  

      )
    ) 
  );
  
}
add_action( 'vc_before_init', 'candor_shopaholic_mailchimp_shortcode_vc');

