<?php snippet('head', array('headerClass' => 'inverted')) ?>

  <main class="inspiration padded-bottom" role="main">

    <div class="top-area padded-bottom">
      <div class="top-image push-down">
        <?php if ($page->images()->find($page->headerImage())) : ?>
          <div class="bg-image parallax-top" style="background-image: url(<?php echo $page->images()->find($page->headerImage())->focusCrop(2000, 1500)->url() ?>)">
          </div>
        <?php endif; ?>
      </div>
      <div class="text-overlay">
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
            <img src="<?php echo $page->images()->find($page->signatureImage())->url() ?>">
          </div>
        <?php endif; ?>
        <p>
          <?= $page->signatureName()->html() ?>
        </p>
      </div>
    </section>
  </main>

<?php snippet('footer', ['footerClass' => '']) ?>