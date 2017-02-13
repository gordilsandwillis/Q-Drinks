<section>
	<div class="panel-block">
		<?php if ($data->packageImage()->isNotEmpty()): ?>
			<div class="panel-image">
				<img src="<?= $page->image($data->packageImage())->crop(800, 600)->url();?>">
			</div>
		<?php endif ?>
		<div class="panel-text">
			<?php if ($data->volume()->isNotEmpty()): ?>
				<h5><?= $data->volume()->html() ?></h5>
			<?php endif ?>
			<?php if ($data->flavors()->isNotEmpty()): ?>
				<p><?= $data->flavors()->html() ?></p>
			<?php endif ?>
		</div>
	</div>
</section>