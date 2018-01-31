<?php

namespace BomaAgdSettings\Settings;

use BomaAgdSettings\FormFields\FooterContact;
use BomaAgdSettings\FormFields\Form;
use BomaAgdSettings\FormFields\MainContact;

class Settings
{
	public function __construct()
	{
		$this->actions();
	}
	
	public function bomaOptionsPage()
	{
		add_menu_page('Boma-Agd',
			'Ustawienia Bomy', 'manage_options',
			'boma-agd-settings', array($this, 'bomaOptions'),
			BOMA_AGD_SETTINGS_URL . '/assets/images/boma_settings.png'
		);
	}
	
	public function bomaOptions()
	{
		Form::add()->form();
	}
	
	public function initMainContactSettings()
	{
		MainContact::add()->formFields();
	}
	
	public function initFooterSettings()
	{
		FooterContact::add()->formFields();
	}
	
	public function actions()
	{
		add_action('admin_menu', array($this, 'bomaOptionsPage'));
		add_action('admin_init', array($this,'initMainContactSettings'));
		add_action('admin_init', array($this,'initFooterSettings'));
	}
}