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
    <?php snippet('section-header', ['text' => 'Spectacular With']) ?>
    <div class="container">
      <?php $page->mixerRecipes()->html() ?>
    </div>
    <div class="bg-color" style="background-color: <?= $page->mixerColor() ?>"></div>
  </section>

  <section class="other-mixers grey">
    <?php snippet('section-header', ['text' => 'Other Products']) ?>
    <div class="container">
      <?php snippet('mixer-list', ['siblings' => 'true', 'limit' => 4, 'order' => 'shuffle']) ?>
    </div>
  </section>

  <!-- <div class="project-footer dark">
    <?php //snippet('prevnext') ?>
  </div> -->

</main>

<?php snippet('footer') ?>