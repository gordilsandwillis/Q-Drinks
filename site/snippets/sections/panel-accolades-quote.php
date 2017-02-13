<section>
	<div class="panel-block">
		<div class="panel-text centered">
			<?php if ($data->quote()->isNotEmpty()): ?>
				<p><?= $data->quote()->html() ?></p>
			<?php endif ?>
			<?php if ($data->by()->isNotEmpty()): ?>
				<h5><?= $data->by()->html() ?></h5>
			<?php endif ?>
		</div>
	</div>
</section>