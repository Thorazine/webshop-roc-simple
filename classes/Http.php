<?php

Class Http
{

	public static $webroot = '';

	/**
	 * das boot function
	 * @return void
	 */
	public static function boot()
	{
		// zoeken naar localhost
		// zoeken naar /public/
		// webroot van maken

		if($_SERVER['HTTP_HOST'] == 'localhost' && strpos($_SERVER['REQUEST_URI'], '/public/')) {

			$urlParts = explode('/public/', $_SERVER['REQUEST_URI']);

			self::$webroot = self::httpOrHttps().$_SERVER['HTTP_HOST'].$urlParts[0].'/public/';
		}
		else {
			self::$webroot = self::httpOrHttps().$_SERVER['HTTP_HOST'];
		}

	}

	/*
	Returns webroot
	 */
	public static function webroot()
	{
		return self::$webroot;
	}


	/*
	Checks for http(s) and returns
	 */
	private static function httpOrHttps()
	{
		if(isset($_SERVER['HTTPS'])) {
			return 'https://';
		}
		return 'http://';
	}

}
