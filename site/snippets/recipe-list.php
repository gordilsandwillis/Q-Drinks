<?php
$highball = page('highball')->children()->visible();

/*

The $limit parameter can be passed to this snippet to
display only a specified amount of projects:

```
<?php snippet('showcase', ['limit' => 3]) ?>
```

Learn more about snippets and parameters at:
https://getkirby.com/docs/templates/snippets

*/

// if(isset($siblings))  $highball = $page->siblings($self = false);
if(isset($limit))     $highball = $highball->limit($limit);
if(isset($order))     $highball = $highball->shuffle();

?>

<ul class="flex-grid">

  <? foreach($highball as $recipe): ?>

    <li class="flex-col recipe-thumb-toggle">
      <? $recipeMixer = $recipe->recipeMixer(); ?>
      <? $findString = 'mixers/' . $recipeMixer; ?>
      <? $recipeMixerPage = $pages->find($findString); ?>
      <div class="recipe-thumb">
      <a class="recipe-thumb-link" data-bg-color="<?= $recipeMixerPage->mixerColor()->html() ?>" data-path="<?= $recipe ?>" href="<?= $recipe->url() ?>" title="<?= $recipe->title()->html() ?>" >
          <div class="img-wrap">
            <img src="<?= $recipe->image()->focusCrop(600, 450)->url();?>" alt="<?= $recipe->title()->html() ?>" width="600" height="450" >
          </div>
          <h3 class="thumb-title"><?= $recipe->title()->html() ?></h3>
          <h6 class="recipe-mixer">Q <?= $recipeMixerPage->title()->html() ?></h6>
        </a>
      </div>
      <div class="nipple-wrap">
        <span class="nipple" style="border-bottom-color: <?= $recipeMixerPage->mixerColor()->html() ?>"></span>
      </div>
    </li>

    <div class="flex-col inline-recipe" style="color: <?= $recipeMixerPage->mixerColor()->html() ?>">
      <div class="nipple-wrap">
        <div class="nipple-container">
          <div></div>
        </div>
        <div class="close-recipe">Close</div>
      </div>
      <div class="inline-recipe-wrap">
        <div class="container">
          <div class="inline-grid break-lg">
            <div class="col-4">
              <div class="recipe-section">
                <h3>Ingredients</h3>
                <ul>
                  <? foreach($recipe->ingredients()->toStructure() as $step): ?>
                    <li><p><?= $step->ingredient()->html() ?></p></li>
                  <? endforeach ?>
                </ul>
              </div>
              <div class="recipe-section">
                <h3>Serving</h3>
                <p><?= $recipe->servings()->html() ?></p>
              </div>
            </div>

            <div class="col-4">
              <div class="recipe-section">
                <h3>Method</h3>
                <p><?= $recipe->method()->html() ?></p>
              </div>
            </div>

            <div class="col-4">
              <div class="recipe-section">
                <h3>Variations</h3>
                <p><?= $recipe->variations()->html() ?></p>
              </div>
              <div class="recipe-section">
                <h3>Share Recipe</h3>
                <ul class="share-recipe">
                  <li><a target="_blank" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=700,height=700,toolbar=1,resizable=0'); return false;" href="https://www.facebook.com/sharer.php?u=<?= $recipe->url() ?>"><span class="icon"><? snippet('icons/fb-icon') ?></span> Facebook</a></li>
                  <li><a target="_blank" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=600,height=600,toolbar=1,resizable=0'); return false;" href="https://twitter.com/intent/tweet?url=<?= $recipe->url() ?>&text=<?= $recipe->title() ?> using Q <?= $recipeMixerPage->title()->html() ?>&hashtags=Mixer,QDrinks"><span class="icon"><? snippet('icons/twitter-icon') ?></span> Twitter</a></li>
                  <li><a target="_blank" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=750,height=700,toolbar=1,resizable=0'); return false;" href="http://pinterest.com/pin/create/button/?url=<?= $recipe->url() ?>&media=<?= $recipe->image()->crop(750, 750)->url();?>&description=<?= $recipe->title() ?> using Q <?= $recipeMixerPage->title()->html() ?>"><span class="icon"><? snippet('icons/pinterest-icon') ?></span> Pinterest</a></li>
                  <li><a target="_blank" href="mailto:?subject=Q Mixer Recipe&amp;body=Check out this drink recipe using Q <?= $recipeMixerPage->title()->html() ?> http://www.website.com."
   title="Share by Email""><span class="icon"><? snippet('icons/email-icon') ?></span> Email</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-color" style="background-color: currentcolor"></div>
    </div>

  <? endforeach; ?>

</ul>