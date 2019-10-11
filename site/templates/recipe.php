<?php snippet('head') ?>

  <main class="recipe" role="main">

  	<? $recipeMixer = $page->recipeMixer()->html() ?>
  	<? $mixerPage = page('mixers')->children()->find($recipeMixer); ?>

  	<div class="recipe-card" style="background-color: <?= $mixerPage->mixerColor() ?>">
      <div class="image">
        <div class="media-wrap">
          <? if ($page->video()) :?>
            <video autoplay loop muted playsinline>
              <source src="<?= $page->video()->url() ?>" type="video/mp4">
            </video>
          <? else :?>
            <img
              sizes="(max-width: 1000px) 100vw, (max-width: 3000px) 50vw"
              srcset="<?= $page->image()->crop(800)->url() ?> 800w,
            <?= $page->image()->crop(1000)->url() ?> 1000w,
            <?= $page->image()->crop(1500)->url() ?> 1500w,
            <?= $page->image()->crop(2000)->url() ?> 2000w"
              src="<?= $page->image()->crop(800)->url() ?>"
              alt="<?= $page->title()->html() ?>"/>
          <? endif ?>
        </div>
      </div>

      <div class="instructions">
        <div class="curved-serves">
          <span class="letter s">S</span><span class="letter e">e</span><span class="letter r">r</span><span class="letter v">v</span><span class="letter e2">e</span><span class="letter s2">s</span>
          <span class="number"><?= $page->servingsNumber()->html(); ?></span>
        </div>
        <div class="container">
          <h1 class="recipe-title"><?= $page->title()->html(); ?></h1>
          <div class="inline-grid">
	          <div class="col-6">
		          <h4 class="recipe-section-title">Ingredients</h4>
		          <ul>
		          <?php foreach($page->ingredients()->toStructure() as $step): ?>
		            <li><p><?= $step->ingredient()->html() ?></p></li>
		          <?php endforeach ?>
		          </ul>
		        </div>
		        <div class="col-6">
		          <h4 class="recipe-section-title">Variations</h4>
		          <p><?= $page->variations()->html() ?></p>
          	</div>
          </div>

          <h4 class="recipe-section-title">Method</h4>
          <?php foreach($page->method()->toStructure() as $step): ?>
            <?= $step->step()->kirbytext() ?>
          <?php endforeach ?>
          <ul class="share-recipe">
            <li><a target="_blank" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=700,height=700,toolbar=1,resizable=0'); return false;" href="https://www.facebook.com/sharer.php?u=<?= $page->url() ?>"><span class="icon"><?php snippet('icons/fb-icon') ?></span></a></li>
                  <li><a target="_blank" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=600,height=600,toolbar=1,resizable=0'); return false;" href="https://twitter.com/intent/tweet?url=<?= $page->url() ?>&text=<?= $page->title() ?> using Q <?= $page->recipeMixer()->title()->html() ?>&hashtags=Mixer,QDrinks"><span class="icon"><?php snippet('icons/twitter-icon') ?></span></a></li>
                  <li><a target="_blank" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=750,height=700,toolbar=1,resizable=0'); return false;" href="http://pinterest.com/pin/create/button/?url=<?= $page->url() ?>&media=<?= $page->image()->crop(750, 750)->url();?>&description=<?= $page->title() ?> using Q <?= $page->recipeMixer()->title()->html() ?>"><span class="icon"><?php snippet('icons/pinterest-icon') ?></span></a></li>
                  <li><a target="_blank" href="mailto:?subject=Q Mixer Recipe&amp;body=Check out this drink recipe using Q <?= $page->recipeMixer()->title()->html() ?> <?= $page->url(); ?>."
   title="Share by Email""><span class="icon"><?php snippet('icons/email-icon') ?></span></a></li>
          </ul>
        </div>
      </div>

    </div>

    <?php snippet('section-header', ['text' => 'More Recipes']) ?>

    <section class="recipe-list">
      <div class="container">
        <?php snippet('recipe-list', ['siblings' => 'true', 'limit' => 100, 'order' => 'shuffle']) ?>
      </div>
    </section>

  </main>

<?php snippet('footer', ['footerClass' => '']) ?>