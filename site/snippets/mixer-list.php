<?php
$mixers = page('mixers')->children()->visible();
// $mixers = $page->siblings();
// $mixers = $page->siblings($self = false);

/*

The $limit parameter can be passed to this snippet to
display only a specified amount of projects:

```
<?php snippet('showcase', ['limit' => 3]) ?>
```

Learn more about snippets and parameters at:
https://getkirby.com/docs/templates/snippets

*/

if(isset($siblings))  $mixers = $page->siblings($self = false);
if(isset($limit))     $mixers = $mixers->limit($limit);
if(isset($order))     $mixers = $mixers->shuffle();

?>

<ul class="mixer-list inline-grid no-break center">

  <?php foreach($mixers as $mixer): ?>

    <li class="col transition-in">
      <div class="mixer-thumb">
        <a href="<?= $mixer->url() ?>" title="<?= $mixer->title()->html() ?>" >
          <?php if ($mixer->images()->find($mixer->thumbnail())) : ?>
            <img src="<?php echo $mixer->images()->find($mixer->thumbnail())->crop(600, 1000)->url() ?>" alt="<?= $mixer->title()->html() ?>" width="600" height="1000">
          <?php endif; ?>
        </a>
        <h3 class="thumb-title"><?= $mixer->title()->html() ?></h3>
      </div>
    </li>

  <?php endforeach ?>

</ul>