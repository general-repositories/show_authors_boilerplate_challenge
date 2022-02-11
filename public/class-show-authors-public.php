<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       funcy
 * @since      1.0.0
 *
 * @package    Show_Authors
 * @subpackage Show_Authors/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Show_Authors
 * @subpackage Show_Authors/public
 * @author     funcy <funcy>
 */
class Show_Authors_Public {

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
		 * defined in Show_Authors_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Show_Authors_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/show-authors-public.css', array(), $this->version, 'all' );

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
		 * defined in Show_Authors_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Show_Authors_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_script($this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/show-authors-public.js', array(), $this->version, false );

		wp_localize_script($this->plugin_name, 'ajax', array('url' => admin_url( 'admin-ajax.php')));

		wp_enqueue_script($this->plugin_name);

	}

	/**
	 * Server side function to fetch author names through admin-ajax
	 *
	 * @since    1.0.0
	*/
	public function show_authors_server(){
	
		if(!wp_verify_nonce($_REQUEST['nonce'], "show_authors_nonce")){
			exit("No naughty business please");
		}
		
		$options = get_option('roles_to_show');

		
		if($options['admin']){
			
			$user_number = 0;
			
			$users = get_users(array('role'=>'administrator'));
		
			foreach ($users as $user){
				$result['admin-user'.$user_number] = $user->display_name;
				$user_number++;
			}
		}

		
		if($options['author']){
			
			$user_number = 0;
			
			$users = get_users(array('role'=>'author'));
		
			foreach ($users as $user){
				$result['author-user'.$user_number] = $user->display_name;
				$user_number++;
			}
		}

		if($options['editor']){
			
			$user_number = 0;
			
			$users = get_users(array('role'=>'editor'));
		
			foreach ($users as $user){
				$result['editor-user'.$user_number] = $user->display_name;
				$user_number++;
			}
		}
		
		$result = json_encode($result);
		echo $result;
		
		die();
	}

	/**
	 * Server side function to deny author names through admin-ajax
	 *
	 * @since    1.0.0
	*/
	public function show_authors_nopriv_server(){
		$result['type'] = "must login";
		$result = json_encode($result);
		echo $result;
		die();
	}

	/**
	 * This function is tied to our show_authors shortcode as our plugin frontend
	 *
	 * @since    1.0.0
	*/
	public function render_frontend(){

		include 'partials/show-authors-public-display.php';
	}

}
