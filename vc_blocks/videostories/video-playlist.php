<?php 

/**
 * The Shortcode
 */
function candor_framework_videostories_video_playlist_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 				=> 'one',
				'order_by' 			=> 'post_view',
				'title'				=> 'Video playlists',
				'cat'				=> '1',
				'ppp' 				=> '10',
			), $atts 
		) 
	);


	
	ob_start();

	global $term_id;

	
?>
  	


<?php if($type=="one"){ ?>



  <section class="play-list">
    <div class="section-padding">
      <div class="container">
        
        <h2 class="section-title"><?php echo esc_attr( $title );?></h2><!-- /.section-title -->

        <div id="list-slider" class="list-slider owl-carousel owl-theme">

        	<?php 	
			$args = array(				
				'order'      => 'DESC',
				'hide_empty' => 0,
				'include'    => $cat,
				'pad_counts' => true,				
			);

			$video_category = get_terms( 'video_category', $args );

        	foreach ($video_category as $category){
        		global $post;
        		$image_id = get_term_meta( $category->term_id, 'video_category_image', true );
        		$image = wp_get_attachment_image_src( $image_id, "full" );	
			?>

        		<div class="item">
        			<article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
        				<div class="entry-thumbnail">
        					<img src="<?php echo esc_url_raw($image[0])?>" alt="<?php the_title_attribute();?>">
        					<a href="<?php echo get_term_link( $category->slug, 'video_category' ); ?>" class="iframe">
        						<span class="play-video"><i class="fa fa-play-circle-o"></i></span>
        					</a>
        				</div><!-- /.entry-thumbnail -->
        				<div class="entry-content">
        					<h3 class="category-name"><a href="<?php echo get_term_link( $category->slug, 'video_category' ); ?>"><?php echo $category->name; ?></a></h3><!-- /.category-name -->
        					<span class="post-count"><a href="<?php echo get_term_link( $category->slug, 'video_category' ); ?>"><span class="count"><?php echo $category->count; ?></span><?php echo esc_html__("videos", "videostories");?></a></span><!-- /.post-count -->
        				</div><!-- /.entry-content -->
        			</article><!-- /.post -->
        		</div>

			<?php } wp_reset_postdata();wp_reset_query(); ?>

        </div>
      </div>
    </div>
  </section>





<?php } elseif($type=="two"){ ?>


  <section class="play-list play-list-2">
    <div class="section-padding">
      <div class="container">
        <h2 class="section-title"><?php echo esc_attr( $title );?></h2><!-- /.section-title -->

        <div id="list-slider" class="list-slider owl-carousel owl-theme">

        	<?php 	
			$args = array(				
				'order'      => 'DESC',
				'hide_empty' => 0,
				'include'    => $cat,
				'pad_counts' => true,				
			);

			$video_category = get_terms( 'video_category', $args );

        	foreach ($video_category as $category){
        		global $post;        		
        		$image_id = get_term_meta( $category->term_id, 'video_category_image', true );
        		$image = wp_get_attachment_image_src( $image_id, "full" );	
			?>	          
	
				<div class="item">
					<article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-thumbnail">
							<img src="<?php echo esc_url_raw($image[0])?>" alt="<?php the_title_attribute();?>">
						</div><!-- /.entry-thumbnail -->
						<div class="entry-content">
							<h3 class="category-name"><a href="<?php echo get_term_link( $category->slug, 'video_category' ); ?>"><?php echo $category->name; ?></a></h3><!-- /.category-name -->
							<span class="post-count"><a href="<?php echo get_term_link( $category->slug, 'video_category' ); ?>"><span class="count"><?php echo $category->count; ?></span><?php echo esc_html__("videos", "videostories");?></a></span><!-- /.post-count -->
						</div><!-- /.entry-content -->
					</article><!-- /.post -->
				</div>


			<?php } wp_reset_postdata();wp_reset_query(); ?>

        </div>
      </div>
    </div>
  </section>




<?php } ?>


			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'videostories_video_playlist', 'candor_framework_videostories_video_playlist_shortcode' );




if( !function_exists( 'videostories_get_video_category' ) ){
	function videostories_get_video_category( $taxonomy ){
		$terms_array = array();
		if( !taxonomy_exists( $taxonomy ) )
			return;
		$args = array(
			'orderby'       => 'name',
			'order'         => 'ASC',
			'hide_empty'    => true,
			'exclude'       => array(),
			'exclude_tree'  => array(),
			'include'       => array(),
			'fields'        => 'all',
			'hierarchical'  => true,
			'child_of'      => 0,
			'pad_counts'    => false,
			'cache_domain'  => 'core'
		);
		$terms = get_terms( $taxonomy, $args );
		if ( !empty( $terms ) && !is_wp_error( $terms ) ){
			foreach ( $terms as $term ) {
				$terms_array[ $term->name ]	=	$term->term_id;
			}
		}
		return $terms_array;
	}
}



/**
 * The VC Functions
 */
function candor_framework_videostories_video_playlist_shortcode_vc() {


	vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => esc_html__("Section: Video Playlist", 'videstories'),
			"base" => "videostories_video_playlist",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			'description' => 'Show Video Playlist by Category.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Section Title", 'videstories'),
					"param_name" => "title",
					"value" => 'Video playlists',
				),	

				array(
					'type'	=>	'checkbox',					
					'heading'	=>	esc_html__('Video Category','videstories'),
					'param_name'	=>	'cat',
					'holder'	=>	'div',
					'description'	=>	esc_html__('Choose the Video Category or leave for default.','videstories'),
					'value'	=>	videostories_get_video_category( 'video_category' ),
				),

				array( 
					'param_name' => 'type', 
					'heading' => esc_html__( 'Layout', 'videstories'), 
					'type' => 'dropdown', 
					'admin_label' => true, 
					'std' => 'one', 
					'value' => array( 
							esc_html__( 'Style 1', 'videstories') 		=> 'one', 
							esc_html__( 'Style 2', 'videstories') 		=> 'two' ) 
				),	

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_videostories_video_playlist_shortcode_vc');