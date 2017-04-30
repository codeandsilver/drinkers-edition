<?php
/**
 * The template for displaying all deals posts type
 *
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<?php
		$deal_cat = $_GET["cat"];
		$deal_time = $_GET["deal-time"];
		$happy_hour = $_GET["happy-hour"];
		$my_deals = $_GET["my-deals"];
		$orderdate = $_GET["date"];
		
		$orderdate = explode('-', $orderdate);
		$month = (int)$orderdate[1];
		$day   = (int)$orderdate[0];
		$year  = $orderdate[2];
	
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<article id="post-1" class="post-1 post type-post status-publish format-standard hentry category-uncategorized">
			
			<?php if ( is_user_logged_in() ) { ?>		
		 
			<h3 style='margin:20px 0px; text-align:center;'>Deals You’ve Purchased</h3>
			
			<div id="purchased-deals" class="deals-list">
			<?php echo do_shortcode( "[woocommerce-payperdeal template='purchased']" ); ?>
				
			</div>
			
			<?php }?>
			
			<h3 style='margin:20px 0px; text-align:center;'>Available Deals</h3>
			
			<div id="all-deals" class="deals-list">
			<?php echo do_shortcode( "[woocommerce-payperdeal template='all']" ); ?>
			</div>
			
			<h3 style='margin:20px 0px; text-align:center;'>Facebook Deals</h3>
			

		<?php   $loop = new WP_Query( array( 'post_type' => 'facebook-deals', 
						    'paged' => $paged, 
						    'cat' => $deal_cat, 
						    'date_query' => array(
									array(
										'year'  => $year,
										'month' => $month,
										'day'   => $day,
									     ),
									array(
										'hour'      => $start_time,
										'compare'   => '>=',
									),
									array(
										'hour'      => $end_time,
										'compare'   => '<=',
									),
								),
							'meta_query' => array(
							     array(
							       'key' => 'start_time',
							       'value' => $deal_time,
							       'compare' => 'LIKE'
							     ),							
							     array(
							       'key' => 'happy_hour',
							       'value' => $happy_hour,
							       'compare' => 'LIKE'
							     )
							   ),
						 ) 
					     );
					     
			    if ( $loop->have_posts() ) :
			        while ( $loop->have_posts() ) : $loop->the_post(); ?>
			            <div class="deals-wrap row">
			                <?php if ( has_post_thumbnail() ) { ?>
			                    <div class="my-deal-image col-md-2">
			                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
			                    </div>
			                <?php } ?>
			                <div class="my-deal-info col-md-10">
			                	<div class="deal-title">
			                    		<h2><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
			                    	</div>			                    	
			                </div>
			            </div>
			        <?php endwhile;
			        if (  $loop->max_num_pages > 1 ) : ?>
			            <div id="nav-below" class="navigation">
			                <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Previous', 'domain' ) ); ?></div>
			                <div class="nav-next"><?php previous_posts_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'domain' ) ); ?></div>
			            </div>
			        <?php endif;
			    endif;
			    wp_reset_postdata(); 
			    
			if ( is_user_logged_in() ) {?>
			
			<h3 style='margin:20px 0px; text-align:center;'>Redeemed Deals</h3>
			
			<div id="all-deals" class="deals-list">	
			<?php echo do_shortcode( "[woocommerce-payperdeal template='deal-redeemed']" ); ?>
			</div>
			    
			<?php }?>
			
			</article>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
