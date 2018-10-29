<?php 

/**
 * The Shortcode
 */
function candor_inventory_blog_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'title' 		=> 'Read Awesome Stories',
				'subtitle' 		=> 'Appropriately Strategize Performance Based Intellectual Capital Before Premier Users',
				'style' 		=> 'style1',
				'pppage' 		=> '2',
				'pagination' 	=> 'yes',
				'show_posts' 	=> 'View All Stories',
				'filter' 		=> 'all'
			), $atts 
		) 
	);
	
	// Fix for pagination
	if( is_front_page() ) { 
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; 
	} else { 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
	}
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'post',
		'posts_per_page' => $pppage,
		'paged' => $paged
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}

	$block_query = new WP_Query( $query_args );

	ob_start();
	?>


<?php if( $style =="style1" ){ ?>

		<div class="bg7">
		    <div class="container padd-only-xs">
		        <div class="row">
		            <div class="col-xs-12">
		                <header class=" inv-block-header  margin-lg-t140 margin-lg-b140 margin-sm-t100 margin-sm-b100" >
			                <h3><?php echo $title;?></h3>
			                <?php if ( ! empty( $subtitle ) ) { ?>
			                	<span><?php echo $subtitle; ?></span>
			                <?php } ?>
		                </header>
		            </div>
		        </div>
		        <div class="row">
		        	
		        	<?php 
		        	$i = 1;
		        	if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post(); 
		        		global $post;
		        		$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'inventory-listing-thumb');
		        	?>


			            <div class="col-md-12">
			                <div class="inv-stories-item <?php echo ($i ==2)?"inv-stories-item2":"";?>">
			                    <div class="inv-stories-img">
			                    	<img src="<?php echo esc_url_raw( $image[0]);?>" alt="<?php the_title_attribute();?>" class="inv-img">
			                    </div>
			                    <div class="inv-stories-content">
			                        
			                        <?php inventory_blog_default_post_date();?>

			                        <div class="inv-stories-info">
			                            <h5>
			                                <a href="<?php the_permalink();?>"><?php the_title();?></a>
			                            </h5>
			                            <p><?php echo wp_trim_words( get_the_content(), 28, ' '  ); ?></p>
			                        </div>
			                    </div>
			                </div>
			            </div>

			        
			        <?php $i++; } }?>

			        <?php if( $pagination == "yes" ){ ?>
				        <div class="col-md-12">
				        	<div class="text-center margin-lg-b145 margin-sm-b100">
				        		<a href="<?php echo inventory_get_blog_link();?>" class="inv-btn"><?php echo $show_posts;?></a>
				        	</div>
				        </div>
			        <?php } ?>
		            
		        </div>
		    </div>
		</div>

<?php } elseif( $style =="style2" ){ ?>
		<div class="container padd-lr0">
		    <div class="row">
		        <div class="col-xs-12">
		            <header class=" inv-block-header  margin-lg-t140 margin-lg-b135 margin-sm-t100 margin-sm-b100">
		            	<h3><?php echo $title;?></h3>
		            	<?php if ( ! empty( $subtitle ) ) { ?>
			            	<span><?php echo $subtitle; ?></span>
		            	<?php } ?>
		            </header>
		        </div>
		    </div>
		    <div class="row">

	        	<?php 
	        	if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post(); 
	        		global $post;
	        		$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'inventory-blog-thumb');
	        	?>

			        <div class="col-md-6">
			            <div class="inv-stories-item inv-stories-item3">
			                <div class="inv-stories-img">
			                	<img src="<?php echo esc_url_raw( $image[0]);?>" alt="<?php the_title_attribute();?>" class="inv-img">
			                </div>
			                <div class="inv-stories-content">
			                    <?php inventory_blog_default_post_date();?>
			                    <div class="inv-stories-info">
			                        <h5>
			                            <a href="<?php the_permalink();?>"><?php the_title();?></a>
			                        </h5>
			                        <p><?php echo wp_trim_words( get_the_content(), 28, ' '  ); ?></p>
			                        <a href="<?php the_permalink();?>"><?php echo esc_html__('Read More','inventory');?></a>
			                    </div>
			                </div>
			            </div>
			        </div>

			    <?php } }?>

			    <?php if( $pagination == "yes" ){ ?>
				    <div class="col-md-12">
				    	<div class="text-center margin-lg-b145 margin-sm-b100">
				    		<a href="<?php echo inventory_get_blog_link();?>" class="inv-btn"><?php echo $show_posts;?></a>
				    	</div>
				    </div>
			    <?php } ?>

		    </div>
		</div>


<?php } elseif( $style =="style3" ){ ?>
		<div class="container padd-lr0">
		    <div class="row">
		        <div class="col-xs-12 padd-lr0">
		            <header class=" inv-block-header  margin-lg-t140 margin-lg-b100 margin-sm-t100">
		                <h3><?php echo $title;?></h3>
		            	<?php if ( ! empty( $subtitle ) ) { ?>
			            	<span><?php echo $subtitle; ?></span>
		            	<?php } ?>
		            </header>
		        </div>
		    </div>
		    <div class="row">

	        	<?php 
	        	if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post(); 
	        		global $post;
	        		$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'inventory-blog-thumb');
	        	?>
			        <div class="col-md-6">
				        <div class="inv-news-item ">
				            <div class="inv-news-time"><span><?php echo get_the_date('d'); ?></span><?php echo get_the_date('M'); ?></div>
				            <div class="inv-news-content">
				                <div class="inv-news-head">
				                	<span><?php echo esc_html__( 'By', 'inventory' );?> <?php printf('<a class="post-meta-element author vcard url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"> ' . esc_html( get_the_author_meta('display_name') ) . '</a>' ); ?>
				                	<?php echo esc_html__( 'in', 'inventory' );?>
				                	<?php 
					                	$categories_list = get_the_category_list( esc_html__( ', ', 'inventory' ) );
					                	if ( $categories_list ) {
												printf( '' . esc_html__( '%1$s', 'inventory' ) . '', $categories_list ); // WPCS: XSS OK.
									} ?>
									</span>
				                </div>
				                <div class="inv-news-info">
				                    <h5>
				                        <a href="<?php the_permalink();?>"><?php the_title();?></a>
				                    </h5>
				                    <p><?php echo wp_trim_words( get_the_content(), 28, ' '  ); ?></p>
				                </div>
				            </div>
				        </div>
			        </div>

				<?php } }?>

		    </div>

		    <?php if( $pagination == "yes" ){ ?>
			    <div class="row">
			        <div class="col-md-12">
			            <div class="text-center margin-lg-t75 margin-lg-b150  margin-sm-b100">
			            	<a href="<?php echo inventory_get_blog_link();?>" class="inv-btn"><?php echo $show_posts;?></a>
			           	</div>
			        </div>
			    </div>
			<?php } ?>

		</div>
<?php } ?>









<?php
	
	wp_reset_postdata();
	wp_reset_query();
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'inventory_blog', 'candor_inventory_blog_shortcode' );

/**
 * The VC Functions
 */
function candor_inventory_blog_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'inventory-vc-block',
			"name" => esc_html__("Blog ", 'inventory'),
			"base" => "inventory_blog",
			"category" => esc_html__('Inventory WP Theme', 'inventory'),
			'description' => 'Show Blog Posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'inventory'),
					"param_name" => "title",
					"value" => 'Read Awesome Stories'
					),				

				array(
					"type" => "textfield",
					"heading" => __("Sub Title", 'inventory'),
					"param_name" => "subtitle",
					"value" => 'Appropriately Strategize Performance Based Intellectual Capital Before Premier Users'
					),	
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'inventory'),
					"param_name" => "pppage",
					"value" => '2'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Blog Style", 'inventory'),
					"param_name" => "style",
					"value" => array(
						'Style 1' => 'style1',
						'Style 2' => 'style2',
						'Style 3' => 'style3',
						),
					),				
				array(
					"type" => "dropdown",
					"heading" => __("Show All Posts?", 'inventory'),
					"param_name" => "pagination",
					"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
						),
					),
				array(
					"type" => "textfield",
					"heading" => esc_html__("All Posts Text", 'inventory'),
					"param_name" => "show_posts",
					"value" => 'View All Stories',
					'dependency' => array( 
						'element' => "pagination", 
						'value' => array( 'yes')
					), 
				),

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_inventory_blog_shortcode_vc');