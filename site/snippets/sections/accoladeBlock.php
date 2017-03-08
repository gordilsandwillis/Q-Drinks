<section class="col-4">
	<div class="accolade-block">
		<div class="info">
			<? if ($data->quote()->html()) : ?>
				<h5 class="quote">
					<?= $data->quote()->html() ?>
				</h5>
			<? endif; ?>
			<? if ($data->by()->html()) : ?>
				<p class="quote-by">
					<?= $data->by()->html() ?>
				</p>
			<? endif; ?>
		</div>
	</div>
</section>