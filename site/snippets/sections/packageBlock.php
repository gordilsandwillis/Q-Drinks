<section>
	<div class="package-block">
		<img src="<?= $page->image($data->packageImage())->crop(900, 600)->url();?>">
		<div class="info">
			<h5 class="quote"><?= $data->volume()->html() ?></h5>
			<p class="quote-by"><?= $data->flavors()->html() ?></p>
		</div>
	</div>
</section>