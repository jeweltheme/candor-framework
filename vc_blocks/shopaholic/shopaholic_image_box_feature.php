<?php 

/**
 * The Shortcode
 */
function candor_shopaholic_image_box_feature_shortcode( $atts ) {
		extract( shortcode_atts( array(
		'style'				=> '1',
		'content_position'  => 'default',
		'primary_background'=> '',
		'text_color'        => '',
		'bg'				=> '',
		'href'				=> '',
		'target'			=> '_self',
		'link_title'		=> 'Discover More',
		'sub_title'			=> '',
		'title'				=> '',
		'visibility'        => '',
		'el_class'          => '',
	), $atts ) );
	$el_class  = !empty($el_class) ? ' '.esc_attr( $el_class ) : '';
	$el_class .= shopaholic_visibility_class($visibility);
	if($style == '4'){
		$el_class .= ' box-ft-4-'.$content_position.' ';
	}
	if($style == '5'){
		$el_class .= $text_color;
	}

	$image_src = wp_get_attachment_url($bg);
	$href = !empty($href) ? $href : '#';
	if(empty($image_src)){
		$image_src = get_template_directory_uri().'/assets/images/noo-thumb_700x350.png';
	}
	ob_start();
	?>
	<div class="box-ft box-ft-<?php echo esc_attr($style)?> <?php echo ($style == '2') ? 'nice-border-full':''?> <?php echo esc_attr($el_class)?>">
		<?php if($style == '2'){?>
		<a href="<?php echo esc_attr($href)?>" target="<?php echo esc_attr($target)?>">
		<?php }?>
			<img src="<?php echo esc_attr($image_src)?>" alt="">
		<?php if($style == '2'){?>
		</a>
		<?php } ?>
		<?php if($style == '3'){?>
		<div class="box-ft-img-overlay" style="background-image: url(<?php echo esc_attr($image_src)?>)"></div>
		<?php }?>
		<?php if($style != '4'){?>
		<a href="<?php echo esc_attr($href)?>" target="<?php echo esc_attr($target)?>">
		<?php }?>
			<span class="bof-tf-title-wrap <?php if($style == 4 && $content_position == 'full-box' && !empty($primary_background)){echo ' bg-primary';}?>">
				<span class="bof-tf-title-wrap-2">
					<?php if($style == '2'){?>
					<span class="nice-border-top-left"></span>
					<span class="nice-border-top-right"></span>
					<span class="nice-border-bottom-left"></span>
					<span class="nice-border-bottom-right"></span>
					<?php }?>
					<?php if($style == '4' || $style=='5'){?>
						<span class="bof-tf-title"><?php echo esc_html($title)?></span>
						<?php if(!empty($sub_title)){?>
						<span class="bof-tf-sub-title"><?php echo esc_html($sub_title)?></span>
						<?php }?>
						<?php if(!empty($link_title) && $style == '4'){?>
							<a href="<?php echo esc_attr($href)?>" title="<?php echo esc_attr($link_title);?>" target="<?php echo esc_attr($target)?>"><?php echo esc_html($link_title);?></a>
						<?php }?>
					<?php }else { ?>
						<?php if(!empty($sub_title)){?>
						<span class="bof-tf-sub-title"><?php echo esc_html($sub_title)?></span>
						<?php }?>
						<span class="bof-tf-title"><?php echo esc_html($title)?></span>
					<?php } ?>
					<?php if($style == '3'){?>
					<span class="bof-tf-view-more"><?php esc_html_e('View More','woow')?></span>
					<?php }?>
				</span>
			</span>
		<?php if($style != '4'){?>
		</a>
		<?php }?>
	</div>
	<?php 
	echo ob_get_clean();
}
add_shortcode( 'shopaholic_image_box_feature', 'candor_shopaholic_image_box_feature_shortcode' );

/**
 * The VC Functions
 */
function candor_shopaholic_image_box_feature_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => esc_html__("Box Feature", 'shopaholic-wp'),
			"base" => "shopaholic_image_box_feature",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Classic Blog Posts with layout options.',
			"params" => array(
					
					array( 
						'type' => 'dropdown', 
						'heading' => __( 'Style', 'shopaholic-wp'), 
						'param_name' => 'style', 
						'std' => '1', 
						'value' => array( 
							__( 'Style 1', 'shopaholic-wp') => '1', 
							__( 'Style 2', 'shopaholic-wp') => "2", 
							__( 'Style 3', 'shopaholic-wp') => "3", 
							__( 'Style 4', 'shopaholic-wp') => "4", 
							__( 'Style 5', 'shopaholic-wp') => "5" ) ), 
					array( 
						'type' => 'dropdown', 
						'heading' => __( 'Content Position', 'shopaholic-wp'), 
						'param_name' => 'content_position', 
						'std' => 'default', 
						'dependency' => array( 'element' => 'style', 'value' => array( '4' ) ), 
						'value' => array( 
							__( 'Default', 'shopaholic-wp') => 'default', 
							__( 'Top', 'shopaholic-wp') => "top", 
							__( 'Bottom', 'shopaholic-wp') => "bottom", 
							__( 'Left', 'shopaholic-wp') => "left", 
							__( 'Right', 'shopaholic-wp') => "right", 
							__( 'Full Box', 'shopaholic-wp') => "full-box" ) ), 
					array( 
						'type' => 'checkbox', 
						'heading' => __( 'Full Box with Primary Soild Background ?', 'shopaholic-wp'), 
						'param_name' => 'primary_background', 
						'dependency' => array( 'element' => 'content_position', 'value' => array( 'full-box' ) ), 
						'value' => array( __( 'Yes,please', 'shopaholic-wp') => 'yes' ) ), 
					array( 
						'type' => 'dropdown', 
						'heading' => __( 'Text color', 'shopaholic-wp'), 
						'param_name' => 'text_color', 
						'dependency' => array( 'element' => 'style', 'value' => array( '5' ) ), 
						'std' => 'white', 
						'value' => array( __( 'White', 'shopaholic-wp') => "white", __( 'Black', 'shopaholic-wp') => "black" ) ), 
					array( 
						'type' => 'attach_image', 
						'heading' => __( 'Image Background', 'shopaholic-wp'), 
						'param_name' => 'bg', 
						'description' => __( 'Image Background.', 'shopaholic-wp') ), 
					array( 
						'type' => 'href', 
						'heading' => __( 'Image URL (Link)', 'shopaholic-wp'), 
						'param_name' => 'href', 
						'description' => __( 'Image Link.', 'shopaholic-wp') ), 
					array( 
						'type' => 'dropdown', 
						'heading' => __( 'Target', 'shopaholic-wp'), 
						'param_name' => 'target', 
						'std' => '_self', 
						'value' => array( 
							__( 'Same window', 'shopaholic-wp') => '_self', 
							__( 'New window', 'shopaholic-wp') => "_blank" ), 
						'dependency' => array( 'element' => 'href', 'not_empty' => true ) ), 
					array( 
						'param_name' => 'link_title', 
						'heading' => __( 'Button Text', 'shopaholic-wp'), 
						'type' => 'textfield', 
						'value' => '', 
						'dependency' => array( 'element' => 'style', 'value' => array( '4' ) ), 
						'description' => __( 'Button link text', 'shopaholic-wp') ), 
					array( 
						'param_name' => 'title', 
						'heading' => __( 'Title', 'shopaholic-wp'), 
						'admin_label' => true, 
						'type' => 'textfield', 
						'value' => '', 
						'description' => __( 'Box Title', 'shopaholic-wp') ), 
					array( 
						'param_name' => 'sub_title', 
						'heading' => __( 'Sub Title', 'shopaholic-wp'), 
						'type' => 'textfield', 
						'value' => '', 
						'description' => __( 'Box Sub Title', 'shopaholic-wp') 
						)

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_shopaholic_image_box_feature_shortcode_vc');
