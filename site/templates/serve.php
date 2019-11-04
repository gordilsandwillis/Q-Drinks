<?
  $showLocator = $page->showLocator();
  if($page->headerText()->isNotEmpty())
    $headerText = $page->headerText();
  else
    $headerText = 'Step By Step';
?>

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

    <?php snippet('section-header', array('text' => $headerText, 'tag' => 'h1')) ?>

    <section class="serve-steps">
      <div class="container">
        <?php foreach($page->builder()->toStructure() as $section): ?>
          <?php snippet('sections/' . $section->_fieldset(), array('data' => $section)) ?>
        <?php endforeach ?>
      </div>
    </section>

    <? if($page->showForm() == '1'): ?>
      <section class="transition-in serve-form" <? if($page->showBottomVideo()->isNotEmpty()): ?>style="margin-bottom: 7.5%"<? endif; ?>>
        <div class="container narrow">
          <? if($page->formHeader()->isNotEmpty()): ?>
            <? snippet('section-header', ['text' => $page->formHeader()]) ?>
          <? endif; ?>

          <? if($page->formIntroText()->isNotEmpty()): ?>
            <div class="text-wrap lg right align-center">
              <p><?= $page->formIntroText()->html() ?></p>
            </div>
          <? endif; ?>

          <form class="serve-form-element">
            <div class="row">
              <div class="col-6"><input type="text" name="Name" required placeholder="Name*"></div>
              <div class="col-6"><input type="text" name="Email" required placeholder="Email*" validation="email"></div>
              <div class="col-6"><input type="text" name="Instagram" required placeholder="Instagram Handle*"></div>
              <div class="col-6"><input type="text" name="Birthday" required placeholder="Birthday (MM/DD/YY)*"></div>
              <div class="col-12"><input type="text" name="Address" required placeholder="Address*"></div>
            </div>
            <button type="submit" class="large" disabled="false">Submit</button>
          </form>
        </div>
      </section>
    <? endif; ?>

    <? if($showLocator == '1'): ?>
      <section class="white transition-in" <? if($page->showBottomVideo()->isNotEmpty()): ?>style="margin-bottom: 7.5%"<? endif; ?>>
        <?php snippet('section-header', ['text' => 'Find Q Near You']) ?>
        <div class="container">
          <div class="easy-locator-wrap">
            <!-- Begin Easy Locator Store Locator Service //-->
            <iframe id="EasyLocator" width="780" height="530" scrolling="no" frameborder="0" src="https://www.easylocator.net/search/map3/Q Drinks 2017" allowtransparency="true"></iframe>
            <!-- End Easy Locator Store Locator Service //-->
          </div>
        </div>
      </section>
    <? endif; ?>

    <? if($page->showBottomVideo()->isNotEmpty()): ?>
      <section class="transition-in">
        <div class="container" style="max-width: 800px;">
          <div class="media-wrap has-full-video">
            <div class="yt-embed-wrap">
              <iframe class="full-video" width="560" height="315" src="https://www.youtube.com/embed/<?= $page->showBottomVideo() ?>?rel=0&controls=1&showinfo=0&loop=1&modestbranding=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </section>
    <? endif; ?>

  </main>

<?php snippet('footer', ['footerClass' => '']) ?>