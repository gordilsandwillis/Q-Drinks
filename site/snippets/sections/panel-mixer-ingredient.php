<section>
	<div class="panel-block">
		<?php if ($data->picture()->isNotEmpty()): ?>
			<div class="panel-image">
				<img src="<?= $page->image($data->picture())->crop(600)->url();?>">
			</div>
		<?php endif ?>
		<div class="panel-text">
			<?php if ($data->title()->isNotEmpty()): ?>
				<h5><?= $data->title()->html() ?></h5>
			<?php endif ?>
			<?php if ($data->description()->isNotEmpty()): ?>
				<p><?= $data->description()->html() ?></p>
			<?php endif ?>
		</div>
	</div>
</section>