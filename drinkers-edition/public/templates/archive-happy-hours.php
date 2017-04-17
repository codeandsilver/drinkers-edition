<?php
/**
 * The template for displaying all deals posts type
 *
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<script>
	var userid = <?php echo get_current_user_id(); ?>
	</script>
		
	<?php
		$deal_cat = $_GET["cat"];
		$deal_time = $_GET["deal-time"];
		$happy_hour = $_GET["happy-hour"];
		$my_deals = $_GET["my-deals"];
		$orderdate = $_GET["date"];
		$start_time = $_GET["start_time"];
		$end_time = $_GET["end_time"];
		$hearted_deal = $_GET["hearted-deal"];
		
		$orderdate = explode('-', $orderdate);
		$month = (int)$orderdate[1];
		$day   = (int)$orderdate[0];
		$year  = $orderdate[2];
		
		if ($hearted_deal == 1) {
		$hearted_deals = get_current_user_id();
		}
		
	
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">		
						
			<article id="post-1" class="post-1 post type-post status-publish format-standard hentry category-uncategorized">
						
			<?php 	
			
			date_default_timezone_set('America/Chicago');
			$currenttime = date('h:i:s:u');
			list($hrs,$mins,$secs,$msecs) = split(':',$currenttime);
			echo '<p style="margin:5px 10px;">Current Time: ' . $hrs . ':' . $mins . '</p>';
			
			$adjusted_hrs = $hrs + 7;
			
			
			If ($hrs >= 1 && $hrs <= 5 ) {$adjusted_hrs = $hrs + 19;}
			$current_time = $adjusted_hrs . $mins;
			
			date_default_timezone_set('Pacific/Honolulu');
			$dow_numeric = date('w');
			$dow_text = date('l', strtotime("Sunday +{$dow_numeric} days"));
			echo '<p style="margin:5px 10px 20px;">Day of the Week: ' . $dow_text . '</p>';
			$dow_text = strtolower($dow_text);
			
			
			echo '<h1 id="header-title">Happy Hour Deals</h1>';
			
			//echo '<br>'.$current_time;
			
			   
					
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
			                    	
			                    	<?php $id = get_the_ID(); 
			                    	$hearted = get_post_meta( get_the_ID(), 'hearted', false );
			                    	$current_user_id = get_current_user_id();
			                    	?>
			                    	
			                    	<div class="deal-heart">
			                    	<?php if (in_array($current_user_id, $hearted)) { ?>
			                    	<button id="hearted-<?php echo get_the_ID(); ?>" class="hearted" data-postid="<?php echo get_the_ID(); ?>">
			                    	<i class="fa fa-heart" aria-hidden="true"></i></button>	
			                    	<?php } else { ?>
			                    	<button id="heart-<?php echo get_the_ID(); ?>" class="heart" data-postid="<?php echo get_the_ID(); ?>">
			                    	<i class="fa fa-heart" aria-hidden="true"></i></button>	<?php } ?>		                    	
			                    	</div>
			                    				                    	                  	
			                    	<div class="deal-description">
			                    	
				                    	<?php 
				                    	$alcohol_deal = get_post_meta( get_the_ID(), 'alcohol_deal', true );
				                    	$alcohol_deal_detail = get_post_meta( get_the_ID(), 'alcohol_deal_detail', true );
				                    	$food_deal = get_post_meta( get_the_ID(), 'food_deal', true );
				                    	$food_deal_detail = get_post_meta( get_the_ID(), 'food_deal_detail', true );
				                    	$deal_website = get_post_meta( get_the_ID(), 'website', true );
				                    	
				                    	if (!empty($alcohol_deal)) { ?>				              
				                    	<h4><b><i class="fa fa-glass fa-2x"></i>  Drink Specials</b></h4>				                    	
				                    	
				                    	<div id="alcohol-detail">				                    	
				                    	<?php echo $alcohol_deal_detail; ?>
				                    	</div>
				                    	
				                    	<?php } 
				                    	
				                    	if ($food_deal == 1) { ?>				              
				                    	<h4><b><i class="fa fa-cutlery fa-2x"></i>  Food Specials</b></h4>
				                    	
				                    	
				                    	<div id="alcohol-detail">				                    	
				                    	<?php echo $food_deal_detail; ?>
				                    	</div>
				                    	
				                    	<?php } ?>
				                    	
				                    	<div class="deal-time">
								<h5><b>
								<?php   $time_number = get_post_meta( get_the_ID(), 'start_time', true );
								        $time_military = $time_number + 500;
								        $time_check = date("i", strtotime($time_number));
								        
								        if ($time_number >= 2000 ) { $time_number = $time_number - 1900; 
									$time_military = $time_number;
									
									$time_military = str_pad($time_number, 4, '0', STR_PAD_LEFT);
									} else { $time_military = $time_number + 500; }
									
									if ($time_number < 1900 ) {
									
										if ($time_check == 30){
										 $time_in_12_hour_format = date("g:i", strtotime($time_military));
										} else { $time_in_12_hour_format = date("g", strtotime($time_military));}
									
									
								      	} else {
								      	if ($time_check == 30){
										 $time_in_12_hour_format = date("g:i a", strtotime($time_military));
										 } else {
									      	$time_in_12_hour_format = date("g a", strtotime($time_military));
									      	}
									      }
									
									$time_number_end = get_post_meta( get_the_ID(), 'end_time', true );
									$time_check_end = date("i", strtotime($time_number_end));
																		
									if ($time_number_end >= 2000 ) { $time_number_end = $time_number_end - 1900; 
									$time_military_end = $time_number_end;
									
									$time_military_end = str_pad($time_number_end, 4, '0', STR_PAD_LEFT);
									} else { $time_military_end = $time_number_end + 500; }
																
									//Add leading 0 for military time
									if ($time_number_end > 1900 ) {
									
										if ($time_check_end == 30){
										 $time_in_12_hour_end_format = date("g:i", strtotime($time_military_end));
										} else { $time_in_12_hour_end_format = date("g", strtotime($time_military_end));}									
									
								      	} else {
								      	
								      		if ($time_check_end == 30){
										 $time_in_12_hour_end_format = date("g:i a", strtotime($time_military_end));
										 } else {
									      	$time_in_12_hour_end_format = date("g a", strtotime($time_military_end));
									      	}
								      	}
								      	
								      	echo 'Time: ' . $time_in_12_hour_format . ' - ' . $time_in_12_hour_end_format;							
								?>
								</b></h5>
							</div>
				                    	
				                    	<div id="deal-website">				                    	
				                    	<a href="<?php echo $deal_website; ?>"><span style="font-weight: 400;">Visit Website</span></a>
				                    	</div> 
			                    	
			                    		<?php the_content(); ?>
			                    		
			                    	</div>
			                    	<div class="deal-type">
			                    	<!-- <?php $categories = get_the_category(); 
						if ( ! empty( $categories ) ) {
						   echo esc_html( 'Type: ' . $categories[0]->name );   
						} ?> -->
						</div>
						<div class="deal-day">
			                    	<!-- <?php $deal_day = get_post_meta( get_the_ID(), '_deal_day', true );
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
			                    	 ?> -->
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
							       'compare' => '>'
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
			                    	
			                    	<?php $id = get_the_ID(); 
			                    	$hearted = get_post_meta( get_the_ID(), 'hearted', false );
			                    	$current_user_id = get_current_user_id();
			                    	?>
			                    	
			                    	<div class="deal-heart">
			                    	<?php if (in_array($current_user_id, $hearted)) { ?>
			                    	<button id="hearted-<?php echo get_the_ID(); ?>" class="hearted" data-postid="<?php echo get_the_ID(); ?>">
			                    	<i class="fa fa-heart" aria-hidden="true"></i></button>	
			                    	<?php } else { ?>
			                    	<button id="heart-<?php echo get_the_ID(); ?>" class="heart" data-postid="<?php echo get_the_ID(); ?>">
			                    	<i class="fa fa-heart" aria-hidden="true"></i></button>	<?php } ?>		                    	
			                    	</div>
			                    				                    	                  	
			                    	<div class="deal-description">
			                    	
				                    	<?php 
				                    	$alcohol_deal = get_post_meta( get_the_ID(), 'alcohol_deal', true );
				                    	$alcohol_deal_detail = get_post_meta( get_the_ID(), 'alcohol_deal_detail', true );
				                    	$food_deal = get_post_meta( get_the_ID(), 'food_deal', true );
				                    	$food_deal_detail = get_post_meta( get_the_ID(), 'food_deal_detail', true );
				                    	$deal_website = get_post_meta( get_the_ID(), 'website', true );
				                    	
				                    	if (!empty($alcohol_deal)) { ?>				              
				                    	<h4><b><i class="fa fa-glass fa-2x"></i>  Drink Specials</b></h4>				                    	
				                    	
				                    	<div id="alcohol-detail">				                    	
				                    	<?php echo $alcohol_deal_detail; ?>
				                    	</div>
				                    	
				                    	<?php } 
				                    	
				                    	if ($food_deal == 1) { ?>				              
				                    	<h4><b><i class="fa fa-cutlery fa-2x"></i>  Food Specials</b></h4>
				                    	
				                    	
				                    	<div id="alcohol-detail">				                    	
				                    	<?php echo $food_deal_detail; ?>
				                    	</div>
				                    	
				                    	<?php } ?>
				                    	
				                    	<div class="deal-time">
								<h5><b>
								<?php   $time_number = get_post_meta( get_the_ID(), 'start_time', true );
								        $time_military = $time_number + 500;
								        $time_check = date("i", strtotime($time_number));
								        
								        if ($time_number >= 2000 ) { $time_number = $time_number - 1900; 
									$time_military = $time_number;
									
									$time_military = str_pad($time_number, 4, '0', STR_PAD_LEFT);
									} else { $time_military = $time_number + 500; }
									
									if ($time_number < 1900 ) {
									
										if ($time_check == 30){
										 $time_in_12_hour_format = date("g:i ", strtotime($time_military));
										} else { $time_in_12_hour_format = date("g", strtotime($time_military));}
									
									
								      	} else {
								      	if ($time_check == 30){
										 $time_in_12_hour_format = date("g:i a", strtotime($time_military));
										 } else {
									      	$time_in_12_hour_format = date("g a", strtotime($time_military));
									      	}
									      }
									
									$time_number_end = get_post_meta( get_the_ID(), 'end_time', true );
									$time_check_end = date("i", strtotime($time_number_end));
																		
									if ($time_number_end >= 2000 ) { $time_number_end = $time_number_end - 1900; 
									$time_military_end = $time_number_end;
									
									$time_military_end = str_pad($time_number_end, 4, '0', STR_PAD_LEFT);
									} else { $time_military_end = $time_number_end + 500; }
																
									//Add leading 0 for military time
									if ($time_number_end > 1900 ) {
									
										if ($time_check_end == 30){
										 $time_in_12_hour_end_format = date("g:i ", strtotime($time_military_end));
										} else { $time_in_12_hour_end_format = date("g", strtotime($time_military_end));}									
									
								      	} else {
								      	
								      		if ($time_check_end == 30){
										 $time_in_12_hour_end_format = date("g:i a", strtotime($time_military_end));
										 } else {
									      	$time_in_12_hour_end_format = date("g a", strtotime($time_military_end));
									      	}
								      	}
								      	
								      	echo 'Time: ' . $time_in_12_hour_format . ' - ' . $time_in_12_hour_end_format;							
								?>
								</b></h5>
							</div>
				                    	
				                    	<div id="deal-website">				                    	
				                    	<a href="<?php echo $deal_website; ?>"><span style="font-weight: 400;">Visit Website</span></a>
				                    	</div> 
			                    	
			                    		<?php the_content(); ?>
			                    		
			                    	</div>
			                    	<div class="deal-type">
			                    	<!-- <?php $categories = get_the_category(); 
						if ( ! empty( $categories ) ) {
						   echo esc_html( 'Type: ' . $categories[0]->name );   
						} ?> -->
						</div>
						<div class="deal-day">
			                    	<!-- <?php $deal_day = get_post_meta( get_the_ID(), '_deal_day', true );
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
			                    	 ?> -->
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
