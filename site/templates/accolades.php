<?php snippet('head', array('headerClass' => 'inverted')) ?>

  <main class="accolades" role="main">
    <div class="top-area">
      <div class="top-image">
        <?php if ($page->images()->find($page->headerImage())) : ?>
          <div class="bg-image parallax-top" style="background-image: url(<?php echo $page->images()->find($page->headerImage())->focusCrop(2000, 1500)->url() ?>)">
          </div>
        <?php endif; ?>
      </div>
    </div>

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