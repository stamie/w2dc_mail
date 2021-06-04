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


	$plugin_url = plugin_dir_url( W2DC_MAIL_FILE );
	wp_enqueue_script( 'w2dc-mailster', $plugin_url . '/assets/js/script.js', array( 'jquery' ), null, true );
	wp_enqueue_style( 'w2dc-mailster', $plugin_url . '/assets/css/style.css', array(), null );

	

?>

<table class="form-table" >
	<tr>
	
		<td>
		<p>It connects to Mailster and Web 2.0 Directory plugins.<br> You can by the Pro Version on the <a href="https://sosprogramozas.hu">https://sosprogramozas.hu</a>.</p>
		</td>
	</tr>
	
</table>
