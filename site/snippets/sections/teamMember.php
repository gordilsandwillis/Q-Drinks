<li class="flex-col team-thumb-toggle">
	<div class="team-thumb">
		<a class="team-thumb-link"
			data-bg-color="rgb(243,243,245)"
		>
			<div class="img-wrap">
				<img src="<?= $page->image($data->image())->crop(600, 600)->url(); ?>" width="600" height="600" >
			</div>
			<h3 class="thumb-title"><?= $data->name()->html() ?></h3>
		</a>
	</div>
</li>
<div class="flex-col inline-team">
	<div class="nipple-wrap">
		<div class="nipple-container">
				<div></div>
			</div>
			<div class="close-team">Close</div>
	</div>
	<div class="inline-team-wrap">
		<div class="container">
			<div class="inline-grid break-lg">
				<div class="col-4">
					<div class="team-section">
						<h3><?= $data->title()->html() ?></h3>
					</div>
				</div>
				<div class="col-8">
					<div class="team-section">
						<p class="team-description"><?= $data->description()->html() ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="bg-color" style="background-color: currentcolor"></div>
</div>
