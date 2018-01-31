<?php
// https://dsgnwrks.pro/how-to/using-class-autoloaders-in-wordpress/
spl_autoload_register('autoloader');
function autoloader( $class )
{
	if (0 !== strpos( $class, 'BomaAgdSettings')) {
		return;
	}
	
	$file = BOMA_AGD_SETTINGS_DIR . '/src/'. $class .'.php';
	
	$file = str_replace('\\', '/', $file);
	
	if (file_exists($file)) {
		require($file);
	}else{
		print_r("Class $class could not be found");
	}
}