<?php snippet('head', array('headerClass' => 'inverted')) ?>

  <main class="accolades" role="main">
    <div class="top-area">
      <div class="top-image">
        <?php if ($page->images()->find($page->headerImage())) : ?>
          <div class="bg-image parallax-top" style="background-image: url(<?php echo $page->images()->find($page->headerImage())->url() ?>)">
            <img src="<?php echo $page->images()->find($page->headerImage())->url() ?>">
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="section-header">
      <div class="container">
        <h1>Accolades</h1>
      </div>
    </div>

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

<?php snippet('footer') ?>