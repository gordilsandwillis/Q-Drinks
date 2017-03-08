<? if ($data->picture()->isNotEmpty()): ?>
<section class="alternating-blocks">
	<div class="ingredient-block <?= $data->style()->html() ?>">
		<div class="row transition-in">
			<div class="col-6 parallax-block"><img src="<?= $page->image($data->picture())->crop(900, 600)->url();?>"></div>
			<div class="col-6 parallax-block-opposite">
				<div class="info">
					<div>
						<h5><?= $data->title()->html() ?></h5>
						<p><?= $data->description()->html() ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<? endif; ?>