<?php snippet('head', array('headerClass' => 'inverted')) ?>

  <main class="inspiration padded-bottom" role="main">

    <div class="top-area">

      <? snippet('page-hero', [
        'image' => $page->image($page->headerImage()),
        'video' => $page->headerVideo(),
        'pushDown' => true,
        'entrance' => false
      ]) ?>

      <div class="">
        <div class="container narrow">
          <div class="text-wrap lg right align-center">
            <p><?= $page->topText()->html() ?></p>
          </div>
        </div>
      </div>
    </div>

    <section class="inspiration-text">
      <div class="container very-narrow align-center">
  	    <?= $page->inspirationText()->kirbytext() ?>
        <?php if ($page->images()->find($page->signatureImage())) : ?>
          <div class="signature">
            <img 
              src="<?= $page->images()->find($page->signatureImage())->url() ?>"
              width="<?= $page->images()->find($page->signatureImage())->width() / 2 ?>"
              height="<?= $page->images()->find($page->signatureImage())->height() / 2 ?>"
            />
          </div>
        <?php endif; ?>
        <p>
          <?= $page->signatureName()->html() ?>
        </p>
      </div>
    </section>
  </main>

<?php snippet('footer', ['footerClass' => '']) ?>