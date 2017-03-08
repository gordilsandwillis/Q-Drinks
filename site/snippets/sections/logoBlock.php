<? if ($page->image($data->logoImage())) : ?>
	<section>
		<div class="logo-block">
			<img src="<?= $page->image($data->logoImage())->crop(900, 600)->url();?>">
		</div>
	</section>
<? endif; ?>