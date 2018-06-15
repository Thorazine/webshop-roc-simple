<h2>Winkelmand</h2>
<div class="bucket-content">
	<table class="table">
		<thead>
			<tr>
				<td>Artikelen</td>
				<td>Aantal</td>
				<td>Prijs</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($_SESSION['cart']['products'] as $item) { ?>
				<tr>
					<td><?php echo $item['title']; ?></td>
					<td class="oneline">
						<?php echo $item['quantity']; ?>
						<button type="button" class="btn btn-success btn-xs add-to-cart" data-url="<?php echo asset('cart/add.php?id='.$item['id']); ?>">+</button>
						<button type="button" class="btn btn-danger btn-xs remove-from-cart" data-url="<?php echo asset('cart/remove.php?id='.$item['id']); ?>">-</button>
					</td>
					<td>&euro; <?php echo $item['price']; ?></td>
				</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td>Subtotaal</td>
				<td></td>
				<td class="oneline">&euro; <?php echo $_SESSION['cart']['total']; ?></td>
			</tr>
		</tfoot>
	</table>

	<a href="<?php echo asset('pay'); ?>" class="btn btn-success">Afrekenen</a>
</div>
