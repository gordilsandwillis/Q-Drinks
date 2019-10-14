<?php snippet('head', array('headerClass' => 'inverted')) ?>

  <main class="mixers" role="main">

    <? snippet('page-hero', [
      'image' => $page->image($page->headerImage()),
      'video' => $page->headerVideo()
    ]) ?>

    <?php snippet('section-header', array('text' => 'Our Mixers', 'tag' => 'h1')) ?>
    <?php if ($page->introText()->isNotEmpty()):?>
      <div class="container very-narrow align-center intro-p">
        <?= $page->introText()->kirbytext() ?>
      </div>
    <?php endif; ?>

    <section class="mixers">
      <div class="container">
        <?php snippet('mixer-list', ['limit' => 100]) ?>
      </div>
    </section>

  </main>

<?php snippet('footer', ['footerClass' => '']) ?>