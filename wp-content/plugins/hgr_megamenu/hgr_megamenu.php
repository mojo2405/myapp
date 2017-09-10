<?php
/*
	Plugin Name: HGR MegaMenu
	Plugin URI: http://highgradelab.com/
	Author: HighGrade
	Author URI: https://highgradelab.com
	Version: 2.0.0
	Description: Visual Composer based MegaMenu for HighGrade Themes.
	Text Domain: hgrmegamenu
*/

/*
	If accesed directly, exit
*/
if (!defined('ABSPATH')) exit;


if(!class_exists('HGR_MEGAMENU')) {

	class HGR_MEGAMENU {
	
		
		var $js_dir;
		var $css_dir;
		
		/**
		* Constructor function
		* @since 1.0.0
		*/
		public function __construct(){
			
			// CSS and JS for back-end and front-end
			$this->js_dir			=	plugins_url('js/',__FILE__);
			$this->css_dir			=	plugins_url('css/',__FILE__);
			
			
			add_action( 'plugins_loaded', array( $this, 'hgr_megamenu_load_textdomain' ) );
			
			// Add megamenu post type: hgr_megamenu
			add_action('init',array($this,'hgr_post_type'));
			
			// Add actions for ajax calls
			add_action( 'wp_ajax_get_megamenus', array( $this, 'ajax_get_megamenus' ) );
			add_action( 'wp_ajax_set_megamenu', array( $this, 'ajax_set_megamenu' ) );
			
			// Include necesary scripts and styles on backend and frontend
			add_action('admin_enqueue_scripts',array($this,'load_backends'));
			add_action('wp_enqueue_scripts',array($this,'load_frontends'));
			
			// Add proper css class to parents with megamenu enabled
			add_filter( 'wp_nav_menu_objects', array( $this, 'add_menu_parent_class' ) );
			
			// Remove Some metaboxes
			add_action( 'do_meta_boxes', array( $this, 'hgr_remove_thrdparty_meta_boxes' ) );
		}
		
		/**
		 * Load plugin textdomain.
		 *
		 * @since 1.0.0
		 */
		function hgr_megamenu_load_textdomain() {
		  load_plugin_textdomain( 'hgrmegamenu', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
		}
		
		
		/**
		*	Register the post type hgr_megamenu
		*	@since 1.0.0
		*/
		function hgr_post_type() {
			register_post_type( 'hgr_megamenu',
				array(
					'labels' => array(
						'name'               => esc_html__( 'Mega Menus', 'hgrmegamenu' ),
						'singular_name'      => esc_html__( 'Mega Menu', 'hgrmegamenu' ),
						'menu_name'          => esc_html__( 'Mega Menus', 'hgrmegamenu' ),
						'name_admin_bar'     => esc_html__( 'Mega Menu', 'hgrmegamenu' ),
						'add_new'            => esc_html__( 'Add New', 'info bar', 'hgrmegamenu' ),
						'add_new_item'       => esc_html__( 'Add New Mega Menu', 'hgrmegamenu' ),
						'new_item'           => esc_html__( 'New Mega Menu', 'hgrmegamenu' ),
						'edit_item'          => esc_html__( 'Edit Mega Menu', 'hgrmegamenu' ),
						'view_item'          => esc_html__( 'View Mega Menu', 'hgrmegamenu' ),
						'all_items'          => esc_html__( 'All Mega Menus', 'hgrmegamenu' ),
						'search_items'       => esc_html__( 'Search Mega Menus', 'hgrmegamenu' ),
						'not_found'          => esc_html__( 'No Mega Menus found.', 'hgrmegamenu' ),
						'not_found_in_trash' => esc_html__( 'No Mega Menus found in Trash.', 'hgrmegamenu' ),
					),
				'public'			=>	true,
				'menu_icon'		=>	'dashicons-editor-kitchensink',
				'has_archive'	=>	true,
				'rewrite'		=>	array('slug' => 'mega_menu'),
				'supports'		=>	array('title','editor')
				)
			);
		}
		
		
		/*
		*	Remove 3rd party metaboxes
		*	on this CPT
		*/
		function hgr_remove_thrdparty_meta_boxes() {
			remove_meta_box( 'mymetabox_revslider_0', 'hgr_megamenu', 'normal' );
			remove_meta_box( 'eg-meta-box', 'hgr_megamenu', 'normal' );
		}
		
		
		/**
		* 	If a parent has megamenu enabled
		* 	we add a class
		*	@since 1.0.0
		*/
		function add_menu_parent_class( $items ) {
			foreach ( $items as $item ) {
				if( get_option('hgr_menu_item_'.$item->ID) ){
					$item->classes[] = 'hasmegamenu';
				}
			}
			return $items;    
		}
		
		
		/**
		* 	Gets the megamenu post type list
		* 	@since 1.0
		*/
		function ajax_get_megamenus() {
			
			// What Popup to be displayed on this page?
			$added = '<label for="hgr_megamenu">';
			   esc_html_e( "Display Mega Menu?", 'hgrmegamenu' );
			$added .=  '</label> ';
				$added .=  '<select name="hgr_megamenu" class="widefat">';
				
				$args = array(
					'post_type'		=>	'hgr_megamenu',
					'posts_per_page'=>	'99'
				 );
				$megamenus_array = get_posts( $args );
				
				$menuItemId = $_POST['menuItemId'];
	
				if( !empty($megamenus_array) ) {
					$added .=  '<option value="">'.__('No MegaMenu','hgrmegamenu').'</option>';
					foreach ( $megamenus_array as $megamenu ) {
						setup_postdata( $megamenu );
						
						if( get_option( 'hgr_menu_item_' . $menuItemId ) == $megamenu->ID ) {
							$added .=  '<option value="'.$megamenu->ID.'" selected="selected">'.$megamenu->post_title.'</option>';
							
						} else {
							$added .=  '<option value="'.$megamenu->ID.'">'.$megamenu->post_title.'</option>';
						}
					}
					wp_reset_postdata();
				} else {
					$added .=  '<option value="" selected="selected">'.__('No MegaMenu Available','hgrmegamenu').'</option>';
				}
			$added .=  '</select>';
	
			if ( $added ) {
				echo $added;
				die();
			} else {}
	
		}
		
			
		/**
		* 	Saves the megamenu ID to the proper menu item
		* 	when user selects a certain megamenu for a menu item
		* 	from the Appearance->Menu-> Menu item dropdown list with available megamenus
		* 	@since 1.0
		*/
		function ajax_set_megamenu() {
	
			$mega_menu_id = $_POST['mega_menu_id'];
			$menu_item_id = $_POST['menu_item_id'];

			if( !empty($mega_menu_id) && !empty($menu_item_id) ){
				update_option('hgr_menu_item_'.$menu_item_id, $mega_menu_id );
				echo 'Saved!';				
			}
			
			if( empty($mega_menu_id) && !empty($menu_item_id) ){
				delete_option('hgr_menu_item_'.$menu_item_id );
				echo 'Saved!';				
			} 
			
			die();
		}
		
		
		/*
			Register necessary js and css files on frontend and backend
		*/
		function load_frontends() {
			wp_register_script('hgrmenu_frontend_js', $this->js_dir.'frontend.js', array('jquery'), '1', true);
			wp_register_style('hgrmenu_frontend_style',$this->css_dir.'frontend.css');
			
			wp_enqueue_script('hgrmenu_frontend_js');
			wp_enqueue_style('hgrmenu_frontend_style');
		}
		function load_backends() {
			wp_register_script('hgrmenu_backend_js',$this->js_dir.'backend.js',array('jquery'), '1', true);
			wp_enqueue_script('hgrmenu_backend_js');
			
			wp_register_style('hgrmenu_backend_style',$this->css_dir.'backend.css');
			wp_enqueue_style('hgrmenu_backend_style');
		}
	}
	/*
		All good, fire up the plugin :)
	*/
	new HGR_MEGAMENU;
}