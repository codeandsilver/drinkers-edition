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
		$start_time = $_GET["start_time"];
		$end_time = $_GET["end_time"];
		
		$orderdate = explode('-', $orderdate);
		$month = (int)$orderdate[1];
		$day   = (int)$orderdate[0];
		$year  = $orderdate[2];
	
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
						
			<article id="post-1" class="post-1 post type-post status-publish format-standard hentry category-uncategorized">		
		 
			
						
			<?php 	
			
			date_default_timezone_set('America/Chicago');
			$currenttime = date('h:i:s:u');
			list($hrs,$mins,$secs,$msecs) = split(':',$currenttime);
			echo '<p style="margin:5px 10px;">Current Time: ' . $hrs . ':' . $mins . '</p>';
			
			$dow_numeric = date('w');
			$dow_text = date('l', strtotime("Sunday +{$dow_numeric} days"));
			echo '<p style="margin:5px 10px 20px;">Day of the Week: ' . $dow_text . '</p>';
			$dow_text = strtolower($dow_text);
			
			$current_time = 24;
			
			
			echo '<h1 id="header-title">Happy Hour Deals</h1>';
			
			echo '<br>'.$start_time;
			
			   
					
			echo "<h3 style='margin:20px 0px; text-align:center;'>Happy Hour Now</h3>";

			  $loop = new WP_Query( array( 'post_type' => array('happy-hours', 'deals', 'facebook-deals'),
						    'paged' => $paged, 
						    'cat' => $deal_cat, 
						    'date_query' => array(
									array(
										'year'  => $year,
										'month' => $month,
										'day'   => $day,
									     ),
									array(
										'hour'      => $deal_time,
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
							       'value' => $current_time,
							       'compare' => '<='
							     ),
							     array(
							       'key' => 'end_time',
							       'value' => $current_time,
							       'compare' => '>='
							     ),
							     array(
							       'key' => '_deal_day',
							       'value' => $dow_text,
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
						<div class="deal-day">
			                    	<?php $deal_day = get_post_meta( get_the_ID(), '_deal_day', true );
			                    		if (count($deal_day) === 1) {
								    echo 'Day: ';
								    foreach ($deal_day as $day) {
				                    			echo $day;
				                    			}
								} else {
			                    		echo 'Days: ';			                    		
			                    		foreach ($deal_day as $day) {
			                    			$result .= $day . ', ';
			                    			}
			                    			$result = rtrim($result,', ');
								echo $result;
			                    		}
			                    		unset($result);
			                    	 ?>
						</div>
						<div class="deal-time">
						<?php   $time_number = get_post_meta( get_the_ID(), 'start_time', true );
						        $time_military = $time_number . ':00';
							$time_in_12_hour_format = date("g:i a", strtotime($time_military));
							
							$time_number_end = get_post_meta( get_the_ID(), 'end_time', true );
							if ($time_number_end > 23 ) { $time_number_end = $time_number_end - 24;}
							$time_military_end = $time_number_end . ':00';
						      	$time_in_12_hour_end_format = date("g:i a", strtotime($time_military_end));
						      	
							echo 'Time: ' . $time_in_12_hour_format . ' - ' . $time_in_12_hour_end_format;							
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
			     
			    
			    
			    echo "<h3 style='margin:20px 0px; text-align:center;'>Happy Hour Soon</h3>";

			  $loop_2 = new WP_Query( array( 'post_type' => array('happy-hours', 'deals', 'facebook-deals'),
						    'paged' => $paged, 
						    'cat' => $deal_cat,
						    'order' => 'ASC',
						    'orderby' => 'meta_value',
						    'meta_key' => 'start_time',
						    'date_query' => array(
									array(
										'year'  => $year,
										'month' => $month,
										'day'   => $day,
									     ),
									array(
										'hour'      => $deal_times,
										'compare'   => '>=',
									),
									array(
										'hour'      => $end_times,
										'compare'   => '<=',
									),
								),
							'meta_query' => array(							    
							     array(
							       'key' => 'start_time',
							       'value' => $current_time,
							       'compare' => '<'
							     ),
							      array(
							       'key' => '_deal_day',
							       'value' => $dow_text,
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
					     
			    if ( $loop_2->have_posts() ) :
			        while ( $loop_2->have_posts() ) : $loop_2->the_post(); ?>
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
						<div class="deal-day">
			                    	<?php $deal_day = get_post_meta( get_the_ID(), '_deal_day', true );
			                    		if (count($deal_day) === 1) {
								    echo 'Day: ';
								    foreach ($deal_day as $day) {
				                    			echo $day;
				                    			}
								} else {
			                    		echo 'Days: ';			                    		
			                    		foreach ($deal_day as $day) {
			                    			$result .= $day . ', ';
			                    			}
			                    			$result = rtrim($result,', ');
								echo $result;
			                    		} 
			                    		unset($result);
			                    	 ?>
						</div>
						<div class="deal-time">
						<?php   $time_number = get_post_meta( get_the_ID(), 'start_time', true );
						        $time_military = $time_number . ':00';
							$time_in_12_hour_format = date("g:i a", strtotime($time_military));
							
							$time_number_end = get_post_meta( get_the_ID(), 'end_time', true );
							if ($time_number_end > 23 ) { $time_number_end = $time_number_end - 24;}
							$time_military_end = $time_number_end . ':00';
						      	$time_in_12_hour_end_format = date("g:i a", strtotime($time_military_end));
						      	
							echo 'Time: ' . $time_in_12_hour_format . ' - ' . $time_in_12_hour_end_format;							
						?>
						</div>
			                </div>
			            </div>
			        <?php endwhile;
			        if (  $loop_2->max_num_pages > 1 ) : ?>
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
