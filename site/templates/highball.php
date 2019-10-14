<?php snippet('head', array('headerClass' => 'inverted')) ?>

  <main class="highball" role="main">
    <? snippet('page-hero', [
      'image' => $page->images()->find($page->headerImage()),
      'video' => $page->headerVideo(),
      'limit' => 6,
      'order' => 'shuffle'
    ]) ?>

    <?php snippet('section-header', array('text' => 'Recipes', 'tag' => 'h1')) ?>
    <?php if ($page->introText()->isNotEmpty()):?>
      <div class="container very-narrow align-center intro-p">
        <p><?= $page->introText()->html() ?></p>
      </div>
    <?php endif; ?>
    <section class="recipe-list">
      <div class="container">
        <?php snippet('recipe-list', ['limit' => 100]) ?>
      </div>
    </section>
  </main>

<?php snippet('footer', ['footerClass' => '']) ?>