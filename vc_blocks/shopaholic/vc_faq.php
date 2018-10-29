<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_faq_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' 		=> -1,
				'filter' 		=> 'all',
				'faq_type' 		=> 'no'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' 		=> 'faq',
		'posts_per_page' 	=> $pppage,
		'filter'	 		=> 'all'
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'faq_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'faq_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}

	$block_query = new WP_Query( $query_args );

	ob_start();
?>
	

	 <section class="faq-section">
		<div class="faq-tabs">


				<ul class="nav nav-tabs" role="tablist">
					<?php
						$cats = get_categories('taxonomy=faq_category');
						if(is_array($cats)){
							$i=1;
							foreach($cats as $cat){ ?>
								<li role="presentation" class="<?php echo ($i==1)?"active":"";?>"><a href="#tab<?php echo $i;?>" aria-controls="tab<?php echo $i;?>" role="tab" data-toggle="tab"><?php echo $cat->name;?></a></li>
								<?php 
								$i++;
							}
						}
					?>
				</ul>

			

			<div class="tab-content">
						<?php 
						$i=1;
							if ( $block_query->have_posts() ) { ?>
							
							<div role="tabpanel" class="tab-pane" id="tab<?php echo esc_html__( $i );?>">
							
								<?php while ( $block_query->have_posts() ) { $block_query->the_post();?>

						            
						              <div class="panel-group" id="accordion<?php echo esc_html__( $i );?>" role="tablist" aria-multiselectable="true">


						                <div class="panel panel-default">
						                  <div class="panel-heading" role="tab" id="headingEight">
						                    <h4 class="panel-title">
						                      <a role="button" data-toggle="collapse" data-parent="#accordion<?php echo esc_html__( $i );?>" href="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
						                        <?php the_title();?>
						                      </a>
						                    </h4>
						                  </div>
						                  <div id="collapseEight" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingEight">
						                    <div class="panel-body">
						                      <?php the_content();?>
						                    </div>
						                  </div>
						                </div>

						              </div>
						            


								<?php 
								} ?>
							
							</div>

							<?php
							$i++;
							}
						?>
			</div>

		</div><!-- /.pricing-->
	</section>
			
<?php	

	wp_enqueue_style( 'shopaholic-faq', SHOPAHOLIC_CSS . 'pages/faq.css', false, SHOPAHOLIC_VER );
	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_faq', 'candor_framework_shopaholic_faq_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_shopaholic_faq_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("FAQ", 'shopaholic-wp'),
			"base" => "shopaholic_faq",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show FAQ with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'shopaholic-wp'),
					"param_name" => "pppage",
					"value" => '4'
				),
				array(
					"type" 			=> "dropdown",
					"heading" 		=> __("Show Image?", 'shopaholic-wp'),
					"param_name" 	=> "faq_type",
					"value" => array(
							'No' 	=> 'no',
							'Yes' 	=> 'yes',						
						),
					),	
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_faq_shortcode_vc');