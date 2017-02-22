<section>
	<div class="panel-block">
		<?php if ($data->desktopImage()->isNotEmpty()): ?>
			<div style="max-width: none; width: 50%;" class="panel-image">
				<h4>Desktop</h4>
				<img style="margin: 10px 0;" src="<?= $page->image($data->desktopImage())->crop(600, 400)->url();?>">
				<?php if ($data->desktopTextColor()->isNotEmpty()): ?>
					<div style="border: 1px solid #ccc; width: 26px; height: 26px; background: #<?= $data->desktopTextColor()->html() ?>; border-radius: 3px; display: inline-block; vertical-align: middle; margin-right: 7px;"></div>
					<h5 style="display: inline-block; vertical-align: middle;">Desktop Text Color</h5>
				<?php endif ?>
			</div>
		<?php endif ?>
		<?php if ($data->mobileImage()->isNotEmpty()): ?>
			<div style="max-width: none; width: 24.5%;" class="panel-image">
				<h4>Mobile</h4>
				<img style="margin: 10px 0;" src="<?= $page->image($data->mobileImage())->crop(400, 600)->url();?>">
				<?php if ($data->mobileTextColor()->isNotEmpty()): ?>
					<div style="border: 1px solid #ccc; width: 26px; height: 26px; background: #<?= $data->mobileTextColor()->html() ?>; border-radius: 3px; display: inline-block; vertical-align: middle; margin-right: 7px;"></div>
					<h5 style="display: inline-block; vertical-align: middle;">Mobile Text Color</h5>
				<?php endif ?>
			</div>
		<?php endif ?>
	</div>
</section>