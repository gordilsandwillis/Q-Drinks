<!doctype html>
<html lang="<?= site()->language() ? site()->language()->code() : 'en' ?>">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?= $site->title()->html() ?><?php if($page->isHomePage()): ?><?php else: ?> | <?= $page->title()->html() ?><?php endif ?></title>

  <?
  if ($page->description()->isNotEmpty()):
    $description = $page->description()->html();
  elseif ($page->introText()->isNotEmpty()):
    $description = $page->introText()->html();
  elseif($page->isHomePage()):
    $description = $site->description()->html();
  elseif($page->title()->html() == 'Inspiration'):
    $description = $page->topText()->html();
  else:
    $description = $site->description()->html();
  endif;
  ?>

  <?
  if($page->isHomePage()):
    foreach($page->images()->shuffle()->limit(1) as $image):
      $seoImage = $image->crop(800, 600)->url();
    endforeach;
  elseif ($page->headerImage()->isNotEmpty()):
    $seoImage = $page->images()->find($page->headerImage())->crop(800, 600)->url();
  elseif ($page->thumbnail()->isNotEmpty()):
    $seoImage = $page->thumbnail()->crop(800, 600)->url();
  elseif($page->image()->isNotEmpty()):
    $seoImage = $page->image()->crop(800, 600)->url();
  else:
    foreach($page->images()->shuffle()->limit(1) as $image):
      $seoImage = $image->crop(800, 600)->url();
    endforeach;
  endif;
  ?>

  <meta name="description" content="<?= $description ?>">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <link rel="shortcut icon" href="/assets/images/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="/assets/images/apple-touch-icon.png" />

  <meta property="og:image" content="<?= $seoImage ?>" />
  <meta property="og:site_name" content="<?= $site->title()->html() ?>">
  <meta property="og:title" content="<?php if($page->isHomePage()): ?><?php else: ?><?= $page->title()->html() ?><?php endif ?>">
  <meta property="og:description" content="<?= $description ?>">

  <?= css('assets/css/style.css') ?>

</head>
<body>
  <div id="top" class="page">
	  <div class="content">
	  <div id="barba-wrapper">
	  	<div class="barba-container <?php echo $headerClass ?>">
	  		<?php snippet('header', array('headerClass' => $headerClass, 'desktopTextColor' => isset($desktopTextColor) ? $desktopTextColor : '', 'mobileTextColor' => isset($mobileTextColor) ? $mobileTextColor : '' )) ?>

