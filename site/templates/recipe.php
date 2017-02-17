<?php snippet('head') ?>

  <main class="recipe" role="main">

  	<? $recipeMixer = $page->recipeMixer()->html() ?>
  	<? $mixerPage = page('mixers')->children()->find($recipeMixer); ?>

  	<div class="recipe-card" style="background-color: <?= $mixerPage->mixerColor() ?>">
      <div class="image">
        <div class="bg-image" style="background-image: url(<?= $page->image()->crop(1500)->url() ?>);">
          <img src="<?= $page->image()->crop(750, 750)->url() ?>">
        </div>
      </div>

      <div class="instructions">
        <div class="curved-serves">
          <span class="letter s">S</span><span class="letter e">e</span><span class="letter r">r</span><span class="letter v">v</span><span class="letter e2">e</span><span class="letter s2">s</span>
          <span class="number">00</span>
        </div>
        <div class="container">
          <h3 class="recipe-title"><?= $page->title()->html() ?></h3>
          <div class="inline-grid">
	          <div class="col-6">
		          <h5 class="recipe-section-title">Ingredients</h5>
		          <ul>
		          <?php foreach($page->ingredients()->toStructure() as $step): ?>
		            <li><p><?= $step->ingredient()->html() ?></p></li>
		          <?php endforeach ?>
		          </ul>
		        </div>
		        <div class="col-6">
		          <h5 class="recipe-section-title">Variations</h5>
		          <p><?= $page->variations()->html() ?></p>
          	</div>
          </div>
          
          <h5 class="recipe-section-title">Method</h5>
          <p>
          <?php foreach($page->method()->toStructure() as $step): ?>
            <?= $step->step()->html() ?>
          <?php endforeach ?>
          </p>
          <ul class="share-recipe">
            <li><a href="#"><span class="icon"><?php snippet('icons/fb-icon') ?></span></a></li>
            <li><a href="#"><span class="icon"><?php snippet('icons/twitter-icon') ?></span></a></li>
            <li><a href="#"><span class="icon"><?php snippet('icons/pinterest-icon') ?></span></a></li>
            <li><a href="#"><span class="icon"><?php snippet('icons/email-icon') ?></span></a></li>
          </ul>
        </div>
      </div>

    </div>
    
    <?php snippet('section-header', ['text' => 'More Recipes']) ?>

    <section class="recipe-list">
      <div class="container">
        <?php snippet('recipe-list', ['limit' => 100]) ?>
      </div>
    </section>
  </main>

<?php snippet('footer') ?>