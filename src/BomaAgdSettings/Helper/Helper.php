<?php

namespace BomaAgdSettings\Helper;

class Helper
{
	private static $instance;
	
	private function __construct(){}
	private function __clone(){}
	
	public static function getInstance()
	{
		if(null === self::$instance){
			self::$instance = new self();
		}
		
		return self::$instance;
	}
}