<?php

try {
	$connection = db();
	$connection->beginTransaction();

	$query = 'INSERT INTO `users` (first_name, suffix_name, last_name, country, city, street, street_number, street_suffix, zipcode, email, password, created_at, updated_at)
		VALUES
		(:first_name, :suffix_name, :last_name, :country, :city, :street, :street_number, :street_suffix, :zipcode, :email, :password, :created_at, :updated_at)';

	$data = [
		'first_name' => standardizeName($_POST['first_name']),
		'suffix_name' => strtolower(trim($_POST['suffix_name'])),
		'last_name' => standardizeName($_POST['last_name']),
		'country' => trim($_POST['country']),
		'city' => trim($_POST['city']),
		'street' => trim($_POST['street']),
		'street_number' => trim($_POST['street_number']),
		'street_suffix' => trim($_POST['street_suffix']),
		'zipcode' => standardizePostcode($_POST['zipcode']),
		'email' => strtolower(trim($_POST['email'])),
		'password' => password_hash($_POST['password'], PASSWORD_BCRYPT), // encrypt the password before putting it in the database
		'created_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s')
	];


	$connection->commit();
}
catch (Exception $e) {
	$connection->rollBack();
}


function standardizeName($name)
{
	return ucfirst(strtolower(trim($name)));
}


function standardizePostcode($postcode)
{
	if(strlen($postcode) == 6) {
		// add a space
		$postcode = explode('', $postcode); // make it an array by splitting on nothing
		array_splice($postcode, 4, 0, ' '); // insert the space at position 4
		$postcode = implode('', $postcode); // put the array back together
	}
	return strtoupper($postcode); // return the postcode with uppercases
}

// Data corrigeren

// User aanmaken

// Order aanmaken

// Order Producten koppelen

// Mollie betaling doen

// Order updaten met Mollie feedback

// Redirect naar betaling gelukt/mislukt pagina
