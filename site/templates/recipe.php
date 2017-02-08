<?php snippet('head') ?>

<main class="recipe" role="main">
  <div class="container">
    <h1><?= $page->title()->html() ?></h1>
  </div>
  
  <section class="project-images">
    <div class="container">
      <div class="inline-grid middle center">
        <?php foreach($page->builder()->toStructure() as $section): ?>
          <?php snippet('sections/' . $section->_fieldset(), array('data' => $section)) ?>
        <?php endforeach ?>
      </div>
    </div>
  </section>

  <div class="project-footer dark">
    <?php snippet('prevnext') ?>
  </div>

</main>

<?php snippet('footer') ?>