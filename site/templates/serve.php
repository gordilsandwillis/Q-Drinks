<?php snippet('head', array('headerClass' => 'inverted')) ?>

  <main class="serve padded-bottom" role="main">
    <div class="top-area">
    	<div class="top-image fancy-entrance">
        <?php if ($page->images()->find($page->headerImage())) : ?>
          <div class="bg-image parallax-top" style="background-image: url(<?php echo $page->images()->find($page->headerImage())->crop(2000, 1500)->url() ?>)">
          </div>
        <?php endif; ?>
    	</div>
      <!-- <div class="text-overlay">
        <div class="container">
          <h1><?= $page->topText()->html() ?></h1>
        </div>
      </div> -->
    </div>
  	<div class="section-header">
	    <div class="container">
	      <h1>Step By Step</h1>
	    </div>
    </div>

    <section class="serve-steps">
      <div class="container">
        <?php foreach($page->builder()->toStructure() as $section): ?>
          <?php snippet('sections/' . $section->_fieldset(), array('data' => $section)) ?>
        <?php endforeach ?>
      </div>
    </section>

  </main>

<?php snippet('footer') ?>