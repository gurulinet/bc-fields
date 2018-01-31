<?php


namespace BomaAgdSettings\FormFields;


class FooterContact
{
	public static function add()
	{
		return new self();
	}
	
	public function formFields()
	{
		// Tel / Email
		add_settings_section(
			'boma-agd-footer-contact',
			__('Kontakt do Stopki (Sekcja "Footer")'),
			array($this,'bomaAgdFooterContact'),
			'boma-agd-settings'
		);
		
		add_settings_field(
			'bomaFooterPhone_1',
			__('Telefon 1', ''),
			array($this,'bomaContactFooter'),
			'boma-agd-settings',
			'boma-agd-footer-contact',
			array(
				'bomaFooterPhone_1'
			)
		);
		
		
		add_settings_field(
			'bomaFooterPhone_2',
			__('Telefon 2', ''),
			array($this,'bomaContactFooter'),
			'boma-agd-settings',
			'boma-agd-footer-contact',
			array(
				'bomaFooterPhone_2'
			)
		);
		
		add_settings_field(
			'bomaFooterEmail',
			__('Email'),
			array($this, 'bomaContactFooter'),
			'boma-agd-settings',
			'boma-agd-footer-contact',
			array(
				'bomaFooterEmail'
			)
		);
		
		register_setting(
			'boma-agd',
			'bomaFooterPhone_1'
		);
		register_setting(
			'boma-agd',
			'bomaFooterPhone_2'
		);
		register_setting(
			'boma-agd',
			'bomaFooterEmail'
		);
	}
	
	public function bomaAgdFooterContact()
	{
		echo '<p>' . __('Dane Kontaktowe') . '</p>';
	}
	
	public function bomaContactFooter($ar)
	{
		$options = get_option($ar[0]);
		
		switch($ar[0]){
			case 'bomaMainPhone_1' :
				$options = esc_attr($options);
				break;
			case 'bomaFooterPhone_2' :
				$options = esc_attr($options);
			break;
			case 'bomaFooterEmail' :
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