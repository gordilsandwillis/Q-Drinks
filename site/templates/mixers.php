<?php snippet('head', array('headerClass' => 'inverted')) ?>

  <main class="mixers" role="main">
  	<div class="top-area">
    	<div class="top-image fancy-entrance">
    		<?php if ($page->images()->find($page->headerImage())) : ?>
          <div class="bg-image parallax-top" style="background-image: url(<?php echo $page->images()->find($page->headerImage())->crop(2000, 1500)->url() ?>)">
          </div>
        <?php endif; ?>
    	</div>
    </div>

    <?php snippet('section-header', ['text' => 'Our Mixers']) ?>
    <?php if ($page->introText()->isNotEmpty()):?>
      <div class="container very-narrow align-center intro-p">
        <p><?= $page->introText()->html() ?></p>
      </div>
    <?php endif; ?>

    <section class="mixers">
      <div class="container">
        <?php snippet('mixer-list', ['limit' => 100]) ?>
      </div>
    </section>

  </main>

<?php snippet('footer', ['footerClass' => '']) ?>