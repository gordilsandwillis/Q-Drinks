<?php snippet('head', array('headerClass' => 'inverted')) ?>

  <main class="home" role="main">
  	<div class="top-area">
	    <div class="top-image full-height">
		    <div class="bg-image" style="background-image: url(<?= $page->image()->crop(2000, 1500)->url();?>)">
		    	<?= $page->image()->crop(800, 600);?>
		    </div>
	    </div>
	    <div class="text-overlay">
	    	<div class="container">
		      <h1>
		      	<div class="h1-wrap">
			      	<div class="q-question">
			      		<?php snippet('icons/logo') ?>
			      		<span class="colon">:</span>
			      	</div>
			      	<div class="text">
				      	<?= $page->headline()->html() ?>
			      	</div>
		      	</div>
		      </h1>
		    </div>
	    </div>
    </div>
  </main>

<?php snippet('footer', array('footerClass' => 'no-space')) ?>