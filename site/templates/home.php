
<?= $desktopColorClass = ''; ?>
<?= $mobileColorClass = '' ?>

<? foreach($page->builder()->toStructure()->shuffle()->limit(1) as $image): ?>
	<!-- Get desktop color class -->
	<? if ($image->desktopTextColor()->html() == '000000'): ?>
		<? $desktopColorClass = 'desktop-dark' ?>
	<? else: ?>
		<? $desktopColorClass = 'desktop-light' ?>
	<? endif; ?>
	<!-- Get mobile color class -->
	<? if ($image->mobileTextColor()->html() == '000000'): ?>
		<? $mobileColorClass = 'mobile-dark' ?>
	<? else: ?>
		<? $mobileColorClass = 'mobile-light' ?>
	<? endif; ?>
	<!-- Get image urls -->
	<? $desktopImage = $image->desktopImage()->toFile()->crop(2000, 1800)->url(); ?>
	<? $mobileImage = $image->mobileImage()->toFile()->crop(1000, 1000)->url(); ?>
<? endforeach; ?>

<? snippet('head', array(
		'headerClass' => 'inverted',
		'desktopTextColor' => $desktopColorClass,
		'mobileTextColor' => $mobileColorClass
	)
)
?>
  <main class="home" role="main">
  	<div class="top-area">
	    <? snippet('page-hero', [
	      'image' => $image->desktopImage()->toFile(),
	      'mobileImage' => $image->mobileImage()->toFile(),
	      'fullHeight' => true
	    ]) ?>
	    <div class="text-overlay <?= $desktopColorClass ?> <?= $mobileColorClass ?>">
	    	<div class="container">
	    		<h1 class="hidden">Q Mixers</h1>
		      <div class="headline">
		      	<div class="h1-wrap">
			      	<div class="q-question">
			      		<? snippet('icons/logo') ?>
			      		<span class="colon">:</span>
			      	</div>
			      	<h2 class="text">
				      	<?= $page->headline()->html() ?>
			      	</h2>
		      	</div>
		      </div>
		    </div>
	    </div>
    </div>
  </main>

<? snippet('footer', array('footerClass' => 'no-space')) ?>