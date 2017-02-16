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

if(isset($limit)) $highball = $highball->limit($limit);

?>

<ul class="flex-grid">

  <?php foreach($highball as $recipe): ?>

    <li class="flex-col">
      <div class="recipe-thumb">
        <a href="<?= $recipe->url() ?>" title="<?= $recipe->title()->html() ?>" >
          <img src="<?= $recipe->image()->crop(600, 450)->url();?>" alt="<?= $recipe->title()->html() ?>" >
          <h3 class="thumb-title"><?= $recipe->title()->html() ?></h3>
          <h6 class="recipe-mixer">Q <?= $recipe->recipeMixer()->title()->html() ?></h6>
        </a>
      </div>
      <div class="nipple-wrap">
        <span class="nipple" style="border-bottom-color: <?= page('mixers/' . $recipe->recipeMixer()->html())->mixerColor() ?>"></span>
      </div>
    </li>

    <li class="flex-col inline-recipe">
      <div class="inline-recipe-wrap">
        <div class="container">
          <div class="inline-grid break-lg">
            <div class="col-4">
              <div class="recipe-section">
                <h3>Ingredients</h3>
                <ul>
                  <?php foreach($recipe->ingredients()->toStructure() as $step): ?>
                    <li><p><?= $step->ingredient()->html() ?></p></li>
                  <?php endforeach ?>
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
                  <li><a href="#">Facebook</a></li>
                  <li><a href="#">Twitter</a></li>
                  <li><a href="#">Pinterest</a></li>
                  <li><a href="#">Email</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-color" style="background-color: <?= page('mixers/' . $recipe->recipeMixer()->html())->mixerColor() ?>"></div>
    </li>

  <?php endforeach ?>

</ul>