<?php

/**
 * The Shortcode
 */
function cast_contact_shortcode( $atts, $content = null ) {
    extract(
        shortcode_atts(
            array(
                'contact_form'      => '[contact-form-7 id="2197" title="Contact form 1"]',
                'contact_info_title'        => 'Contact Info',


            ), $atts
        )
    );


    ob_start();
    $contact_info = vc_param_group_parse_atts( $atts['contact_info'] );

?>
    <section class="contact-details">
        <div class="section-padding">
            <div class="container">
                <div class="items">
                    <div class="col-sm-8">
                        <div class="inner-bg">
                            <h2 class="section-title"><?php the_title();?></h2><!-- /.section-title -->
                            <div class="padding">

                                <?php echo do_shortcode( $contact_form );?>

                            </div><!-- /.padding -->
                        </div><!-- /.inner-bg -->
                    </div>

                    <div class="col-sm-4">
                        <div class="inner-bg">
                            <h2 class="section-title"><?php echo esc_html( $contact_info_title ); ?></h2><!-- /.section-title -->
                            <div class="padding">

                                <?php foreach ($contact_info as $key => $value ) {
                                    //$service_img = wp_get_attachment_image_src( $value['bg_image'], 'full' );
                                    ?>
                                        <div class="item media">
                                            <div class="item-icon media-left"><i class="<?php echo esc_attr( $value['contact_icon'] );?>"></i></div><!-- /.item-icon -->
                                            <div class="item-details media-body">
                                                <h3 class="item-title"><?php echo esc_attr( $value['contact_title'] );?></h3><!-- /.item-title -->
                                                <span>
                                                    <?php echo esc_attr( $value['contact_desc'] );?>
                                                </span>
                                            </div><!-- /.item-details -->
                                        </div><!-- /.item -->

                                <?php } ?>

                            </div><!-- /.padding -->
                        </div><!-- /.inner-bg -->
                    </div>
                </div><!-- /.items -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.contact-details -->


<?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'cast_contact', 'cast_contact_shortcode' );



/**
 * The VC Functions
 */
function cast_contact_shortcode_vc() {


    vc_map(
        array(
            "icon" => 'cast-vc-block',
            "name" => esc_html__("Contact Block", 'cast'),
            "base" => "cast_contact",
            "category" => esc_html__('CAST WP Theme', 'cast'),
            'description' => 'Contact Section with Contact Form',
            'wrapper_class'   => 'clearfix',
            "params" => array(
                  array(
                    "type" => "textfield",
                    "heading" => __("Contact Form 7 Shortcode", 'elevation'),
                    "param_name" => "contact_form",
                    "value" => '[contact-form-7 id="2197" title="Contact form 1"]'
                  ),

                  array(
                    "type" => "textfield",
                    "heading" => __("Info Section Title", 'elevation'),
                    "param_name" => "contact_info_title",
                    "value" => 'Contact Info'
                  ),
                // params group
                array(
                    'type' => 'param_group',
                    "heading" => __("Contact Form Info", 'elevation'),
                    'value' => '',
                    'param_name' => 'contact_info',
                    // Note params is mapped inside param-group:
                    'params' => array(

                        array(
                            'type'         => 'iconpicker',
                            'heading'      => esc_html__( 'Icon', 'cast' ),
                            'param_name'   => 'contact_icon',
                            'value'        => 'fa fa-map-marker',
                            'settings'     => array(
                                               'emptyIcon'    => false, // default true, display an "EMPTY" icon?
                                               'iconsPerPage' => 100, // default 100, how many icons per/page to display
                                               ),
                            'description'  => esc_html__( 'Select icon from library.', 'cast' ),
                        ),


                        array(
                            "type" => "textfield",
                            "heading" => __("Info Title", 'cast'),
                            "param_name" => "contact_title",
                            'holder' => 'div',
                            'value' => 'ADDRESS',
                        ),
                        array(
                            "type" => "textfield",
                            "heading" => __("Info Description", 'cast'),
                            "param_name" => "contact_desc",
                            'holder' => 'div',
                            'value' => '121 King Street, Melbourne VIC 3000, Australia',
                        ),

                    ),


                )
            )
        )
    );
}
add_action( 'vc_before_init', 'cast_contact_shortcode_vc' );
