<?php


class myOPPClass{

	function __construct(){

		add_action( 'admin_menu', [ $this, 'custom_menu_page' ] );

		add_action( 'admin_enqueue_scripts', [ $this, 'my_enqueue' ] );

		add_action( 'wp_ajax_stored-value', [ $this, 'my_ajax_data_handler' ] );

	}

	/**
	 * Menu Page
	 *
	 * @author Atikul Islam
	 * @version 1.0.0
	 */

	function custom_menu_page(){
		add_menu_page(
			'Custom Menu Page',
			'Custom Menu',
			'manage_options',
			'custom-menu',
			[$this, 'custom_menu_callback'],
			'dashicons-admin-generic',
			30
		);
		add_submenu_page(
			'custom-menu',
			'Custom Menu Subpage',
			'Custom Submenu',
			'manage_options',
			'custom-submenu',
			[$this, 'custom_submenu_callback']
		);
	}

	function custom_menu_callback(){
		include(plugin_dir_path( __FILE__ ) . 'welcome.php');
	}
	function custom_submenu_callback(){
		echo "hi";
	}

	/**
	 * Enqueue Script
	 *
	 * @author Atikul Islam
	 * @version 1.0.0
	 */

	function my_enqueue($hook) {

		if ($hook == 'toplevel_page_custom-menu') {

			wp_enqueue_style('bootstrap', MY_OOP_PLUGIN_URL . '/css/bootstrap.min.css');

		}

		$current_screen = get_current_screen();

		if ($current_screen->id == 'custom-menu_page_custom-submenu') {
			wp_enqueue_style('bootstrap', MY_OOP_PLUGIN_URL . '/css/bootstrap.min.css');
		}


		wp_enqueue_script('ajax-script', MY_OOP_PLUGIN_URL . '/js/script.js', array('jquery'), null, false);
		wp_localize_script(
			'ajax-script',
			'ajax_object',
			array(
				'ajaxurl' => admin_url('admin-ajax.php'),
				'author' => 'Atikul Islam',
				'serverTime' => date('Y-m-d h:i:s'),
			)
		);

	}
	
	/**
	 * Ajax handler
	 *
	 * @author Atikul Islam
	 * @version 1.0.0
	 */

	function my_ajax_data_handler() {

		global $wpdb;
		$student_table = $wpdb->prefix . 'student_list';

		$name_sanitize = sanitize_text_field( $_POST['name'] );
		$class_sanitize = sanitize_text_field( $_POST['class'] );
		$age_sanitize = sanitize_text_field( $_POST['age'] );

		$success =  $wpdb->insert(
			$student_table,
			array(
				'name' => $name_sanitize,
				'class' => $class_sanitize,
				'age' => $age_sanitize,
			),
			array(
				'%s',
				'%s',
				'%d',
			)
		);
		wp_send_json(['success' => true, 'id' => $wpdb->insert_id]);
		wp_die();
	}
	













}

