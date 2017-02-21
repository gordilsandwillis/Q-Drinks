<!doctype html>
<html lang="<?= site()->language() ? site()->language()->code() : 'en' ?>">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?= $site->title()->html() ?><?php if($page->isHomePage()): ?><?php else: ?> | <?= $page->title()->html() ?><?php endif ?></title>
  <? if ($page->introText()->isNotEmpty()):?>
    <meta name="description" content="<?= $page->introText()->html() ?>">
  <? elseif($page->isHomePage()): ?>
    <meta name="description" content="<?= $site->description()->html() ?>">
  <? elseif($page->title()->html() == 'Inspiration'): ?>
    <meta name="description" content="<?= $page->topText()->html() ?>">
  <? endif; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <link rel="shortcut icon" href="/assets/images/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="/assets/images/apple-touch-icon.png" />

  <meta property="og:site_name" content="<?= $site->title()->html() ?>">
  <meta property="og:title" content="<?php if($page->isHomePage()): ?><?php else: ?><?= $page->title()->html() ?><?php endif ?>">
  <meta property="og:description" content="<? if ($page->introText()->isNotEmpty()):?><?= $page->introText()->html() ?><? elseif($page->isHomePage()): ?><?= $site->description()->html() ?><? elseif($page->title()->html() == 'Inspiration'): ?><?= $page->topText()->html() ?><? endif; ?>">
  <meta property="og:image" content="<?php if ($page->images()->find($page->headerImage())) : ?><?= $page->images()->find($page->headerImage())->crop(1000, 750)->url() ?><? else:?><?= $page->images()->sortBy('sort', 'asc')->first()->url() ?><? endif; ?>">
  <meta property="og:url" content="<?= $page->url() ?>">

  <?= css('assets/css/style.css') ?>

</head>
<body>
  <div id="top" class="page">
	  <div class="content">
	  <div id="barba-wrapper">
	  	<div class="barba-container <?php echo $headerClass ?>">
	  		<?php snippet('header', array('headerClass' => $headerClass)) ?>