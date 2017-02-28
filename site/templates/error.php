<?php snippet('head') ?>

  <main class="error" role="main">

    <div class="container">
    	<div>
	      <h1>There has been a mix up</h1>
	      <div class="lg">
		      <p>The page you are looking for has not been found</p>
	      </div>
	      <section class="other-mixers grey">
			    <?php snippet('section-header', ['text' => 'Other Products', 'transition' => 'transition-in']) ?>
			    <div class="container 4-up-grid">
			      <?php snippet('mixer-list', ['limit' => 4, 'order' => 'shuffle']) ?>
			    </div>
			  </section>
	      <a href="<?= url() ?>/mixers" rel="home" title="All Mixers" class="btn large">All Mixers</a>
      </div>
    </div>

  </main>

<?php snippet('footer', ['footerClass' => '']) ?>