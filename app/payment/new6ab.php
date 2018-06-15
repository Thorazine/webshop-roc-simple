<?php

try {
	$connection = db();
	$connection->beginTransaction();

	// user aanmaken
	$query = 'INSERT INTO `users` (first_name, suffix_name, last_name, country, city, street, street_number, street_suffix, zipcode, email, password, created_at, updated_at)
	VALUES
		(:first_name, :suffix_name, :last_name, :country, :city, :street, :street_number, :street_suffix, :zipcode, :email, :password, :created_at, :updated_at)';

	$data = [
		'first_name' => $_POST['first_name'],
		'suffix_name' => $_POST['suffix_name'],
		'last_name' => $_POST['last_name'],
		'country' => $_POST['country'],
		'city' => $_POST['city'],
		'street' => $_POST['street'],
		'street_number' => $_POST['street_number'],
		'street_suffix' => $_POST['street_suffix'],
		'zipcode' => standardizePostcode($_POST['zipcode']),
		'email' => $_POST['email'],
		'password' => $_POST['password'],
		'created_at' => $_POST['created_at'],
		'updated_at' => $_POST['updated_at'],
	];

	$products = $connection->prepare($query); // query voorbereiden
	$products->execute($data);

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
