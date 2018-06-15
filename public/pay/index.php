<?php
	require '../../boot.php';

	$errors = [];

	if($_SERVER['REQUEST_METHOD'] === 'POST') {

		$variables = [
			'first_name' => ['required', 'min:2', 'max:50', 'name'],
			'suffix_name' => ['min:1', 'max:15', 'name'],
			'last_name' => ['required', 'name', 'min:2', 'max:50'],
			'country' => ['min:2', 'max:15', 'name'],
			'city' => ['required', 'min:2', 'max:55', 'name'],
			'street' => ['required', 'min:2', 'max:85', 'name'],
			'street_number' => ['required', 'min:1', 'max:5'],
			'street_suffix' => ['min:1', 'max:25'],
			'zipcode' => ['required', 'postcode', 'min:6', 'max:7'],
			'email' => ['required', 'email', 'min:7', 'max:155'],
			'password' => ['required', 'min:8', 'max:100', 'confirmed'],
		];

		require '../../app/validation/validations.php';


		if(count($errors) == 0) {

			require '../../app/payment/new6ab.php';

			dd('Joepie! We kunnen betalen!');

			// user opslaan
			// order aanmaken
			// product_order opslaan (loop)
			// mollie aanroepen (betalen): Composer installeren, mollie toevoegen
			// order updaten met betaal informatie
			// doorsturen naar betaling geslaagd/mislukt pagina

		}
	}

	// dd($_POST);

	function errors()
	{

	}

	function value($key)
	{
		return @$_POST[$key];
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="title" content="">
	<meta name="description" content="">
	<title>Betalen</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo asset('css/style.css'); ?>">
</head>
<body>

	<?php include "../partials/menu.php"; ?>

	<section class="content">
		<h1>Betalen</h1>

		<?php if(@$errors) { ?>
			<div class="alert alert-danger">
				Oeps, niet alles is correct ingevuld.
			</div>
		<?php } ?>

		<form class="form-horizontal" action="<?php echo asset('pay/'); ?>" method="POST">

			<div class="form-group">
				<label class="col-sm-3 control-label">
					Naam
				</label>
				<div class="col-sm-3">
					<input class="form-control" type="text" name="first_name" placeholder="Voornaam" value="<?php echo value('first_name'); ?>">
					<?php echo (@$errors['first_name']) ? '<p class="text-danger">'.$errors['first_name'][0].'</p>' : ''; ?>
				</div>
				<div class="col-sm-2">
					<input class="form-control" type="text" name="suffix_name" placeholder="Tussenvoegsel" value="<?php echo value('suffix_name'); ?>">
						<?php echo (@$errors['suffix_name']) ? '<p class="text-danger">'.$errors['suffix_name'][0].'</p>' : ''; ?>
				</div>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="last_name" placeholder="Achternaam" value="<?php echo value('last_name'); ?>">
					<?php echo (@$errors['last_name']) ? '<p class="text-danger">'.$errors['last_name'][0].'</p>' : ''; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					Land
				</label>
				<div class="col-sm-9">
					<select class="form-control" name="country" placeholder="Kies een land">
						<?php foreach([
							'NL' => 'Nederland',
							'BE' => 'België',
							'DE' => 'Deutchland'
						] as $iso => $country) { ?>
						<option value="<?php echo $iso; ?>" <?php echo (value('country') == $iso) ? 'selected="selected"' : ''; ?>><?php echo $country; ?></option>
						<?php } ?>
					</select>
					<?php echo (@$errors['country']) ? '<p class="text-danger">'.$errors['country'][0].'</p>' : ''; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					Stad
				</label>
				<div class="col-sm-5">
					<input class="form-control" type="text" name="city" placeholder="Stad" value="<?php echo value('city'); ?>">
					<?php echo (@$errors['city']) ? '<p class="text-danger">'.$errors['city'][0].'</p>' : ''; ?>
				</div>
				<label class="col-sm-1 control-label">
					Postcode
				</label>
				<div class="col-sm-3">
					<input class="form-control" type="text" name="zipcode" placeholder="Postcode" value="<?php echo value('zipcode'); ?>">
					<?php echo (@$errors['zipcode']) ? '<p class="text-danger">'.$errors['zipcode'][0].'</p>' : ''; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					Straat
				</label>
				<div class="col-sm-5">
					<input class="form-control" type="text" name="street" placeholder="Straat" value="<?php echo value('street'); ?>">
					<?php echo (@$errors['street']) ? '<p class="text-danger">'.$errors['street'][0].'</p>' : ''; ?>
				</div>
				<div class="col-sm-2">
					<input class="form-control" type="text" name="street_number" placeholder="Huisnummer" value="<?php echo value('street_number'); ?>">
					<?php echo (@$errors['street_number']) ? '<p class="text-danger">'.$errors['street_number'][0].'</p>' : ''; ?>
				</div>
				<div class="col-sm-2">
					<input class="form-control" type="text" name="street_suffix" placeholder="Toevoeging" value="<?php echo value('street_suffix'); ?>">
					<?php echo (@$errors['street_suffix']) ? '<p class="text-danger">'.$errors['street_suffix'][0].'</p>' : ''; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					E-mail adres
				</label>
				<div class="col-sm-9">
					<input class="form-control" type="text" name="email" placeholder="E-mail adres" value="<?php echo value('email'); ?>">
					<?php echo (@$errors['email']) ? '<p class="text-danger">'.$errors['email'][0].'</p>' : ''; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					Wachtwoord
				</label>
				<div class="col-sm-9">
					<input class="form-control" type="password" name="password" placeholder="Wachtwoord" value="">
					<?php echo (@$errors['password']) ? '<p class="text-danger">'.$errors['password'][0].'</p>' : ''; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					Herhaal wachtwoord
				</label>
				<div class="col-sm-9">
					<input class="form-control" type="password" name="password_confirmed" placeholder="Wachtwoord bevestigen" value="">
					<?php echo (@$errors['password_confirmed']) ? '<p class="text-danger">'.$errors['password_confirmed'][0].'</p>' : ''; ?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-9 col-sm-offset-3">
					<button type="submit" class="btn btn-primary">Verstuur</button>
				</div>
			</div>

		</form>
	</section>

	<aside class="bucket" id="bucket">
		<?php include "../partials/bucket.php"; ?>
	</aside>

	<?php include "../partials/footer.php"; ?>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="<?php echo asset('js/app.js'); ?>"></script>
</body>
</html>
