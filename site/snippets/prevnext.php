<?php

/*

The $flip parameter can be passed to the snippet to flip
prev/next items visually:

```
<?php snippet('prevnext', ['flip' => true]) ?>
```

Learn more about snippets and parameters at:
https://getkirby.com/docs/templates/snippets

*/

$directionPrev = @$flip ? 'right' : 'left';
$directionNext = @$flip ? 'left'  : 'right';

if($page->hasNextVisible() || $page->hasPrevVisible()): ?>
  <nav class="pagination <?= !@$flip ?: ' flip' ?> wrap cf">
    <div class="container">
      <div class="row">

        <!-- <?php if($page->hasPrevVisible()): ?>
          <div class="col-4 left">
            <div class="project-thumb <?= $page->prevVisible()->thumbStyle()->html() ?>">
              <a href="<?= $page->prevVisible()->url() ?>" title="<?= $page->prevVisible()->title()->html() ?>" style="background-color: <?= $page->prevVisible()->thumbMatteColor()->html() ?>;">
                <?php if ($page->prevVisible()->images()->find($page->prevVisible()->thumbnail())) : ?>
                  <div class="thumb-img-wrap" style="background-image: url(<?php echo $page->prevVisible()->images()->find($page->prevVisible()->thumbnail())->url() ?>)">
                    <img src="<?php echo $page->prevVisible()->images()->find($page->prevVisible()->thumbnail())->url() ?>">
                  </div>
                <?php endif; ?>
                <h3 class="project-title"><?= $page->prevVisible()->title()->html() ?></h3>
              </a>
            </div>
          </div>
        <?php else: ?><?php endif ?> -->

        <?php if($page->hasNextVisible()): ?>
          <div class="col-6">
            <h4 class="section-title">Next Project</h4>
          </div>
          <div class="col-6">
            <div class="project-thumb <?= $page->nextVisible()->thumbStyle()->html() ?>">
              <a href="<?= $page->nextVisible()->url() ?>" title="<?= $page->nextVisible()->title()->html() ?>" style="background-color: <?= $page->nextVisible()->thumbMatteColor()->html() ?>;">
                <?php if ($page->nextVisible()->images()->find($page->nextVisible()->thumbnail())) : ?>
                  <div class="thumb-img-wrap" style="background-image: url(<?php echo $page->nextVisible()->images()->find($page->nextVisible()->thumbnail())->url() ?>)">
                    <img src="<?php echo $page->nextVisible()->images()->find($page->nextVisible()->thumbnail())->url() ?>">
                  </div>
                <?php endif; ?>
                <h3 class="project-title"><?= $page->nextVisible()->title()->html() ?></h3>
              </a>
            </div>
          </div>
        <?php else: ?><?php endif ?>

      </div>
    </div>
  </nav>
<?php endif ?>