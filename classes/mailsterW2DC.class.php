<?php
/*
Plugin Name: W2DC Mail plugin
Plugin URI:  https://sosprogramozas.hu/termek/w2dc-mailster-plugin/
Description:  It connects to Mailster and Web 2.0 Directory plugins 
Version: 1.1
Author: S.O.S. Programozas
Author URI: https://sosprogramozas.hu
License: GPLv2 or later
Text Domain: 
*/

class MailsterW2DC {


	public function __construct() {

		load_plugin_textdomain( 'w2dc_mail' );
		add_action('admin_menu', array($this, 'menu'));

	}


	/**
	 *
	 *
	 * @param unknown $network_wide
	 */
	public function activate( $network_wide ) {}


	/**
	 *
	 *
	 * @param unknown $network_wide
	 */
	public function deactivate( $network_wide ) {}


	public function menu() {
		
		if (defined('W2DC_MAILSTER') && W2DC_MAILSTER) {
			$capability = 'publish_posts';
		} else {
			$capability = 'manage_options';
		}

		add_submenu_page('w2dc_settings',
		__('Mailster', 'w2dc_mail'),
		__('Mailster', 'w2dc_mail'),
		$capability,
		'w2dc_mail',
		array($this, 'w2dc_mail_function')
		); 

	}




	/**
	 *
	 *
	 * @param unknown $contact_form
	 */
	public  function add_subscriber( $contact_form, $lists = array() ) {

		if ( count($lists)==0) {
			global $wpdb;
			$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}mailster_lists", OBJECT );
			$list_ids  = array();
			foreach ($results as $result){
				$list_ids[]  = $result->ID;
			}
		} else {
			$list_ids  = $lists;
		}

		$overwrite = true;
		$merge     = true;

		// add subscriber
		if (is_array($contact_form) && isset($contact_form['email'])){
			
			include_once __DIR__ . "/../../mailster/classes/subscribers.class.php";
			$subscriber = new MailsterSubscribers();
			$subscriber_id = $subscriber->add( $contact_form, $overwrite || $merge, $merge, false );

			// no error		
			if ( ! is_wp_error( $subscriber_id ) && $list_ids ) {

				$subscriber->assign_lists( array($subscriber_id), $list_ids );

				return true;

			}
		}

		return false;
	}


	/**
	 *
	 *
	 * @param unknown $panels
	 * @return unknown
	 */
	public static function w2dc_mail_function( ) {
		
		$plugin_path = plugin_dir_path( W2DC_MAIL_FILE );
		w2dc_renderTemplate( $plugin_path . '/views/w2dc_mailster.php');

	}





}
