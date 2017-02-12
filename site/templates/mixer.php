<?php snippet('head') ?>

<main class="mixer" role="main">

  <section class="mixer-intro">
    <div class="container very-narrow">
      <div class="inline-grid center middle">
        <div class="col-6">
          <div class="img-wrap">
            <?php if ($page->images()->find($page->mixerImage())) : ?>
              <img src="<?= $page->images()->find($page->mixerImage())->crop(600, 1000)->url() ?>" alt="<?= $page->title()->html() ?>">
            <?php endif; ?>
          </div>
        </div>
        <div class="col-6">
          <div class="text-wrap">
            <h1>Q <?= $page->title()->html() ?></h1>
            <?= $page->description()->kirbytext() ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <section class="white ingredient-images">
    <?php snippet('section-header', ['text' => 'Ingredients']) ?>
    <div class="container narrow">
      <?php foreach($page->builder()->toStructure() as $section): ?>
        <?php snippet('sections/' . $section->_fieldset(), array('data' => $section)) ?>
      <?php endforeach ?>
    </div>
  </section>

  <section class="mixer-recipes">
    <?php snippet('section-header', ['text' => 'Spectacular With', 'transition' => 'transition-in']) ?>
    <div class="container transition-in">
      <div class="slideshow recipe-slideshow">
      <? $recipes = page('highball')->children()->visible(); ?>
      <?php foreach($recipes as $recipe): ?>
        <? $recipeTitle = $recipe->title() ?>
        <? $mixer = $recipe->recipeMixer() ?>
        <? $title = $page->slug() ?>
        <? if ($mixer == $title): ?>
          <div>
            <div class="recipe-card">
              <div class="image">
                <div class="bg-image" style="background-image: url(<?= $recipe->image()->crop(750, 750)->url() ?>);">
                  <img src="<?= $recipe->image()->crop(750, 750)->url() ?>">
                </div>
              </div>

              <div class="instructions">
                <div class="curved-serves">
                  <span class="letter s">S</span><span class="letter e">e</span><span class="letter r">r</span><span class="letter v">v</span><span class="letter e2">e</span><span class="letter s2">s</span>
                  <span class="number">00</span>
                </div>
                <div class="container">
                  <h3 class="recipe-title"><?= $recipe->title()->html() ?></h3>
                  
                  <h5 class="recipe-section-title">Ingredients</h5>
                  <ul>
                  <?php foreach($recipe->ingredients()->toStructure() as $step): ?>
                    <li><p><?= $step->ingredient()->html() ?></p></li>
                  <?php endforeach ?>
                  </ul>

                  <h5 class="recipe-section-title">Variations</h5>
                  <p><?= $recipe->variations()->html() ?></p>
                  
                  <h5 class="recipe-section-title">Method</h5>
                  <p>
                  <?php foreach($recipe->method()->toStructure() as $step): ?>
                    <?= $step->step()->html() ?>
                  <?php endforeach ?>
                  </p>
                </div>
              </div>

            </div>
          </div>
        <? endif; ?>
      <?php endforeach ?>
      </div>
      <div class="more-btn-wrap">
        <a href="<?= url() ?>/highball#recipes" class="btn">More Recipes</a>
      </div>
    </div>
    <div class="bg-color" style="background-color: <?= $page->mixerColor() ?>"></div>
  </section>

  <section class="other-mixers grey">
    <?php snippet('section-header', ['text' => 'Other Products', 'transition' => 'transition-in']) ?>
    <div class="container">
      <?php snippet('mixer-list', ['siblings' => 'true', 'limit' => 4, 'order' => 'shuffle']) ?>
    </div>
  </section>

  <!-- <div class="project-footer dark">
    <?php //snippet('prevnext') ?>
  </div> -->

</main>

<?php snippet('footer') ?>