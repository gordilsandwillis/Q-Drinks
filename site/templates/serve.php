<?php snippet('head', array('headerClass' => 'inverted')) ?>

  <main class="serve padded-bottom" role="main">
    <? if ( $page->headerImage()->isNotEmpty() or $page->headerVideo()->isNotEmpty() ):?>
    <? snippet('page-hero', [
      'image' => $page->image($page->headerImage()),
      'video' => $page->headerVideo(),
      'pushDown' => $page->topText()->isNotEmpty()
    ]) ?>
    <? endif ?>

    <? if ( $page->topText()->isNotEmpty() ): ?>
      <div>
        <div class="container narrow">
          <div class="text-wrap lg right align-center">
            <p><?= $page->topText()->html() ?></p>
          </div>
        </div>
      </div>
    <? endif ?>

    <?php snippet('section-header', array('text' => 'Step By Step', 'tag' => 'h1')) ?>

    <section class="serve-steps">
      <div class="container">
        <?php foreach($page->builder()->toStructure() as $section): ?>
          <?php snippet('sections/' . $section->_fieldset(), array('data' => $section)) ?>
        <?php endforeach ?>
      </div>
    </section>

  </main>

<?php snippet('footer', ['footerClass' => '']) ?>