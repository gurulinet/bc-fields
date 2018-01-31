<?php
/**
 * Plugin Name: Boma Custom Fields
 * Plugin URI: http://boma-agd.pl
 * Description: Ustawienia dla strony Boma
 * Version: 1.0
 * Author: Boma-Agd
 * Author URI: http://boma-agd.pl
 * @source : https://developer.wordpress.org/plugins/settings/custom-settings-page/
 */

define('BOMA_AGD_SETTINGS_DIR', dirname(__FILE__));
define('BOMA_AGD_SETTINGS_URL', plugins_url('', __FILE__));

require_once BOMA_AGD_SETTINGS_DIR . '/autoload.php';

add_action('plugins_loaded', function(){
	if(!class_exists('Settings')){
		new \BomaAgdSettings\Settings\Settings();
	}
});