<?
	$headerClass = 'grey';
	if($page->headerVideo() != '' || $page->headerImage() != '') $headerClass = 'inverted';
?>

<?php snippet('head', array('headerClass' => $headerClass)) ?>

	<main class="store-locator" role="main">

		<? snippet('page-hero', [
      'image' => $page->image($page->headerImage()),
      'video' => $page->headerVideo()
    ]) ?>

		<section id="find-q" class="white transition-in">
			<?php snippet('section-header', ['text' => 'Find Q Near You']) ?>
			<div class="container">
				<div class="easy-locator-wrap">
					<!-- Begin Easy Locator Store Locator Service //-->
					<iframe id="EasyLocator" width="780" height="530" scrolling="no" frameborder="0" src="https://www.easylocator.net/search/map3/Q Drinks 2017" allowtransparency="true"></iframe>
					<!-- End Easy Locator Store Locator Service //-->
				</div>
			</div>
		</section>

	</main>

<?php snippet('footer', ['footerClass' => 'grey']) ?>