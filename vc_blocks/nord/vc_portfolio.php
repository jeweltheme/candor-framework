<?php 

/**
 * The Shortcode
 */
function candor_nord_portfolio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'portfolio_column' 	=> 'works-item-one-half',
				'pppage' 			=> '999',
				'filter' 			=> 'all',
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
		'post_type' => 'portfolio',
		'posts_per_page' => $pppage,
		'paged' => $paged
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'portfolio_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'portfolio_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}


	if( $filter == 'all' ){
		$cats = get_categories('taxonomy=portfolio_category');
	} else {
		$cats = get_categories('taxonomy=portfolio_category&exclude='. $filter .'&child_of='. $filter);
	}

	
	$block_query = new WP_Query( $query_args );

	ob_start();
?>


<?php  if( $portfolio_column =="fullheight" ){ ?>

<div id="works-container" class="works-container works-masonry-container clearfix white-bg">

	<?php 
		$portfolio_column=1;
		if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();
			$terms = wp_get_post_terms(get_the_ID(), 'portfolio_category' );
			$t = array();
			foreach($terms as $term) $t[] = $term->slug;
	?>
	
				
		  <section class="works-item <?php echo esc_html__($portfolio_column);?> <?php echo implode(' ', $t); $t = array(); ?> case-study-item case-study-item-0<?php echo esc_attr($portfolio_column);?> fullheight">
		   
		   <div class="valign">
		     
		            <div class="container-fluid">
		              
		                  <div class="row">
		                      <div class="col-md-6 col-md-offset-3 text-center header-caps">
		                        <h1 class="black font2"><?php the_title();?></h1>
		                        <a class="btn btn-nord btn-nord-dark" href="<?php the_permalink();?>"><?php echo esc_html__('View Details','nord');?></a>
		                      </div>
		                  </div>

		            </div>
		   </div>

		  </section>

	<?php $portfolio_column++; } } 
	wp_reset_postdata();
	wp_reset_query();
	?>

</div>



  <!-- CASE STUDIES MODULE - BG SLIDER SCRIPT  -->
  <script>
jQuery(document).ready(function($){

	<?php 
		$portfolio_column=1;
		if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();

		global $post;
		$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		$portfolio_slider_images       = rwmb_meta( '_nord_portfolio_slider_images','type=image_advanced');
	?>

    // CASE STUDY 0<?php echo esc_attr($portfolio_column);?>

    jQuery('.case-study-item-0<?php echo esc_attr($portfolio_column);?>').backstretch([
    
    	<?php foreach( $portfolio_slider_images as $slide ){ ?>
    		<?php $images = wp_get_attachment_image_src( $slide['ID'], 'full' ); ?>
        	"<?php echo  esc_url( $images[0] ); ?>",
        <?php } ?>

    ], {duration: 1500, fade: 750});

	<?php $portfolio_column++; } } 
	wp_reset_postdata();
	wp_reset_query();
	?>

});


  </script>


<?php } else{?>

<div id="works-container" class="works-container works-masonry-container clearfix white-bg">
	    	
		<?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();

			global $post;
			$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
			$portfolio_categories = get_the_term_list( $post->ID, 'portfolio_category', ' ', ' ' );
			$portfolio_cat = get_the_term_list( $post->ID, 'portfolio_category', ' ', ', ' );

			$terms = wp_get_post_terms(get_the_ID(), 'portfolio_category' );
			$t = array();
			foreach($terms as $term) $t[] = $term->slug;
		?>
						 

            <!-- start : works-item -->
            <div class="works-item <?php echo esc_html__($portfolio_column);?> <?php echo implode(' ', $t); $t = array(); ?>">
                <img data-no-retina alt="<?php the_title_attribute();?>" title="<?php the_title_attribute();?>" class="img-responsive" src="<?php echo $url[0];?>"/>
                    <a href="<?php the_permalink();?>">
                        <div class="works-item-inner">
                            <h3><span class="white font2bold"><?php the_title();?></span></h3>
                            <p><span class="white font1"><?php echo strip_tags( $portfolio_cat ); ?></span></p>
                        </div>
                    </a>
            </div>
            <!-- end : works-item -->		

		<?php } } ?>

	</div>
	<!-- end : works-container -->
<?php } ?>



<?php

	wp_reset_postdata();
	wp_reset_query();
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'nord_portfolio', 'candor_nord_portfolio_shortcode' );

/**
 * The VC Functions
 */
function candor_nord_portfolio_shortcode_vc() {

	$portfolio_column_types = nord_get_portfolio_columng_type();

	vc_map( 
		array(
			"icon" => 'nord-vc-block',
			"name" => esc_html__("Portfolio", 'nord'),
			"base" => "nord_portfolio",
			"category" => esc_html__('NORD WP Theme', 'nord'),
			'description' => 'Show Masonry Blog Posts with layout options.',
			"params" => array(
				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__("Show How Many Posts?", 'nord'),
					"param_name" 	=> "pppage",
					"value" 		=> '6'
				),
				array(
					"type" 			=> "dropdown",
					"heading" 		=> __("Column Type", 'nord'),
					"param_name" 	=> "portfolio_column",
					"value" 		=> $portfolio_column_types
				),

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_nord_portfolio_shortcode_vc');