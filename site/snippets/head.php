<!doctype html>
<html lang="<?= site()->language() ? site()->language()->code() : 'en' ?>">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?= $site->title()->html() ?> | <?= $page->title()->html() ?></title>
  <meta name="description" content="<?= $site->description()->html() ?>">

  <?= css('assets/css/style.css') ?>

</head>
<body>
  <div class="page">
	  <div class="content">
	  <div id="barba-wrapper">
	  	<div class="barba-container <?php echo $headerClass ?>">
	  		<?php snippet('header', array('headerClass' => $headerClass)) ?>