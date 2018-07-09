<?php

try {
	$connection = db();
	$connection->beginTransaction();

	// user aanmaken
	$query = 'INSERT INTO `users` (first_name, suffix_name, last_name, country, city, street, street_number, street_suffix, zipcode, email, password, created_at, updated_at)
	VALUES
		(:first_name, :suffix_name, :last_name, :country, :city, :street, :street_number, :street_suffix, :zipcode, :email, :password, :created_at, :updated_at)';

	$data = [
		'first_name' => standardizeName($_POST['first_name']),
		'suffix_name' => trim($_POST['suffix_name']),
		'last_name' => standardizeName($_POST['last_name']),
		'country' => $_POST['country'],
		'city' => standardizeName($_POST['city']),
		'street' => standardizeName($_POST['street']),
		'street_number' => $_POST['street_number'],
		'street_suffix' => trim($_POST['street_suffix']),
		'zipcode' => standardizePostcode($_POST['zipcode']),
		'email' => strtolower(trim($_POST['email'])),
		'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
		'created_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s'),
	];

	$user = $connection->prepare($query); // query voorbereiden
	$user->execute($data);

	$userId = $connection->lastInsertId();

	// order aanmaken


	// product_order loopen (aanmaken)


	// mollie betaling


	// order updaten met mollie data


	// redirecten naar mollie

	$connection->commit();
}
catch(Exception $e) {

	// erreur
	$connection->rollBack();
}


function standardizePostcode($postcode)
{
	return strtoupper(chunk_split($postcode, 4, ' '));
}


function standardizeName($string)
{
	return ucword(trim($string));
}


