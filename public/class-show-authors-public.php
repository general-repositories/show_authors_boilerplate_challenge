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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/show-authors-public.js', array( 'jquery' ), $this->version, false );

	}

	public function show_authors(){
	
		if(!wp_verify_nonce($_REQUEST['nonce'], "show_authors_nonce")){
			exit("No naughty business please");
		}
		
		$users = get_users();
		$user_number = 0;
	
		foreach ($users as $user){
			$result['user'.$user_number] = $user->display_name;
			$user_number++;
		}
		
		$result = json_encode($result);
		echo $result;
		
		die();
	}

	public function my_must_login(){
		$result['type'] = "must login";
		$result = json_encode($result);
		echo $result;
		die();
	}

	public function render_frontend(){
		?>
			<script>

				let isRan = false;
				const ajaxurl = '<?php echo admin_url('admin-ajax.php');?>';

				function showUsers(){

					const userList = document.getElementById('userList');
					const div = document.getElementById('showUsers');

					if(!isRan){

						isRan = true;

						fetch(ajaxurl, {
							method: 'POST',
							headers: {
								'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
							},
							body: `action=show_authors&nonce=${div.getAttribute('data-nonce')}`
						})
						.then(res=>res.json())
						.then(object=>{

							if(object.type != 'must login'){

								console.log(object);
								for (const key in object){
									const element = document.createElement('li');
									element.innerText = object[key];
									userList.appendChild(element);
								}
							}else alert('you must be logged in to see the list');
						});
					}
				}

			</script>

			<div
				id="showUsers"
				class='users-div'
				data-nonce="<?php echo wp_create_nonce("show_authors_nonce");?>"
				post-id="<?php echo get_the_ID();?>"
				user="<?php echo get_current_user_id();?>"
			>
				<button
					onclick="showUsers()"
				>show users</button>
	
				<ul id="userList">
	
				</ul>
			</div>
		<?php
	}

}
