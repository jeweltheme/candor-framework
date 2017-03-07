<?php 

/**
 * The Shortcode
 */
function candor_framework_inventory_featured_places_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'title'           		=> 'Featured Places to go',
				'subtitle'        		=> 'Appropriately Strategize Performance Based Intellectual Capital Before Premier Users',
				'style' 		  		=> 'style1',
				'featured_bg_image' 	=> get_template_directory_uri() . '/images/bg2.jpg',
				'featured_bg_color' 	=> '#f0f0f0',
				'orderby' 				=> 'date',
				'pppage' 		  		=> '3',

			), $atts 
		) 
	);

	ob_start();
	$featured_bg_image = wp_get_attachment_image_src( $featured_bg_image, 'full' );
	
		global $post;
			// lets query some
			$query_args = array(
				'post_type'   => 'job_listing',
				'post_status' => 'publish'
			);

			if ( ! empty( $pppage ) && is_numeric( $pppage ) ) {
				$query_args['posts_per_page'] = $pppage;
			}

			if ( ! empty( $orderby ) && is_string( $orderby ) ) {
				$query_args['orderby'] = $orderby;
			}

			if ( ! empty( $show ) && $show === 'featured' ) {
				$query_args['meta_key']   = '_featured';
				$query_args['meta_value'] = '1';
			}

			// if ( ! empty( $items_ids ) && is_string( $items_ids ) ) {
			// 	$query_args['post__in'] = explode( ',', $items_ids );
			// }

			// if ( ! empty( $categories_slug ) && is_string( $categories_slug ) ) {
			// 	$categories_slug = explode( ',', $categories_slug );

			// 	foreach ( $categories_slug as $key => $cat ) {
			// 		$categories_slug[ $key ] = sanitize_title( $cat );
			// 	}
			// 	$query_args['tax_query'] = array(
			// 		'relation' => 'AND',
			// 		array(
			// 			'taxonomy' => 'job_listing_category',
			// 			'field'    => 'slug',
			// 			'terms'    => $categories_slug,
			// 		)
			// 	);
			// }

			$listings = new WP_Query( $query_args );


?>

<?php if( $style =="style1" ){ ?>
	<div class="inv-places2 inv-bg-block padding-lg-b150 padding-sm-b100">
		<img src="<?php echo $featured_bg_image[0];?>" alt="<?php the_title_attribute();?>" class="inv-img">
<?php } elseif( $style =="style2" ){ ?>
	<div class="inv-places2 bg7 padding-lg-b150 padding-sm-b100">
<?php }?>
    
    <div class="container padd-lr0">
        <div class="row">
            <div class="col-xs-12">
	            <?php if( $style =="style1" ){ ?>
					<header class=" inv-block-header  margin-lg-t140 margin-lg-b10 margin-sm-t100">
				<?php } elseif( $style =="style2" ){ ?>
					<header class=" inv-block-header col5 col6 margin-lg-t135 margin-lg-b105 margin-sm-t100">
				<?php }?>
                    <h3><?php echo $title;?></h3>
	                <span><?php echo $subtitle;?></span>
                </header>
            </div>
        </div>

        <?php if( $style =="style1" ){ ?>
			<div class="row margin-lg-t90">
        <?php } elseif( $style =="style2" ){ ?>
        	<div class="row">
        <?php }?>
        

        	<?php if ( $listings->have_posts() ) { while ( $listings->have_posts() ) { $listings->the_post(); 

        				$terms = get_the_terms( get_the_ID(), 'job_listing_category' );

						$listing_classes = 'card  card--listing  card--widget  ';
						$listing_is_claimed = false;
						$listing_is_featured = false;

						if ( is_position_featured($post) ) $listing_is_featured = true;

						if ( class_exists( 'WP_Job_Manager_Claim_Listing' ) ) {
							$classes = WP_Job_Manager_Claim_Listing()->listing->add_post_class( array(), '', $post->ID  );

							if ( isset( $classes[0] ) && ! empty( $classes[0] ) ) {
								$listing_classes .= $classes[0];

								if ( $classes[0] == 'claimed' )
									$listing_is_claimed = true;
							}
						}

						if ( true === $listing_is_featured ) $listing_classes .= '  is--featured';

						$listing_classes = apply_filters( 'inventory_listing_archive_classes', $listing_classes, $post ); ?>

	            <div class="col-xs-12 col-sm-4">
	                <div class="inv-places2-item <?php echo $listing_classes; ?>">
	                    <div class="inv-places2-head">
	                    	<img src="<?php echo inventory_get_post_image_src( $post->ID, 'inventory-card-image' ); ?>" alt="<?php the_title_attribute();?>">
	                    </div>
	                    <div class="bg8 inv-places2-row">
	                        <div class="inv-places2-info">
	                        	<div itemscope itemtype="http://schema.org/Place">
	                            <h3 itemprop="name"><a href="<?php the_job_permalink(); ?>"><?php
	                            	echo get_the_title();
	                            	if ( $listing_is_claimed ) :
	                            		echo '<span class="listing-claimed-icon">';
	                            	get_template_part('assets/svg/checked-icon-small');
	                            	echo '<span>';
	                            	endif;
	                            	?></a></h3>

	                            	<?php $listing_address = inventory_get_formatted_address( $post );
									if ( ! empty( $listing_address ) ) { ?>
										
											<?php echo $listing_address; ?>
										
									<?php } ?>

	                        	</div>
	                        </div>
	                        <div class="inv-places2-footer">
	                            <div class="info-rating">
	                                
	                                <?php if ( ! is_wp_error( $terms ) && ( is_array( $terms ) || is_object( $terms ) ) ) { ?>

										<ul class="card__tags">
											<?php foreach ( $terms as $term ) {
												$icon_url      = inventory_get_term_icon_url( $term->term_id );
												$attachment_id = inventory_get_term_icon_id( $term->term_id );
												if ( empty( $icon_url ) ) {
													continue;
												} ?>
												<li>
													<div class="card__tag">
														<div class="pin__icon">
															<?php //inventory_display_image( $icon_url, '', true, $attachment_id ); ?>
														</div>
													</div>
												</li>
											<?php } ?>
										</ul>

									<?php } ?>


									<?php
										$rating = get_average_listing_rating( $post->ID, 1 );
										if ( ! empty( $rating ) ) { ?>
											<div class="rating  card__rating">
												<span class="js-average-rating"><?php echo get_average_listing_rating( $post->ID, 1 ); ?></span>
											</div>
										<?php } else {
											if ( get_post_meta( $post->ID, 'geolocation_street', true ) ) { ?>
												<div class="card__rating  card__pin">
													<?php //get_template_part( 'assets/svg/pin-simple-svg' ) ?>
												</div>
											<?php }
										} ?>

	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
            <?php } } ?>

        </div>
    </div>
</div>


<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'inventory_featured_places', 'candor_framework_inventory_featured_places_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_inventory_featured_places_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'inventory-vc-block',
			"name" => __("Featured Places", 'inventory'),
			"base" => "inventory_featured_places",
			"category" => esc_html__('Inventory WP Theme', 'inventory'),
			'description' => 'Show Featured Listing Places',
			"params" => array(

				array(
					"type" => "textfield",
					"heading" => __("Title", 'inventory'),
					"param_name" => "title",
					"value" => 'Featured Places to go'
				),				

				array(
					"type" => "textfield",
					"heading" => __("Sub Title", 'inventory'),
					"param_name" => "subtitle",
					"value" => 'Appropriately Strategize Performance Based Intellectual Capital Before Premier Users'
				),				
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'inventory'),
					"param_name" => "pppage",
					"value" => '3'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Order By", 'inventory'),
					"param_name" => "orderby",
					"value" => array(
							'Name' => 'name',
							'ID' => 'ID',
							'Title' => 'title',
							'Date' => 'date',
							'Rand' => 'rand',
						),
					),	

				// array(
				// 	'type' => 'attach_image',
				// 	'heading' => esc_html__( 'Works Images', 'inventory'),
				// 	'param_name' => 'works_image',
				// 	'value' => get_template_directory_uri() . '/images/l1.png',							
				// 	'description' => esc_html__( 'Select images from media library.', 'inventory')
				// 	),			


				array( 
						'param_name' => 'type', 
						'heading' => __( 'Background Type', 'inventory'), 
						'type' => 'dropdown', 
						'admin_label' => true, 
						'std' => 'color', 
						'value' => array( 
								__( 'Background Color', 'inventory') 		=> 'color', 
								__( 'Background Image', 'inventory') 		=> 'image' ) 
					),
				array( 
					'type' => 'attach_image', 
					'heading' => __( 'Background Image', 'inventory'), 
					'param_name' => 'featured_bg_image',
					'value' => get_template_directory_uri() . '/images/bg2.jpg',
					'dependency' => array( 
						'element' => "type", 
						'value' => array( 'image')
						), 
					'description' => __( 'Select Featured Listings Background from media library', 'inventory') 
					), 

				array(
					"type" => "colorpicker",
					"heading" => __("Background Color", 'inventory'),
					"param_name" => "featured_bg_color",
					"value" => '#f0f0f0', //Default Red color
					'dependency' => array( 
						'element' => "type", 
						'value' => array( 'color')
						), 
					),

				array(
					"type" => "dropdown",
					"heading" => __("Style", 'inventory'),
					"param_name" => "style",
					"value" => array(
						'Style 1' => 'style1',
						'Style 2' => 'style2'
						),
					),

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_inventory_featured_places_shortcode_vc');