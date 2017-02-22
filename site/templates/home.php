<?php snippet('head', array('headerClass' => 'inverted')) ?>

  <main class="home" role="main">
  	<div class="top-area">
	    <div class="top-image fancy-entrance full-height">
		    <div class="bg-image" style="background-image: url(<?= $page->images()->shuffle()->first()->crop(2000, 1500)->url() ?>)">
		    </div>
	    </div>
	    <div class="text-overlay">
	    	<div class="container">
	    		<h1 class="hidden">Q:<?= $page->headline()->html() ?></h1>
		      <div class="headline">
		      	<div class="h1-wrap">
			      	<div class="q-question">
			      		<?php snippet('icons/logo') ?>
			      		<span class="colon">:</span>
			      	</div>
			      	<h2 class="text">
				      	<?= $page->headline()->html() ?>
			      	</h2>
		      	</div>
		      </div>
		    </div>
	    </div>
    </div>
  </main>

<?php snippet('footer', array('footerClass' => 'no-space')) ?>