<?php
$elementTag = 'h3';
$elementTransition = '';

if(isset($tag)) {
	$elementTag = $tag;
} else {
	$elementTag = 'h3';
}

if(isset($transition)) {
	$elementTransition = $transition;
} else {
	$elementTransition = '';
}

?>

<div class="section-header <?= $elementTransition ?>">
  <div class="container">
    <<?= $elementTag ?>><?= $text ?></<?= $elementTag ?>>
  </div>
</div>