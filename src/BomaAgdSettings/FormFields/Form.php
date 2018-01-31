<?php


namespace BomaAgdSettings\FormFields;


class Form
{
	public static function add()
	{
		return new self();
	}
	
	public function form()
	{
		if (!current_user_can('manage_options')) {
			wp_die('Nie masz uprawnień Administratora żeby editować tą stronę!');
		}
		if (!is_admin()) {
			wp_die('Nie masz uprawnień Administratora żeby editować tą stronę!');
		}
		
		if (isset($_GET['settings-updated'])) {
			add_settings_error('bomaMessages', 'bomaMessage',
				__('Ustawienia zapisane', 'boma_agd'), 'updated');
		}
		
		settings_errors('bomaMessages');
		echo
			'<div class="wrap">
            <h1>' . esc_html(get_admin_page_title()) . '</h1>
            <form action="options.php" method="post">';
		wp_nonce_field('update-options');
		
		do_settings_sections('boma-agd-settings');
		settings_fields('boma-agd');
		
		submit_button('Zapisz zmiany');
		echo
		'</form>
        </div>';
	}
}