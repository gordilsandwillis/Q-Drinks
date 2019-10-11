<? if ($data->picture()->isNotEmpty()): ?>
<section class="alternating-blocks">
	<div class="ingredient-block <?= $data->style()->html() ?>">
		<div class="row transition-in">
			<div class="col-6 parallax-block">
				<div class="media-wrap<? if ( $data->fullVideo->isNotEmpty()): ?> has-full-video<? endif ?>">
					<? if ( $data->coverVideo->isNotEmpty()): ?>
						<div class="video-wrap video-trigger">
							<video autoplay loop muted playsinline>
					      <source src="<?= $page->url() . '/' . $data->coverVideo() ?>" type="video/mp4">
					    </video>
						</div>
					<? else: ?>
						<div class="img-wrap video-trigger">
							<img src="<?= $page->image($data->picture())->crop(900, 600)->url();?>">
						</div>
					<? endif ?>

					<? if ( $data->fullVideo->isNotEmpty()): ?>
						<video class="full-video" playsinline controls>
				      <source src="<?= $page->url() . '/' . $data->fullVideo() ?>" type="video/mp4">
				    </video>
					<? endif ?>

				</div>
			</div>
			<div class="col-6 parallax-block-opposite">
				<div class="info">
					<div>
						<h5><?= $data->title()->html() ?></h5>
						<p><?= $data->description()->html() ?></p>
						<? if ($data->buttonLabel()->isNotEmpty() && $data->buttonLink()->isNotEmpty()) : ?>
							<a href="<?= $data->buttonLink()->html() ?>" target="<? if ($data->buttonNewTab()->isNotEmpty()) : ?>_blank<? endif ?>" class="btn lg"><?= $data->buttonLabel()->html() ?></a>
						<? endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<? endif; ?>