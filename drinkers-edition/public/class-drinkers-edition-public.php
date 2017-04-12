<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 * @author     Your Name <email@example.com>
 */
class Drinkers_Edition_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/drinkers-edition-public.css', array(), $this->version, 'all' );
		
	}
	
	public function enqueue_styles_bootstrap() {
	
		wp_enqueue_style( 'bootstrap-min-drinkers-plugin', plugin_dir_url( __FILE__ ) . 'css/bootstrap/css/bootstrap.min.css', array(), '' );
	
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/drinkers-edition-public.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Return path to deals post type archive template.
	 *
	 * @since    1.0.0
	 */
	public function deals_template_archive( $archive_template ) {
     		global $post;
		
		     if ( is_post_type_archive ( 'deals' ) ) {
		          $archive_template = dirname( __FILE__ ) . '/templates/archive-deals.php';
		     } else if ( is_post_type_archive ( 'happy-hours' ) ) {
		          $archive_template = dirname( __FILE__ ) . '/templates/archive-happy-hours.php';
		     } else if ( is_post_type_archive ( 'happy-hours' ) ) {
		          $archive_template = dirname( __FILE__ ) . '/templates/archive-facebook-deals.php';
		     }
		     return $archive_template;
	}
	
	/**
	 * Return path to Deals post type template.
	 *
	 * @since    1.0.0
	 */
	public function deals_template_single( $single_template ) {
     		global $post;
		
		     if ( is_singular( 'deals' ) ) {
		          $single_template = dirname( __FILE__ ) . '/templates/single-deals.php';
		     } else if ( is_singular ( 'happy-hours' ) ) {
		          $single_template = dirname( __FILE__ ) . '/templates/single-happy-hours.php';
		     } else if ( is_singular ( 'facebook-deals' ) ) {
		          $single_template = dirname( __FILE__ ) . '/templates/single-facebook-deals.php';
		     }
		     return $single_template;
	}
	
	public function custom_deals_filter() { ?>
	
		<p style="text-align: center;"><a href="http://codeandsilver.com/drinkers/happy-hours/?happy-hour=1">Happy Hour</a></p>
		<p style="text-align: center;"><a href="http://codeandsilver.com/drinkers/deals">My Deals</a></p>
	
	
		<form>
		
		<?php 
		$happy_hour = $_GET["happy-hour"];
		if ($happy_hour == 1) { ?>
		<input type="hidden" name="happy-hour" value="<?php echo $_GET["happy-hour"]; ?>">
		<?php } ?>
					
		<select name="deal-time">
		  <option value="">Deal Time</option>
		  <option value="15">3:00pm</option>
		  <option value="16">4:00pm</option>
		  <option value="17">5:00pm</option>
		  <option value="18">6:00pm</option>
		</select></br></br>
		
		<input id="date" name="date" placeholder="Enter Date"/></br></br>
		
		<?php $args = array(
	        'show_option_all'    => 'Deal Type',
	        'show_option_none'   => '',
	        'orderby'            => 'ID',
	        'order'              => 'ASC',
	        'show_count'         => 1,
	        'hide_empty'         => 0,
	        'child_of'           => 0,
	        'exclude'            => '1,5',
	        'echo'               => 1,
	        'selected'           => 0,
	        'hierarchical'       => 0,
	        'name'               => 'cat',
	        'id'                 => '',
	        'class'              => 'postform',
	        'depth'              => 1,
	        'tab_index'          => 0,
	        'taxonomy'           => 'category',
	        'hide_if_empty'      => false,
	             ); ?>
		<?php wp_dropdown_categories( $args ); ?></br></br>
		
		
		<input type="submit" vale="Get Deals">
		</form><?php
	
	}
	
	/**
	 * Custom search form for deals post type.
	 *
	 * @since    1.0.0
	 */
	public function add_datepicker_in_footer() { ?>
	
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  		
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script type="text/javascript">
		jQuery(document).ready(function(){
		    jQuery('#date').datepicker({
		        dateFormat: 'dd-mm-yy'
		    });
		});
		</script><?php		
	}
		

}
