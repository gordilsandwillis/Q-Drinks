<?php snippet('head', array('headerClass' => 'inverted')) ?>

  <main class="accolades" role="main">
    <? snippet('page-hero', [
      'image' => $page->image($page->headerImage()),
      'video' => $page->headerVideo(),
      'pushDown' => $page->topText()->isNotEmpty(),
      'entrance' => false
    ]) ?>

    <?php snippet('section-header', array('text' => 'Accolades', 'tag' => 'h1')) ?>

    <section class="accolades-list">
      <div class="container">
        <div class="inline-grid middle center">
          <?php foreach($page->builder()->toStructure() as $section): ?>
            <?php snippet('sections/' . $section->_fieldset(), array('data' => $section)) ?>
          <?php endforeach ?>
        </div>
      </div>
    </section>

    <!-- <div class="project-footer dark">
      <?php //snippet('prevnext') ?>
    </div> -->
  </main>

<?php snippet('footer', ['footerClass' => '']) ?>