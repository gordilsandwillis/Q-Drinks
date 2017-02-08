<?php snippet('head', array('headerClass' => 'inverted')) ?>

  <main class="highball" role="main">
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
	      <h1>Recipes</h1>
	    </div>
    </div>
    <section class="recipe-list">
      <div class="container">
        <?php snippet('recipe-list', ['limit' => 100]) ?>
      </div>
    </section>
  </main>

<?php snippet('footer') ?>