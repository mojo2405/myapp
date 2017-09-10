<?php
/*
	Plugin Name: HGR MegaFooter
	Plugin URI: http://highgradelab.com/
	Author: HighGrade
	Author URI: https://highgradelab.com
	Version: 1.0.0
	Description: Visual Composer based MegaFooter for HighGrade Themes.
	Text Domain: hgrmegafooter
*/

/*
	If accesed directly, exit
*/
if (!defined('ABSPATH')) exit;


if(!class_exists('HGR_MEGAFOOTER')) {

	class HGR_MEGAFOOTER {
		
		/**
		* Constructor function
		* @since 1.0.0
		*/
		public function __construct(){
			
			// Add language option
			add_action( 'plugins_loaded', array($this,'hgr_megafooter_load_textdomain') );
			
			// Add megamenu post type: hgr_megafooter
			add_action('init',array($this,'hgr_post_type'));
			
			// Init & save metaboxex for pages
			add_action( 'add_meta_boxes', array( $this, 'hgr_megafooter_metaboxes' ) );
			add_action( 'save_post', array( $this, 'hgr_save_megafooter_data' ) );
						
			// Remove Some metaboxes
			add_action( 'do_meta_boxes', array( $this, 'hgr_remove_thrdparty_meta_boxes' ) );
		}
		
		/**
		*	Load plugin textdomain.
		*	@since 1.0.0
		*/
		function hgr_megafooter_load_textdomain() {
		  load_plugin_textdomain( 'hgrmegafooter', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
		}
		
		
		/**
		*	Register the post type hgr_megafooter
		*	@since 1.0.0
		*/
		function hgr_post_type() {
			register_post_type( 'hgr_megafooter',
				array(
					'labels' => array(
						'name'               => esc_html__( 'Mega Footers', 'hgrmegafooter' ),
						'singular_name'      => esc_html__( 'MegaFooter', 'hgrmegafooter' ),
						'menu_name'          => esc_html__( 'MegaFooters', 'hgrmegafooter' ),
						'name_admin_bar'     => esc_html__( 'MegaFooters', 'hgrmegafooter' ),
						'add_new'            => esc_html__( 'Add New', 'info bar', 'hgrmegafooter' ),
						'add_new_item'       => esc_html__( 'Add New MegaFooter', 'hgrmegafooter' ),
						'new_item'           => esc_html__( 'New MegaFooter', 'hgrmegafooter' ),
						'edit_item'          => esc_html__( 'Edit MegaFooter', 'hgrmegafooter' ),
						'view_item'          => esc_html__( 'View MegaFooter', 'hgrmegafooter' ),
						'all_items'          => esc_html__( 'All MegaFooters', 'hgrmegafooter' ),
						'search_items'       => esc_html__( 'Search MegaFooters', 'hgrmegafooter' ),
						'not_found'          => esc_html__( 'No MegaFooter found.', 'hgrmegafooter' ),
						'not_found_in_trash' => esc_html__( 'No MegaFooter found in Trash.', 'hgrmegafooter' ),
					),
				'public'			=>	true,
				'menu_icon'		=>	'dashicons-editor-kitchensink',
				'has_archive'	=>	true,
				'rewrite'		=>	array('slug' => 'mega_footer'),
				'supports'		=>	array('title','editor')
				)
			);
		}
		
		
		/*
		*	Remove 3rd party metaboxes
		*	on this CPT
		*/
		function hgr_remove_thrdparty_meta_boxes() {
			remove_meta_box( 'mymetabox_revslider_0', 'hgr_megafooter', 'normal' );
			remove_meta_box( 'eg-meta-box', 'hgr_megafooter', 'normal' );
		}
		
		
		/**
		* Add hgr_megafooter metaboxes function for pages
		* @since 1.0.0
		* Doc: https://codex.wordpress.org/Function_Reference/add_meta_box
		*/	
		function hgr_megafooter_metaboxes() {
			$screens = array( 'page' ); // Available on pages only
			foreach ( $screens as $screen ) {
				add_meta_box(
					'hgr_megafooter_metabox',					// $id
					__( 'MegaFooter Settings', 'hgrmegafooter' ),		// $title
					array($this,'hgr_megafooter_custom_box'),	// $callback
					$screen,									// $screen
					'side',										// $context
					'low'										// $priority
				);
			}
		}
	
		function hgr_megafooter_custom_box($post) {
			// Add an nonce field so we can check for it later
			wp_nonce_field( 'hgr_megafooter_custom_box', 'hgr_megafooter_custom_box_nonce' );
	
			// Get metaboxes values from database
			$hgr_megafooterID	=	get_post_meta( $post->ID, '_hgr_megafooterID', true );	// hgr_megafooter unique ID
			
			// Construct the metaboxes and print out
			
			// What Popup to be displayed on this page?
			echo '<div class="settBlock" style="margin-bottom:15px"><label for="hgr_megafooterID" style="width:170px;display:inline-block;height:30px;">';
			   esc_html_e( "(Mega)Footer for this page", 'hgrmegafooter' );
			echo '</label> ';
				echo '<select name="hgr_megafooterID" id="hgr_megafooterID">';
				
				$args = array(
					'post_type'		=>	'hgr_megafooter',
					'posts_per_page'=>	'99'
				 );
				$megafooters_array = get_posts( $args );
				
				if( !empty($megafooters_array) ) {
					echo '<option value="no_footer" '.(!empty($hgr_megafooterID) && $hgr_megafooterID == 'no_footer' ? 'selected = "selected"' : '').'>'.__('No Footer', 'hgrmegafooter').'</option>';
					echo '<option value="minimal_footer" '.(!empty($hgr_megafooterID) && $hgr_megafooterID == 'minimal_footer' ? 'selected = "selected"' : '').'>'.__('Minimal Footer', 'hgrmegafooter').'</option>';
					echo '<option value="" '.(empty($hgr_megafooterID) ? 'selected = "selected"' : '').'>'.__('Default MegaFooter', 'hgrmegafooter').'</option>';
					
					foreach ( $megafooters_array as $megafooter ) {
						setup_postdata( $megafooter );
						echo '<option value="'.$megafooter->ID.'" '.($hgr_megafooterID == $megafooter->ID ? 'selected = "selected"' : '').'>'.$megafooter->post_title.'</option>';
					}
					wp_reset_postdata();
				} else {
					echo '<option value="no_footer" '.(!empty($hgr_megafooterID) && $hgr_megafooterID == 'no_footer' ? 'selected = "selected"' : '').'>'.__('No Footer', 'hgrmegafooter').'</option>';
					echo '<option value="minimal_footer" '.(!empty($hgr_megafooterID) && $hgr_megafooterID == 'minimal_footer' ? 'selected = "selected"' : '').'>'.__('Minimal Footer', 'hgrmegafooter').'</option>';
					echo '<option value="" '.(empty($hgr_megafooterID) || $hgr_megafooterID != 'no_footer' || $hgr_megafooterID != 'minimal_footer' ? 'selected = "selected"' : '').'>'.__('No MegaFooter Available', 'hgrmegafooter').'</option>';
				}
			echo '</select></div>';
		}
		
		
		function hgr_save_megafooter_data( $post_id ) {
			// Check if our nonce is set.
			if ( ! isset( $_POST['hgr_megafooter_custom_box_nonce'] ) ) {
				return $post_id;
			}
	
			$nonce = $_POST['hgr_megafooter_custom_box_nonce'];
	
			// Verify that the nonce is valid
			if ( ! wp_verify_nonce( $nonce, 'hgr_megafooter_custom_box' ) ) {
				return $post_id;
			}
	
			// If this is an autosave, our form has not been submitted, so we don't want to do anything
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				//return $post_id;
			}
	
			// Check the user's permissions.
			if ( 'page' == $_POST['post_type'] ) {
				if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
			} else {
				if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
			}
			
			// OK to save data
			// Sanitize user input
			$hgr_megafooterID			= sanitize_text_field( $_POST['hgr_megafooterID'] );	
			
			// Update the meta field in the database
			update_post_meta( $post_id, '_hgr_megafooterID',	 $hgr_megafooterID );
		}
	}
	/*
		All good, fire up the plugin :)
	*/
	new HGR_MEGAFOOTER;
}