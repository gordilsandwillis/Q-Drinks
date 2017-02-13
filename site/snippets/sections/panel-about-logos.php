<section>
	<div class="panel-block">
		<?php if ($data->logoImage()->isNotEmpty()): ?>
			<div class="panel-image">
				<img src="<?= $page->image($data->logoImage())->crop(600, 400)->url();?>">
			</div>
		<?php endif ?>
	</div>
</section>