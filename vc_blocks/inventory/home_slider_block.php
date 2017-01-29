<?php 

/**
 * The Shortcode
 */
function candor_framework_inventory_home_slider_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				 
				// 'pricing_category' 	=> 'Basic',
				 'layout' 			=> 'style1',
				// 'filter' 			=> 'all'

				'title'           => 'Explore your City’s Finest',
				'subtitle'        => 'We help you to find hotels, restaurents, shops, places to visit, etc in over 150+ Countries',
				'pppage' 			=> '5',
				'show'            => 'all',
				'orderby'         => 'date',
				'home_slider1_bg' => 'date',
				'items_ids'       => '',
				'categories_slug' => 'arts',				

				'map_lat' 		  => '40.7143528',
				'map_lon' 		  => '-74.0059731',

				'frontpage_search_fields' => 'keywords',
								
			), $atts 
		) 
	);
	

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

	if ( ! empty( $items_ids ) && is_string( $items_ids ) ) {
		$query_args['post__in'] = explode( ',', $items_ids );
	}

	if ( ! empty( $categories_slug ) && is_string( $categories_slug ) ) {
		$categories_slug = explode( ',', $categories_slug );

		foreach ( $categories_slug as $key => $cat ) {
			$categories_slug[ $key ] = sanitize_title( $cat );
		}
		$query_args['tax_query'] = array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'job_listing_category',
				'field'    => 'slug',
				'terms'    => $categories_slug,
			)
		);
	}
	$listings = new WP_Query( $query_args );


	

	ob_start();

	$home_slider1_bg = wp_get_attachment_image_src( $home_slider1_bg, 'full' );
	$counter_part = vc_param_group_parse_atts( $atts['counter_part'] );
	

	global $post;

	//	print_r($li);

?>
	


<?php if ( inventory_using_facetwp() ) {

	$facets = inventory_get_facets_by_area( 'front_page_hero' );

	$fields_num = count( $facets );
	if ( $fields_num > 0 ) { ?>

		<div class="search_jobs  search_jobs--frontpage  search_jobs--frontpage-facetwp<?php echo ( 1 == $fields_num ) ? '  has--one-field' : ''; ?>">

			<?php inventory_display_facets( $facets ); ?>

			<button class="search-submit" name="submit" id="searchsubmit" onclick="facetwp_redirect_to_listings()">
				<?php get_template_part( 'assets/svg/search-icon-svg'); ?>
				<span><?php esc_html_e( 'Search', 'inventory' ); ?></span>
			</button>

		</div>

		<div style="display: none;">

			<?php echo facetwp_display('template', 'listings' ); ?>

		</div>

		<script>
			(function($) {

				$(document).ready(function () {
					//prevent the facets from disappearing
					FWP.loading_handler = function() {}
				});

				$(document).on('keyup','.search_jobs--frontpage-facetwp input[type="text"]', function(e) {
					if (e.which === 13) {
						//wait a little bit
						setTimeout(
							function() {
								//if the user presses ENTER/RETURN in a text field then redirect
								facetwp_redirect_to_listings();
								return false;
							}, 500);
					}
				});
			})(jQuery);

			function facetwp_redirect_to_listings() {
				FWP.parse_facets();
				FWP.set_hash();
				var query_string = FWP.build_query_string();
				if ('' != query_string) {
					query_string = '?' + query_string;
				}
				var url = query_string;
				window.location.href = '<?php echo inventory_get_listings_page_url(); ?>' + url;
			}
		</script>

		<?php
	}
}else {

$show_categories = true;
if ( ! get_option( 'job_manager_enable_categories' ) ) {
	$show_categories = false;
}
$atts = apply_filters( 'job_manager_ouput_jobs_defaut', array(
    'per_page' => get_option( 'job_manager_per_page' ),
    'orderby' => 'featured',
    'order' => 'DESC',
    'show_categories' => $show_categories,
    'show_tags' => false,
    'categories' => true,
    'selected_category' => false,
    'job_types' => false,
    'location' => false,
    'keywords' => false,
    'selected_job_types' => false,
    'show_category_multiselect' => false,
    'selected_region' => false
) );




	if ( empty( $fields_options ) ) {
		//in case the defaults were not saved in the database, impose them - only the keywords search field is shown by default
		$fields_options[0] =  'keywords';
	}
	$fields_num = count( $fields_options );
?>

<?php do_action( 'job_manager_job_filters_before', $atts ); ?>

	<?php if( $layout =="style1" ){ ?>
		<div class="inv-start-block inv-bg-block">
			<img src="<?php echo $home_slider1_bg[0];?>" alt="<?php the_title_attribute();?>" class="inv-img">
		    <div class="container padd-lr0">
		        <div class="row">
		            <div class="col-xs-12">
		                <header class=" inv-block-header margin-lg-t340 margin-lg-b75 margin-sm-t270">

		                    <h1><?php echo $title;?></h1>
		                    <?php if ( ! empty( $subtitle ) ) { ?>
			                    <h5><?php echo $subtitle; ?></h5>
		                    <?php } ?>
		                </header>


		                <div class="inv-start-form">
							<?php if ( $fields_num >= 1 ) { ?>

								<form class="search-form   job_search_form  js-search-form" action="<?php echo inventory_get_listings_page_url(); ?>" method="get" role="search">
									<?php if ( ! get_option('permalink_structure') ) {
										//if the permalinks are not activated we need to put the listings page id in a hidden field so it gets passed
										$listings_page_id = get_option( 'job_manager_jobs_page_id', false );
										//only do this in case we do have a listings page selected
										if ( false !== $listings_page_id ) {
											echo '<input type="hidden" name="p" value="' . $listings_page_id . '">';
										}
									} ?>
									<?php do_action( 'job_manager_job_filters_start', $atts ); ?>

									<div class="search_jobs  search_jobs--frontpage<?php if ( 1 == $fields_num ) echo '  has--one-field'; ?>">

										<?php do_action( 'job_manager_job_filters_search_jobs_start', $atts ); ?>

										<?php 
						                	if ( $fields_options[0] == "keywords" ){
							                	$has_search_menu = false;
							                	if ( has_nav_menu( 'search_suggestions' ) )  {
							                		$has_search_menu = true;
							                	}
						                	?>	 
										
											<label for="search_keywords"><?php _e( 'Keywords', 'inventory' ); ?></label>										
											<input name="search_keywords" id="search_keywords" type="text" placeholder="Keywords">
											<?php wp_nav_menu( array(
												'container' => false,
												'theme_location' => 'search_suggestions',
												'menu_class' => 'search-suggestions-menu',
												'fallback_cb'     => false,
												) ); ?>

										<?php } ?>

										
										<?php if ( $fields_options[1] == "location" ){ ?>
											<div class="search_location  search-filter-wrapper">
												<label for="search_location"><?php esc_html_e( 'Locations', 'inventory' ); ?></label>
												<?php if ( class_exists( 'Astoundify_Job_Manager_Regions' ) && "1" === get_option('job_manager_regions_filter') ) { ?>
													<div class="search_region-dummy">
														<input type="text" name="search_location" id="search_location" placeholder="<?php esc_attr_e( 'Locations', 'inventory' ); ?>" style="display: none;" />
														<input type="text" class="select-region-dummy  search-field" disabled="disabled" placeholder="<?php esc_attr_e( 'All Locations', 'inventory' ); ?>" />
													</div>
												<?php } else { ?>
													<input type="text" name="search_location" id="search_location" placeholder="<?php esc_attr_e( 'Locations', 'inventory' ); ?>" />
												<?php } ?>
											</div>
										<?php } ?>

										<?php if ( $fields_options[2] == "categories" ){ 
					                    if ( true === $show_categories ) { ?>	
									        <div class="search_categories  search-filter-wrapper">
									            <label for="search_categories"><?php esc_html_e( 'Category', 'inventory' ); ?></label>
									            <?php job_manager_dropdown_categories( array( 'taxonomy' => 'job_listing_category', 'hierarchical' => 1, 'show_option_all' => esc_html__( 'All Categories', 'inventory' ), 'name' => 'search_categories', 'orderby' => 'name', 'multiple' => false ) ); ?>
									        </div>
									    <?php } } ?>


										<?php do_action( 'job_manager_job_filters_search_jobs_end', $atts ); ?>

										<button class="search-submit" name="submit" id="searchsubmit"><i class="icon-magnifier icons"></i>Search Now</button>
									</div>

									<?php do_action( 'job_manager_job_filters_end', $atts ); ?>
								</form>

								<?php } // if ( $fields_num >= 1 )?>

							</div>


							<?php do_action( 'job_manager_job_filters_after', $atts ); ?>

							<noscript><?php _e( 'Your browser does not support JavaScript, or it is disabled. JavaScript must be enabled in order to view listings.', 'wp-job-manager' ); ?></noscript>

							<div class="inv-group margin-lg-b200 margin-sm-b100">
								<?php inventory_display_frontpage_listing_categories(); ?>
							</div>

		            </div>
		        </div>
		    </div>
		</div>
	
	<?php } elseif( $layout =="style2" ){
		$fields_options = explode(',', $frontpage_search_fields );
	?>

		<div class="inv-start-block ">
			<div class="wpc-map" data-lat="<?php echo $map_lat;?>" data-lng="<?php echo $map_lon;?>" data-zoom="10" data-style="style-1" data-string="WPC string"></div>

			<div class="inv-body-start-form2">
				<div class="container padd-lr0">
					<div class="row">
						<div class="col-xs-12">

		                <div class="inv-start-form bg14 margin-lg-t515  margin-sm-t250 margin-lg-b200 margin-xs-t150 margin-xs-b0">

							<?php if ( $fields_num >= 1 ) { ?>

								<form class="search-form   job_search_form  js-search-form" action="<?php echo inventory_get_listings_page_url(); ?>" method="get" role="search">
									<?php if ( ! get_option('permalink_structure') ) {
										//if the permalinks are not activated we need to put the listings page id in a hidden field so it gets passed
										$listings_page_id = get_option( 'job_manager_jobs_page_id', false );
										//only do this in case we do have a listings page selected
										if ( false !== $listings_page_id ) {
											echo '<input type="hidden" name="p" value="' . $listings_page_id . '">';
										}
									} ?>
									<?php do_action( 'job_manager_job_filters_start', $atts ); ?>

									<div class="search_jobs  search_jobs--frontpage<?php if ( 1 == $fields_num ) echo '  has--one-field'; ?>">

										<?php do_action( 'job_manager_job_filters_search_jobs_start', $atts ); ?>

										<?php 
						                	if ( $fields_options[0] == "keywords" ){
							                	$has_search_menu = false;
							                	if ( has_nav_menu( 'search_suggestions' ) )  {
							                		$has_search_menu = true;
							                	}
						                	?>	 
										
											<label for="search_keywords"><?php _e( 'Keywords', 'inventory' ); ?></label>										
											<input name="search_keywords" id="search_keywords" type="text" placeholder="Keywords">
											<?php wp_nav_menu( array(
												'container' => false,
												'theme_location' => 'search_suggestions',
												'menu_class' => 'search-suggestions-menu',
												'fallback_cb'     => false,
												) ); ?>

										<?php } ?>

										
										<?php if ( $fields_options[1] == "location" ){ ?>
											<div class="search_location  search-filter-wrapper">
												<label for="search_location"><?php esc_html_e( 'Locations', 'inventory' ); ?></label>
												<?php if ( class_exists( 'Astoundify_Job_Manager_Regions' ) && "1" === get_option('job_manager_regions_filter') ) { ?>
													<div class="search_region-dummy">
														<input type="text" name="search_location" id="search_location" placeholder="<?php esc_attr_e( 'Locations', 'inventory' ); ?>" style="display: none;" />
														<input type="text" class="select-region-dummy  search-field" disabled="disabled" placeholder="<?php esc_attr_e( 'All Locations', 'inventory' ); ?>" />
													</div>
												<?php } else { ?>
													<input type="text" name="search_location" id="search_location" placeholder="<?php esc_attr_e( 'Locations', 'inventory' ); ?>" />
												<?php } ?>
											</div>
										<?php } ?>

										<?php if ( $fields_options[2] == "categories" ){ 
					                    if ( true === $show_categories ) { ?>	
									        <div class="search_categories  search-filter-wrapper">
									            <label for="search_categories"><?php esc_html_e( 'Category', 'inventory' ); ?></label>
									            <?php job_manager_dropdown_categories( array( 'taxonomy' => 'job_listing_category', 'hierarchical' => 1, 'show_option_all' => esc_html__( 'All Categories', 'inventory' ), 'name' => 'search_categories', 'orderby' => 'name', 'multiple' => false ) ); ?>
									        </div>
									    <?php } } ?>


										<?php do_action( 'job_manager_job_filters_search_jobs_end', $atts ); ?>

										<button class="search-submit" name="submit" id="searchsubmit"><i class="icon-magnifier icons"></i>Search Now</button>
									</div>

									<?php do_action( 'job_manager_job_filters_end', $atts ); ?>
								</form>

								<?php } // if ( $fields_num >= 1 )?>

							</div>



						</div>
					</div>
				</div>
			</div>
		</div>



		<!-- Counter Part -->
		
		    <div class="container">
	            <div class="row">
	                <div class="col-xs-12 ">
	                    <div class="inv-places-counts bg8">
	                    	<?php 
	                    	$i=7;	                    	
	                    	foreach ($counter_part as $key => $value ) {?>
		                        <div class="inv-places-count col<?php echo $i;?>">
		                            <span data-to="<?php echo esc_attr( $value['count_number'] );?>" data-speed="10000"></span><i><?php echo esc_attr( $value['count_symbol'] );?></i>
		                            <p><?php echo esc_attr( $value['count_desc'] );?></p>
		                        </div>
	                        <?php $i++; } ?>
	                    </div>
	                </div>
	            </div>
		    </div>
		

	<?php } elseif( $layout =="style3" ){ ?>

			<div class="inv-start-block inv-bg-block inv-header3">
			    <img src="<?php echo $home_slider1_bg[0];?>" alt="<?php the_title_attribute();?>" class="inv-img">
			    <div class="container padd-lr0">
			        <div class="row">
			            <div class="col-xs-12">
			                <header class=" inv-block-header margin-lg-t490 margin-lg-b340 margin-sm-t270 margin-sm-b200">			                    
			                    <h1><?php echo $title;?></h1>
			                    <?php if ( ! empty( $subtitle ) ) { ?>
				                    <h5><?php echo $subtitle; ?></h5>
			                    <?php } ?>
			                </header>
			            </div>
			        </div>
			    </div>
			    <div class="bg-transparent">
			        <div class="container padd-lr0">
			            <div class="row">
			                <div class="col-xs-12">
			                    <div class="inv-start-form margin-lg-t30">
			                        
			                        <form class="search-form   job_search_form  js-search-form" action="<?php echo inventory_get_listings_page_url(); ?>" method="get" role="search">
										<?php if ( ! get_option('permalink_structure') ) {
											//if the permalinks are not activated we need to put the listings page id in a hidden field so it gets passed
											$listings_page_id = get_option( 'job_manager_jobs_page_id', false );
											//only do this in case we do have a listings page selected
											if ( false !== $listings_page_id ) {
												echo '<input type="hidden" name="p" value="' . $listings_page_id . '">';
											}
										} ?>
										<?php do_action( 'job_manager_job_filters_start', $atts ); ?>

										<div class="search_jobs  search_jobs--frontpage<?php if ( 1 == $fields_num ) echo '  has--one-field'; ?>">

											<?php do_action( 'job_manager_job_filters_search_jobs_start', $atts ); ?>

											<?php 
							                	if ( $fields_options[0] == "keywords" ){
								                	$has_search_menu = false;
								                	if ( has_nav_menu( 'search_suggestions' ) )  {
								                		$has_search_menu = true;
								                	}
							                	?>	 
											
												<label for="search_keywords"><?php _e( 'Keywords', 'inventory' ); ?></label>										
												<input name="search_keywords" id="search_keywords" type="text" placeholder="Keywords">
												<?php wp_nav_menu( array(
													'container' => false,
													'theme_location' => 'search_suggestions',
													'menu_class' => 'search-suggestions-menu',
													'fallback_cb'     => false,
													) ); ?>

											<?php } ?>

											
											<?php if ( $fields_options[1] == "location" ){ ?>
												<div class="search_location  search-filter-wrapper">
													<label for="search_location"><?php esc_html_e( 'Locations', 'inventory' ); ?></label>
													<?php if ( class_exists( 'Astoundify_Job_Manager_Regions' ) && "1" === get_option('job_manager_regions_filter') ) { ?>
														<div class="search_region-dummy">
															<input type="text" name="search_location" id="search_location" placeholder="<?php esc_attr_e( 'Locations', 'inventory' ); ?>" style="display: none;" />
															<input type="text" class="select-region-dummy  search-field" disabled="disabled" placeholder="<?php esc_attr_e( 'All Locations', 'inventory' ); ?>" />
														</div>
													<?php } else { ?>
														<input type="text" name="search_location" id="search_location" placeholder="<?php esc_attr_e( 'Locations', 'inventory' ); ?>" />
													<?php } ?>
												</div>
											<?php } ?>

											<?php if ( $fields_options[2] == "categories" ){ 
						                    if ( true === $show_categories ) { ?>	
										        <div class="search_categories  search-filter-wrapper">
										            <label for="search_categories"><?php esc_html_e( 'Category', 'inventory' ); ?></label>
										            <?php job_manager_dropdown_categories( array( 'taxonomy' => 'job_listing_category', 'hierarchical' => 1, 'show_option_all' => esc_html__( 'All Categories', 'inventory' ), 'name' => 'search_categories', 'orderby' => 'name', 'multiple' => false ) ); ?>
										        </div>
										    <?php } } ?>


											<?php do_action( 'job_manager_job_filters_search_jobs_end', $atts ); ?>

											<button class="search-submit" name="submit" id="searchsubmit"><i class="icon-magnifier icons"></i>Search Now</button>
										</div>

										<?php do_action( 'job_manager_job_filters_end', $atts ); ?>
									</form>

			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>




	<?php } elseif( $layout =="style4" ){ ?>
		<div class=" inv-index4-start inv-bg-block margin-lg-t140 margin-xs-t95">
		    <div class="wpc-map sattelite" data-lat="<?php echo $map_lat;?>" data-lng="<?php echo $map_lon;?>" data-zoom="10" data-style="style-1" data-type= "satellite" data-string="WPC string"></div>
		</div>

		<div class="inv-wrap-form inv-index4-form bg7 ">
			<div class="container padd-lr0">
				<div class="row">
					<div class="col-xs-12">
						<div class="inv-start-form margin-lg-t-75">

							<?php if ( $fields_num >= 1 ) { ?>
								<form class="search-form   job_search_form  js-search-form" action="<?php echo inventory_get_listings_page_url(); ?>" method="get" role="search">
									<?php if ( ! get_option('permalink_structure') ) {
										//if the permalinks are not activated we need to put the listings page id in a hidden field so it gets passed
										$listings_page_id = get_option( 'job_manager_jobs_page_id', false );
										//only do this in case we do have a listings page selected
										if ( false !== $listings_page_id ) {
											echo '<input type="hidden" name="p" value="' . $listings_page_id . '">';
										}
									} ?>
									<?php do_action( 'job_manager_job_filters_start', $atts ); ?>

									<div class="search_jobs  search_jobs--frontpage<?php if ( 1 == $fields_num ) echo '  has--one-field'; ?>">

										<?php do_action( 'job_manager_job_filters_search_jobs_start', $atts ); ?>

										<?php 
						                	if ( $fields_options[0] == "keywords" ){
							                	$has_search_menu = false;
							                	if ( has_nav_menu( 'search_suggestions' ) )  {
							                		$has_search_menu = true;
							                	}
						                	?>	 
										
											<label for="search_keywords"><?php _e( 'Keywords', 'inventory' ); ?></label>										
											<input name="search_keywords" id="search_keywords" type="text" placeholder="Keywords">
											<?php wp_nav_menu( array(
												'container' => false,
												'theme_location' => 'search_suggestions',
												'menu_class' => 'search-suggestions-menu',
												'fallback_cb'     => false,
												) ); ?>

										<?php } ?>

										
										<?php if ( $fields_options[1] == "location" ){ ?>
											<div class="search_location  search-filter-wrapper">
												<label for="search_location"><?php esc_html_e( 'Locations', 'inventory' ); ?></label>
												<?php if ( class_exists( 'Astoundify_Job_Manager_Regions' ) && "1" === get_option('job_manager_regions_filter') ) { ?>
													<div class="search_region-dummy">
														<input type="text" name="search_location" id="search_location" placeholder="<?php esc_attr_e( 'Locations', 'inventory' ); ?>" style="display: none;" />
														<input type="text" class="select-region-dummy  search-field" disabled="disabled" placeholder="<?php esc_attr_e( 'All Locations', 'inventory' ); ?>" />
													</div>
												<?php } else { ?>
													<input type="text" name="search_location" id="search_location" placeholder="<?php esc_attr_e( 'Locations', 'inventory' ); ?>" />
												<?php } ?>
											</div>
										<?php } ?>

										<?php if ( $fields_options[2] == "categories" ){ 
					                    if ( true === $show_categories ) { ?>	
									        <div class="search_categories  search-filter-wrapper">
									            <label for="search_categories"><?php esc_html_e( 'Category', 'inventory' ); ?></label>
									            <?php job_manager_dropdown_categories( array( 'taxonomy' => 'job_listing_category', 'hierarchical' => 1, 'show_option_all' => esc_html__( 'All Categories', 'inventory' ), 'name' => 'search_categories', 'orderby' => 'name', 'multiple' => false ) ); ?>
									        </div>
									    <?php } } ?>


										<?php do_action( 'job_manager_job_filters_search_jobs_end', $atts ); ?>

										<button class="search-submit" name="submit" id="searchsubmit"><i class="icon-magnifier icons"></i>Search Now</button>
									</div>

									<?php do_action( 'job_manager_job_filters_end', $atts ); ?>
								</form>
							<?php } // if ( $fields_num >= 1 )?>

						</div>
						

					</div>
				</div>
			</div>
		</div>



	<?php } elseif( $layout =="style5" ){ ?>

			<div class="inv-start-block inv-bg-block">
				<img src="<?php echo $home_slider1_bg[0];?>" alt="<?php the_title_attribute();?>" class="inv-img">
			    <div class="container padd-lr0">
			        <div class="row">
			            <div class="col-xs-12">
			                <header class=" inv-block-header margin-lg-t340 margin-lg-b300 margin-sm-t270 margin-sm-b150">
			                    <h1><?php echo $title;?></h1>
			                    <?php if ( ! empty( $subtitle ) ) { ?>
				                    <h5><?php echo $subtitle; ?></h5>
			                    <?php } ?>
			                </header>
			                <div class="col-xs-12">
			                    <div class="inv-start-block-slider">
			                        <div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="1000" data-slides-per-view="responsive" data-add-slides="5" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="5">
			                            <div class="swiper-wrapper">
			                            	<?php inventory_display_frontpage_listing_categories_slider();?>
			                            </div>
			                            <div class="pagination"></div>
			                        </div>
			                        <div class="swiper-outer-right"></div>
			                        <div class="swiper-outer-left"></div>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>


	<?php } ?>





<?php }



	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'inventory_home_slider', 'candor_framework_inventory_home_slider_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_inventory_home_slider_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'inventory-vc-block',
			"name" => __("Home Slider", 'inventory'),
			"base" => "inventory_home_slider",
			"category" => esc_html__('Inventory WP Theme', 'inventory'),
			'description' => 'Show Listing Table with layout options.',
			"params" => array(

				array(
					"type" => "dropdown",
					"heading" => __("Header Style", 'inventory'),
					"param_name" => "layout",
					"value" => array(
							'Style 1' => 'style1',
							'Style 2' => 'style2',
							'Style 3' => 'style3',
							'Style 4' => 'style4',
							'Style 5' => 'style5',
						),
					),

				// Style 1
				array(
					"type" => "textfield",
					"heading" => __("Title", 'inventory'),
					"param_name" => "title",
					"value" => 'Explore your City’s Finest',
					'dependency' => array( 
						'element' => "layout", 
						'value' => array( 'style1','style3', 'style5' )
						), 
				),				

				array(
					"type" => "textfield",
					"heading" => __("Sub Title", 'inventory'),
					"param_name" => "subtitle",
					"value" => 'We help you to find hotels, restaurents, shops, places to visit, etc in over 150+ Countries',
					'dependency' => array( 
						'element' => "layout", 
						'value' => array( 'style1','style3', 'style5' )
						), 
				),			
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Background Image', 'inventory'),
					'param_name' => 'home_slider1_bg',
					'value' => get_template_directory_uri() . '/images/bg1.png',							
					'description' => esc_html__( 'Select images from media library.', 'inventory'),
					'dependency' => array( 
						'element' => "layout", 
						'value' => array( 'style1', 'style3', 'style5',  )
						), 
				),	
				array(
					'type' => 'checkbox',
					'heading' => __( 'Search Fields', 'inventory' ),
					'param_name' => 'frontpage_search_fields',
					'value' => array(
						__( 'Keywords', 'inventory' ) => 'keywords',
						__( 'Location', 'inventory' ) => 'location',
						__( 'Categories', 'inventory' ) => 'categories',
						),
					'dependency' => array( 
						'element' => "layout", 
						'value' => array( 'style1', 'style2', 'style3', 'style4')
						), 
					),


				array(
					"type" => "textfield",
					"heading" => __("Show How Many Categories?", 'inventory'),
					"param_name" => "pppage",
					"value" => '5',
					'dependency' => array( 
						'element' => "layout", 
						'value' => array( 'style1')
						), 
					),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Listing Categories', 'inventory' ),
					'param_name' => 'categories_slug',
					'value'		  => '',
					'dependency' => array( 
						'element' => "layout", 
						'value' => array( 'style1')
						),
					'description' => esc_html__( 'List of Listing Category Slug', 'inventory' ),
				),

				// Style 2

				// Counter Part				
	            array(
	                'type' => 'param_group',
	                'value' => '',
	                'dependency' => array( 
	                	'element' => "layout", 
	                	'value' => array( 'style2' )
	                	),
	                'param_name' => 'counter_part',
	                // Note params is mapped inside param-group:
	                'params' => array(
						array(
							"type" => "textfield",
							"heading" => __("Counter Number", 'shopaholic-wp'),
							"param_name" => "count_number",
							'holder' => 'div',
							'value' => '350',
						),					
						array(
							"type" => "textfield",
							"heading" => __("Counter Text", 'shopaholic-wp'),
							"param_name" => "count_symbol",
							'holder' => 'div',
							'value' => '+',
						),				
						array(
							"type" => "textfield",
							"heading" => __("Counter Desc", 'shopaholic-wp'),
							"param_name" => "count_desc",
							'holder' => 'div',
							'value' => 'Directory Categories',
						),
	                )
	            ),

				// Style 3
				array(
					"type" => "textfield",
					"heading" => __("Lattitude", 'shopaholic-wp'),
					"param_name" => "map_lat",
					'holder' => 'div',
					'value' => '40.7143528',
					'dependency' => array( 
						'element' => "layout", 
						'value' => array( 'style2', 'style4')
					), 
				),					
				array(
					"type" => "textfield",
					"heading" => __("Longitude", 'shopaholic-wp'),
					"param_name" => "map_lon",
					'holder' => 'div',
					'value' => '-74.0059731',
					'dependency' => array( 
						'element' => "layout", 
						'value' => array( 'style2', 'style4')
					), 
				),	


			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_inventory_home_slider_shortcode_vc');