<li class="flex-col team-thumb-toggle">
	<div class="team-thumb">
		<a class="team-thumb-link"
			data-bg-color="rgb(255,250,25)"
			href="#"
		>
			<div class="img-wrap">
				<img src="<?= $page->image($data->image())->crop(600, 450)->url(); ?>" width="600" height="450" >
			</div>
			<h3 class="thumb-title"><?= $data->name()->html() ?></h3>
		</a>
	</div>
	<div class="nipple-wrap">
		<span class="nipple"></span>
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
						<p><?= $data->description()->html() ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="bg-color" style="background-color: currentcolor"></div>
</div>
