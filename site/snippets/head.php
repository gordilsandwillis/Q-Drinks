<!doctype html>
<html lang="<?= site()->language() ? site()->language()->code() : 'en' ?>">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?= $site->title()->html() ?><?php if($page->isHomePage()): ?><?php else: ?> | <?= $page->title()->html() ?><?php endif ?></title>

  <?
  $description = '';
  if ($page->description()->isNotEmpty()):
    $description = $page->description();
  elseif ($page->introText()->isNotEmpty()):
    $description = $page->introText();
  elseif($page->isHomePage()):
    $description = $site->description();
  elseif($page->title() == 'Inspiration'):
    $description = $page->topText();
  elseif ($page->method()->isNotEmpty()):
    $description = $page->method();
  else:
    $description = $site->description();
  endif;
  ?>

  <? $keywords = $site->keywords()->html() ?>

  <?
  $seoImage = '';
  if($page->isHomePage()):
    foreach($page->images()->shuffle()->limit(1) as $image):
      $seoImage = $image->crop(800, 600)->url();
    endforeach;
  elseif ($page->headerImage()->isNotEmpty()):
    $seoImage = $page->images()->find($page->headerImage())->crop(800, 600)->url();
  elseif ($page->thumbnail()->isNotEmpty()):
    $seoImage = $page->thumbnail()->crop(800, 600)->url();
  elseif ($page->mixerImage()->isNotEmpty()):
    $seoImage = $page->mixerImage()->crop(800, 600)->url();
  elseif ($page->image()):
    $seoImage = $page->image()->crop(800, 600)->url();
  else:
    foreach($pages->find('home')->images()->shuffle()->limit(1) as $image):
      $seoImage = $image->crop(800, 600)->url();
    endforeach;
  endif;
  ?>

  <meta name="description" content="<?= $description ?>">
  <meta name="keywords" content="<?= $keywords ?>">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <link rel="shortcut icon" href="/assets/images/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="/assets/images/apple-touch-icon.png" />

  <meta property="og:image" content="<?= $seoImage ?>" />
  <meta property="og:site_name" content="<?= $site->title()->html() ?>">
  <meta property="og:title" content="<? if($page->isHomePage()): ?><? else: ?><?= $page->title()->html() ?><? endif ?>">
  <meta property="og:description" content="<?= $description ?>">

  <?= css('assets/css/style.css') ?>

</head>

<?php
$theHeaderClass = '';

if(isset($headerClass)) {
    $theHeaderClass = $headerClass;
} else {
    $theHeaderClass = '';
}

?>

<body>
  <? snippet('analytics') ?>
  <div id="top" class="page">
	  <div class="content">
	  <div id="barba-wrapper">
	  	<div class="barba-container <?php echo $theHeaderClass ?>">
	  		<?php snippet('header', array('headerClass' => $theHeaderClass, 'desktopTextColor' => isset($desktopTextColor) ? $desktopTextColor : '', 'mobileTextColor' => isset($mobileTextColor) ? $mobileTextColor : '' )) ?>