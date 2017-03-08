<? if ($page->image($data->packageImage())) : ?>
<section>
	<div class="package-block">
		<img src="<?= $page->image($data->packageImage())->crop(750)->url();?>">
		<div>
			<h5><?= $data->volume()->html() ?></h5>
			<p><?= $data->flavors()->html() ?></p>
		</div>
	</div>
</section>
<? endif; ?>