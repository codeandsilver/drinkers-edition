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
		 
			<?php if ($happy_hour == 1) {
				echo '<h1 id="header-title">Happy Hour Deals</h1>';			
			} elseif ($my_deals == 1){
				echo '<h1 id="header-title">My Deals</h1>';
			}?>

		<?php   $loop = new WP_Query( array( 'post_type' => 'deals', 
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
			                    <div class="deal-image col-md-6">
			                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
			                    </div>
			                <?php } ?>
			                <div class="deal-info col-md-6">
			                	<div class="deal-title">
			                    		<h2><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
			                    	</div>
			                    	<div class="deal-description">
			                    		<?php the_content(); ?>
			                    	</div>
			                    	<div class="deal-type">
			                    	<?php $categories = get_the_category(); 
						if ( ! empty( $categories ) ) {
						    echo esc_html( 'Type: ' . $categories[0]->name );   
						} ?>
						</div>
						<div class="deal-date">
			                    	Deal Date: <?php echo get_the_date( 'F j, Y' ); ?>
						</div>
						<div class="deal-time">
						<?php   $time_number = get_post_meta( get_the_ID(), 'start_time', true );
						        $time_military = $time_number . ':00';
							$time_in_12_hour_format = date("g:i a", strtotime($time_military));
							echo 'Deal Time: ' . $time_in_12_hour_format;
						?>
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
			    wp_reset_postdata(); ?>
			</article>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>