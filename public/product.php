<?php

// verbinding maken met DB
// Query draaien: SELECT * FROM products WHERE slug = :slug
// outputten

	require '../boot.php';

	$database = db(); // verbinding maken

	$product = $database->prepare('SELECT * FROM products WHERE slug = :slug'); // query voorbereiden

	try {
		$product->execute([
			'slug' => $_GET['slug']
		]);
		$product->setFetchMode(PDO::FETCH_ASSOC);
		$product = $product->fetch();

		if(! $product) {
			header('Location: ../404.php');
		}
	}
	catch(PDOException $e) {
		dd($e->getMessage());
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="title" content="<?php echo $product['seo_title']; ?>">
	<meta name="description" content="<?php echo $product['seo_description']; ?>">
	<title><?php echo $product['title']; ?></title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo asset('css/style.css'); ?>">
</head>
<body>

	<?php include "partials/menu.php"; ?>

	<section class="content">
		<img src="../images/large/<?php echo $product['image']; ?>">


		<h1><?php echo $product['title']; ?></h1>

		<?php echo $product['description']; ?>

		<div class="product-price">
			Nu &euro; <?php echo $product['price']; ?>
		</div>

		<button type="button" class="btn btn-warning add-to-cart" data-url="<?php echo asset('cart/add.php?id='.$product['id']); ?>">Voeg toe aan winkelmand!</button>

	</section>

	<aside class="bucket" id="bucket">
		<?php include "partials/bucket.php"; ?>
	</aside>

	<?php include "partials/footer.php"; ?>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="<?php echo asset('js/app.js'); ?>"></script>
</body>
</html>
