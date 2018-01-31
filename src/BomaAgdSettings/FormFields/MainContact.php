<?php


namespace BomaAgdSettings\FormFields;

class MainContact
{
	public static function add()
	{
		return new self();
	}
	
	public function formFields()
	{
		// Tel / Email
		add_settings_section(
			'boma-agd-main-contact',
			__('Główny kontakt do Boma AGD (Sekcja "Header")'),
			array($this,'bomaAgdMainContact'),
			'boma-agd-settings'
		);
		
		add_settings_field(
			'bomaMainPhone',
			__('Telefon', ''),
			array($this,'bomaContactMain'),
			'boma-agd-settings',
			'boma-agd-main-contact',
			array(
				'bomaMainPhone'
			)
		);
		
		
		add_settings_field(
			'bomaMainEmail',
			__('Email', ''),
			array($this,'bomaContactMain'),
			'boma-agd-settings',
			'boma-agd-main-contact',
			array(
				'bomaMainEmail'
			)
		);
		
		register_setting(
			'boma-agd',
			'bomaMainPhone'
		);
		register_setting(
			'boma-agd',
			'bomaMainEmail'
		);
	}
	
	public function bomaAgdMainContact()
	{
		echo '<p>' . __('Telefon / Email') . '</p>';
	}
	
	public function bomaContactMain($ar)
	{
		$options = get_option($ar[0]);
		
		switch($ar[0]){
			case 'bomaMainPhone' :
				$options = esc_attr($options);
				break;
			case 'bomaMainEmail' :
				if(!$this->isEmail($options)){
					add_settings_error('bomaMessagesError', 'bomaMessageError',
						__('Niepoprawny email', 'boma_agd'), 'updated');
					
					settings_errors('bomaMessagesError');
					
					$options = '';
				}
				break;
			default :
				echo '';
		}
		
		echo '<input type="text" size="35" id="' . esc_attr($ar[0]) . '" name="' . esc_attr($ar[0]) . '" value="' . esc_attr($options) . '" />';
	}
	
	public function isEmail($email)
	{
		if (!empty($email)) {
			return preg_match('/^[A-Za-z0-9!#$%&\'*+-\/=?^_`{|}~]+@[A-Za-z0-9-]+(\.[AZa-z0-9-]+)+[A-Za-z]$/', $email);
		}
		
		return true;
	}
}