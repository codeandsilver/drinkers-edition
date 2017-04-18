<?php
/**
 * The template for displaying single deals posts type
 *
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<article id="post-1" class="post-1 post type-post status-publish format-standard hentry category-uncategorized">
				
		<?php
							     
			   
			        while ( have_posts() ) : the_post(); ?>
			            <div class="deals-wrap row row-eq-height">
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
								        $time_check = date("i", strtotime($time_military));
									
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
			                    	<?php $categories = get_the_category(); 
						if ( ! empty( $categories ) ) {
						    echo esc_html( 'Type: ' . $categories[0]->name );   
						} ?>
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
			
			    wp_reset_postdata(); ?>
			</article>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
