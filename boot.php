<?php

session_start();

// require 'vendor/autoload.php';
require 'classes/Cart.php';
require 'classes/Http.php';
// require 'classes/Crypt.php';

// $encrypted = Crypt::encrypt('Hallo');
// dd(Crypt::decrypt($encrypted));

Http::boot();

// reset the cart if it's empty
if(! isset($_SESSION['cart'])) {
	Cart::reset();
}


function db()
{
	$host = 'localhost';
	$database = 'webshop-complete';
	$username = 'root';
	$password = 'root';

	try {
		$connection = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $connection;
	}
	catch(PDOException $e) {
		dd($e->getMessage());
	}
}


// make all urls complete
function asset($path)
{
	return Http::webroot().$path;
}


// load all the base functions
function dd($text)
{
	if(is_array($text) || is_object($text)) {
		var_dump($text);
		die();
	}
	else {
		echo $text;
		die();
	}
}
