<?php
/*
Plugin Name: W2DC Mail plugin
Plugin URI:  https://sosprogramozas.hu/termek/w2dc-mailster-plugin/
Description:  It connects to Mailster and Web 2.0 Directory plugins 
Version: 1.1
Author: S.O.S. Programozas
Author URI: https://sosprogramozas.hu
License: GPLv2 or later

*/

define( 'W2DC_MAIL_VERSION', '1.1' );
//define( 'W2DC_MAIL_REQUIRED_VERSION', '' );
define( 'W2DC_MAIL_FILE', __FILE__ );
define( 'W2DC_MAIL_PATH', __DIR__ );


$urls = array();
$query_pages = get_pages();
foreach ($query_pages as $page){
	if (strpos($page->post_content, 'webdirectory-submit]')
	 || strpos($page->post_content, 'webdirectory-submit id=')){
		$urls[] = $page->post_name;
		
	}
}

require_once dirname( __FILE__ ) . '/classes/mailsterW2DC.class.php';
if (is_admin()){
	$mail = new MailsterW2DC();
}
$url = trim($_SERVER['REQUEST_URI'], '/');
$url = substr($url, 0, strpos($url, '/'));
if (!function_exists('w2dc_mail_plugin_footer_scripts') && in_array($url, $urls)){
	add_action( 'wp_footer', 'w2dc_mail_plugin_footer_scripts' );
	function w2dc_mail_plugin_footer_scripts(){
		include __DIR__.'/includes/controller.php';
	}
}
if (in_array($url, $urls)){

	if (!is_admin() && isset($_POST["w2dc_mailster_newsletter"])){
		$mail = new MailsterW2DC();
	
		$contact_form = array(
			"email" => sanitize_email($_POST["contact_email"]),
			"lastname" => sanitize_text_field($_POST["post_title"]),
			"firstname" => "",

		);
		
		return $mail->add_subscriber($contact_form);
		
	}
}