<section>
	<div class="panel-block">
		<?php if ($data->image()->isNotEmpty()): ?>
			<div class="panel-image">
				<img src="<?= $page->image($data->image())->crop(800, 600)->url();?>">
			</div>
		<?php endif ?>
		<div class="panel-text">
			<?php if ($data->name()->isNotEmpty()): ?>
				<h5><?= $data->name()->html() ?></h5>
			<?php endif ?>
			<?php if ($data->title()->isNotEmpty()): ?>
				<h5><?= $data->title()->html() ?></h5>
			<?php endif ?>
			<?php if ($data->description()->isNotEmpty()): ?>
				<p><?= $data->description()->html() ?></p>
			<?php endif ?>
		</div>
	</div>
</section>