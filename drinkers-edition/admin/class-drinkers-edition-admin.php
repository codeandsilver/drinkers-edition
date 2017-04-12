<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 * @author     Your Name <email@example.com>
 */
class Drinkers_Edition_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/drinkers-edition-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/drinkers-edition-admin.js', array( 'jquery' ), $this->version, false );

	}
	
		/**
		 * Register Deals post type.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_post_type
		 */
	public function codex_deals_init() {
			$labels = array(
				'name'               => _x( 'My Deals', 'post type general name', 'drinkers-edition' ),
				'singular_name'      => _x( 'My Deal', 'post type singular name', 'drinkers-edition' ),
				'menu_name'          => _x( 'My Deals', 'admin menu', 'drinkers-edition' ),
				'name_admin_bar'     => _x( 'My Deal', 'add new on admin bar', 'drinkers-edition' ),
				'add_new'            => _x( 'Add New', 'deal', 'drinkers-edition' ),
				'add_new_item'       => __( 'Add New My Deal', 'drinkers-edition' ),
				'new_item'           => __( 'New My Deal', 'drinkers-edition' ),
				'edit_item'          => __( 'Edit My Deal', 'drinkers-edition' ),
				'view_item'          => __( 'View My Deal', 'drinkers-edition' ),
				'all_items'          => __( 'All My Deal', 'drinkers-edition' ),
				'search_items'       => __( 'Search My Deals', 'drinkers-edition' ),
				'parent_item_colon'  => __( 'Parent My Deals:', 'drinkers-edition' ),
				'not_found'          => __( 'No my deals found.', 'drinkers-edition' ),
				'not_found_in_trash' => __( 'No my deals found in Trash.', 'drinkers-edition' )
			);
		
			$args = array(
				'labels'             => $labels,
		                'description'        => __( 'Description.', 'drinkers-edition' ),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'deals' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'taxonomies'  	     => array( 'category' ),
				'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' )
			);
		
			register_post_type( 'deals', $args );
		}
		
	public function codex_happy_hours_init() {
			$labels = array(
				'name'               => _x( 'Happy Hours', 'post type general name', 'drinkers-edition' ),
				'singular_name'      => _x( 'Happy Hour', 'post type singular name', 'drinkers-edition' ),
				'menu_name'          => _x( 'Happy Hours', 'admin menu', 'drinkers-edition' ),
				'name_admin_bar'     => _x( 'Happy Hour', 'add new on admin bar', 'drinkers-edition' ),
				'add_new'            => _x( 'Add Happy Hour', 'happ-hour', 'drinkers-edition' ),
				'add_new_item'       => __( 'Add New Happy Hour', 'drinkers-edition' ),
				'new_item'           => __( 'New Happy Hour', 'drinkers-edition' ),
				'edit_item'          => __( 'Edit Happy Hour', 'drinkers-edition' ),
				'view_item'          => __( 'View Happy Hour', 'drinkers-edition' ),
				'all_items'          => __( 'All Happy Hours', 'drinkers-edition' ),
				'search_items'       => __( 'Search Happy Hours', 'drinkers-edition' ),
				'parent_item_colon'  => __( 'Parent Happy Hours:', 'drinkers-edition' ),
				'not_found'          => __( 'No happy hours found.', 'drinkers-edition' ),
				'not_found_in_trash' => __( 'No happy hours found in Trash.', 'drinkers-edition' )
			);
		
			$args = array(
				'labels'             => $labels,
		                'description'        => __( 'Description.', 'drinkers-edition' ),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'happy-hours' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'taxonomies'  	     => array( 'category' ),
				'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' )
			);
		
			register_post_type( 'happy-hours', $args );
	}
	
	public function codex_facebook_deals_init() {
			$labels = array(
				'name'               => _x( 'Facebook Deals', 'post type general name', 'drinkers-edition' ),
				'singular_name'      => _x( 'Facebook Deals', 'post type singular name', 'drinkers-edition' ),
				'menu_name'          => _x( 'Facebook Deals', 'admin menu', 'drinkers-edition' ),
				'name_admin_bar'     => _x( 'Facebook Deals', 'add new on admin bar', 'drinkers-edition' ),
				'add_new'            => _x( 'Add Facebook Deal', 'happ-hour', 'drinkers-edition' ),
				'add_new_item'       => __( 'Add New Facebook Deal', 'drinkers-edition' ),
				'new_item'           => __( 'New Facebook Deal', 'drinkers-edition' ),
				'edit_item'          => __( 'Edit Facebook Deal', 'drinkers-edition' ),
				'view_item'          => __( 'View Facebook Deal', 'drinkers-edition' ),
				'all_items'          => __( 'All Facebook Deals', 'drinkers-edition' ),
				'search_items'       => __( 'Search Facebook Deals', 'drinkers-edition' ),
				'parent_item_colon'  => __( 'Parent Facebook Deals:', 'drinkers-edition' ),
				'not_found'          => __( 'No facebook deals found.', 'drinkers-edition' ),
				'not_found_in_trash' => __( 'No facebook deals found in Trash.', 'drinkers-edition' )
			);
		
			$args = array(
				'labels'             => $labels,
		                'description'        => __( 'Description.', 'drinkers-edition' ),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'facebook-deals' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'taxonomies'  	     => array( 'category' ),
				'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' )
			);
		
			register_post_type( 'facebook-deals', $args );
	}	
		
	//Register Meta Box
	public function deal_info_register_meta_box() {
		    add_meta_box( 'deal_info-box-id', esc_html__( 'Deal Information', 'deal-information' ), array( $this, 'deal_info_meta_box_callback'), array( $this, 'deals', 'happy-hours', 'facebook-deals' ), 'normal', 'high' );
	}
		
		 
		//Add field
	public	function deal_info_meta_box_callback( $meta_id ) {
	
		    wp_nonce_field( 'deal_info_meta_box', 'deal_info_meta_box_nonce' );
		 
		    		    
		    $outline = NEW Drinkers_Edition_Admin_forms();
		    $outline->selected = get_post_meta( $meta_id->ID, 'start_time', true );
		    $outline->select_name ='start_time';
		    $outline->select_label_text = 'Deal Start Time';
		    $outline->select_textdomain = 'deal-start-time';
		    $outline->select_options = array('--:--'=>' ', '12:00 AM'=>'0', '1:00 AM'=>'1', '2:00 AM'=>'2', '3:00 AM'=>'3', '4:00 AM'=>'4', '5:00 AM'=>'5', '6:00 AM'=>'6', '7:00 AM'=>'7', '8:00 AM'=>'8', '9:00 AM'=>'9', '10:00 AM'=>'10', '11:00 AM'=>'11', '12:00 PM'=>'12', '1:00 PM'=>'13', '2:00 PM'=>'14', '3:00 PM'=>'15', '4:00 PM'=>'16', '5:00 PM'=>'17', '6:00 PM'=>'18', '7:00 PM'=>'19', '8:00 PM'=>'20', '9:00 PM'=>'21', '10:00 PM'=>'22', '11:00 PM'=>'23');
		    
		    echo $outline->hours_select();
		    
		    echo '</br></br>';
		    
		    $outline_end = NEW Drinkers_Edition_Admin_forms();
		    $outline_end->selected = get_post_meta( $meta_id->ID, 'end_time', true );
		    $outline_end->select_name ='end_time';
		    $outline_end->select_label_text = 'Deal End Time';		
		    $outline_end->select_textdomain = 'deal-end-time';
		    $outline_end->select_options = array('--:--'=>' ', '12:00 AM'=>'0', '1:00 AM'=>'1', '2:00 AM'=>'2', '3:00 AM'=>'3', '4:00 AM'=>'4', '5:00 AM'=>'5', '6:00 AM'=>'6', '7:00 AM'=>'7', '8:00 AM'=>'8', '9:00 AM'=>'9', '10:00 AM'=>'10', '11:00 AM'=>'11', '12:00 PM'=>'12', '1:00 PM'=>'13', '2:00 PM'=>'14', '3:00 PM'=>'15', '4:00 PM'=>'16', '5:00 PM'=>'17', '6:00 PM'=>'18', '7:00 PM'=>'19', '8:00 PM'=>'20', '9:00 PM'=>'21', '10:00 PM'=>'22', '11:00 PM'=>'23', '*12:00 AM'=>'24', '*1:00 AM'=>'25', '*2:00 AM'=>'26', '*3:00 AM'=>'27', '*4:00 AM'=>'28', '*5:00 AM'=>'29', '*6:00 AM'=>'30', '*7:00 AM'=>'31', '8:00 AM'=>'32');
		    
		    echo $outline_end->hours_select();
		    echo '</br> ( * = Next Day )';
		   		    
		    echo '</br></br>';
		    
		    $outline_happy = NEW Drinkers_Edition_Admin_forms();
		    $outline_happy->selected = get_post_meta( $meta_id->ID, 'happy_hour', true );
		    $outline_happy->select_name ='happy_hour';
		    $outline_happy->select_label_text = 'Happy Hour';
		    $outline_happy->select_textdomain = 'deal-happy-hour';
		    $outline_happy->select_options = array('--'=>' ', 'Yes'=>'1', 'No'=>'0');
		    
		    echo $outline_happy->hours_select();
		    
		    echo '</br></br>';
		    
		    $alcohol_deal = get_post_meta( $meta_id->ID, 'alcohol_deal', true );
		    
		    if (!$alcohol_deal) {$alcohol_deal= array();}
		 		 
		    echo  '<label for="alcohol-deal" class="alcohol-check" style="width:150px; display:inline-block;">'. esc_html__('Alcohol Type', 'alcohol-deal') .'</label>';
   		    ?><input type="checkbox" name="alcohol_deal[]" value="beer" <?php if (in_array('beer', $alcohol_deal)) {echo 'checked';} ?>><span style="margin-right:10px;"> Beer</span>
  		    <input type="checkbox" name="alcohol_deal[]" value="wine" <?php if (in_array('wine', $alcohol_deal)) {echo 'checked';} ?>><span style="margin-right:10px;"> Wine</span>
  		    <input type="checkbox" name="alcohol_deal[]" value="liquor" <?php if (in_array('liquor', $alcohol_deal)) {echo 'checked';} ?>><span style="margin-right:10px;"> Liquor</span>
  		    <?php
		    
		    
		    echo '</br></br>';
		    
		    $outline_food = NEW Drinkers_Edition_Admin_forms();
		    $outline_food->selected = get_post_meta( $meta_id->ID, 'food_deal', true );
		    $outline_food->select_name ='food_deal';
		    $outline_food->select_label_text = 'Food Available';
		    $outline_food->select_textdomain = 'deal-food-deal';
		    $outline_food->select_options = array('--'=>' ', 'Yes'=>'1', 'No'=>'0');
		    
		    echo $outline_food->hours_select();
		    
		    echo '</br></br>';
		    
		    $outline_deal_location = '<label for="deal_location" style="width:150px; display:inline-block;">'. esc_html__('Location', 'deal-location') .'</label>';
		    $deal_location= get_post_meta( $meta_id->ID, 'deal_location', true );
		    $outline_deal_location .= '<input type="text" name="deal_location" id="deal_location" class="deal_location" value="'. esc_attr($deal_location) .'" style="width:300px;"/>';
		    
		    $outline_neighborhood = '<label for="neighborhood" style="width:150px; display:inline-block;">'. esc_html__('Neighborhood', 'neighborhood') .'</label>';
		    $neighborhood = get_post_meta( $meta_id->ID, 'neighborhood', true );
		    $outline_neighborhood .= '<input type="text" name="neighborhood" id="neighborhood" class="neighborhood" value="'. esc_attr($neighborhood) .'" style="width:300px;"/>';
		 
		    echo $outline_deal_location;
		    echo '</br></br>';
		    echo $outline_neighborhood;
		    
		    
		    $deal_day = get_post_meta( $meta_id->ID, '_deal_day', true );
		    
		    if (!$deal_day) {$deal_day= array();}
		    
		    echo '</br></br>';
		    echo  '<label for="deal-day" class="day-check" style="width:150px; display:inline-block;">'. esc_html__('Deal Day', 'deal-day') .'</label>';
   		    ?><input type="checkbox" name="deal_day[]" value="sunday" <?php if (in_array('sunday', $deal_day)) {echo 'checked';} ?>><span style="margin-right:10px;"> Sunday</span>
  		    <input type="checkbox" name="deal_day[]" value="monday" <?php if (in_array('monday', $deal_day)) {echo 'checked';} ?>><span style="margin-right:10px;"> Monday</span>
  		    <input type="checkbox" name="deal_day[]" value="tuesday" <?php if (in_array('tuesday', $deal_day)) {echo 'checked';} ?>><span style="margin-right:10px;"> Tuesday</span>
  		    <input type="checkbox" name="deal_day[]" value="wednesday" <?php if (in_array('wednesday', $deal_day)) {echo 'checked';} ?>><span style="margin-right:10px;"> Wednesday</span>
  		    <input type="checkbox" name="deal_day[]" value="thursday" <?php if (in_array('thursday', $deal_day)) {echo 'checked';} ?>><span style="margin-right:10px;"> Thursday</span>
  		    <input type="checkbox" name="deal_day[]" value="friday" <?php if (in_array('friday', $deal_day)) {echo 'checked';} ?>><span style="margin-right:10px;"> Friday</span>
  		    <input type="checkbox" name="deal_day[]" value="saturday" <?php if (in_array('saturday', $deal_day)) {echo 'checked';} ?>><span style="margin-right:10px;"> Saturday</span>
  		    <?php  		     
  		    
	}
		
	public function save_deals_meta_box( $post_id ) {
 
	        /*
	         * We need to verify this came from the our screen and with proper authorization,
	         * because save_post can be triggered at other times.
	         */
	 
	        // Check if our nonce is set.
	        if ( ! isset( $_POST['deal_info_meta_box_nonce'] ) ) {
	            return $post_id;
	        }
	 
	        $nonce = $_POST['deal_info_meta_box_nonce'];
	 
	        // Verify that the nonce is valid.
	        if ( ! wp_verify_nonce( $nonce, 'deal_info_meta_box' ) ) {
	            return $post_id;
	        }
	 
	        /*
	         * If this is an autosave, our form has not been submitted,
	         * so we don't want to do anything.
	         */
	        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
	            return $post_id;
	        }
	 
	        // Check the user's permissions.
	        if ( 'page' == $_POST['deals'] ) {
	            if ( ! current_user_can( 'edit_page', $post_id ) ) {
	                return $post_id;
	            }
	        } else {
	            if ( ! current_user_can( 'edit_post', $post_id ) ) {
	                return $post_id;
	            }
	        }
	 
	        /* OK, it's safe for us to save the data now. */
	 
	        // Sanitize the user input.
	        $start_data = sanitize_text_field( $_POST['start_time'] );
	        $end_data = sanitize_text_field( $_POST['end_time'] );
	        $happy_data = sanitize_text_field( $_POST['happy_hour'] );
	        $food_data = sanitize_text_field( $_POST['food_deal'] );
	        $alcohol_data = $_POST['alcohol_deal'];
	        $neighborhood_data = sanitize_text_field( $_POST['neighborhood'] );
	        $location_data = sanitize_text_field( $_POST['deal_location'] );
	        $day_data = $_POST['deal_day'];
	 
	        // Update the meta field.
	        update_post_meta( $post_id, 'end_time', $end_data );
	        update_post_meta( $post_id, 'start_time', $start_data );
	        update_post_meta( $post_id, 'happy_hour', $happy_data );
	        update_post_meta( $post_id, 'food_deal', $food_data );
	        update_post_meta( $post_id, 'alcohol_deal', $alcohol_data );
	        update_post_meta( $post_id, 'neighborhood', $neighborhood_data );
	        update_post_meta( $post_id, 'deal_location', $location_data );
	        update_post_meta( $post_id, '_deal_day', $day_data );
   	}
   	
   	 	 
   	 
     	public function fontawesome_dashboard() {
   		wp_enqueue_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', '', '4.5.0', 'all');
	}

	function fontawesome_icon_dashboard() {
	   echo "<style type='text/css' media='screen'>
	   		#adminmenu .menu-icon-happy-hours div.wp-menu-image:before {
	   		font-family: Fontawesome !important;
	   		content: '\\f000' !important;
	   		font-size: 18px;
	     }
	     		#adminmenu .menu-icon-deals div.wp-menu-image:before {
	   		font-family: Fontawesome !important;
	   		content: '\\f155' !important;
	   		font-size: 18px;
	     }
	     		#adminmenu .menu-icon-facebook-deals div.wp-menu-image:before {
	   		font-family: Fontawesome !important;
	   		content: '\\f09a' !important;
	   		font-size: 18px;
	     }
	     	</style>";
	}

 
		
}
class Drinkers_Edition_Admin_forms {

	public $select_name;
	public $select_label_text;
	public $select_textdomain;
	public $selected;
	public $select_values;
	public $selections;
	public $select_options;
		

	public function hours_select() {
	
		$select_name = $this->select_name;
		$select_label_text = $this->select_label_text;
		$select_textdomain = $this->select_textdomain;
		$selected = $this->selected;
		$select_options = $this->select_options;   		
   		
   		echo '<label for="'.$select_name.'" class="select-options">'. esc_html__($select_label_text, $select_textdomain) .'</label>';
   		echo  '<select name="'.$select_name.'" id="'.$select_textdomain.'">';
   			foreach ($select_options as $option => $value) {
   				if ( $selected == $value ) {$select_ed = 'selected = "selected"';}
	   			$i = 1;
				echo  '<option value="'.$value.'" '.$select_ed.'>'.$option.'</option>';
				$i++;
				unset($select_ed);
			  }			  
		echo	'</select>';
   		      		  		
   	}
}