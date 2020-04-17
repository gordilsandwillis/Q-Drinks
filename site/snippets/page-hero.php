<?
	if(!isset($pushDown)) $pushDown = false;
	if(!isset($entrance)) $entrance = true;
	if(!isset($image)) $image = false;
	if(!isset($mobileImage)) $mobileImage = false;
	if(!isset($video)) $video = '';
	if(!isset($fullHeight)) $fullHeight = false;
?>

<? if ($image || $video != ''): ?>

	<div class="top-area<? if ( $pushDown ): ?> push-down<? endif ?>">
		<div class="top-image<? if ( $entrance ): ?> fancy-entrance<? endif ?><? if ( $fullHeight ): ?> full-height<? endif ?>">
	  	<div class="bg-image cover-media">
				<? if ($video && $video->isNotEmpty()) : ?>
					<video autoplay loop muted playsinline>
			      <source src="<?= $page->url() . '/' . $video ?>" type="video/mp4">
			    </video>
		    <? elseif ($image->isNotEmpty()) : ?>
		    	<? if ($mobileImage) : ?>
						<picture className="img">
								<source
									srcset="<?= $image->focusCrop(800)->url() ?> 800w,
							<?= $image->focusCrop(1000)->url() ?> 1000w,
							<?= $image->focusCrop(1500)->url() ?> 1500w,
							<?= $image->focusCrop(2000)->url() ?> 2000w"
								src="<?= $image->focusCrop(800)->url() ?>"
									media="(min-width: 700px)" />
			        <img
								srcset="<?= $mobileImage->focusCrop(800)->url() ?> 800w,
							<?= $mobileImage->focusCrop(1000)->url() ?> 1000w,
							<?= $mobileImage->focusCrop(1500)->url() ?> 1500w,
							<?= $mobileImage->focusCrop(2000)->url() ?> 2000w"
								src="<?= $mobileImage->focusCrop(800)->url() ?>"/>
			      </picture>
		      <? else : ?>
		      	<img
								srcset="<?= $image->focusCrop(800)->url() ?> 800w,
							<?= $image->focusCrop(1000)->url() ?> 1000w,
							<?= $image->focusCrop(1500)->url() ?> 1500w,
							<?= $image->focusCrop(2000)->url() ?> 2000w"
								src="<?= $image->focusCrop(800)->url() ?>"/>
		      <? endif; ?>
		    <? endif; ?>
	    </div>
		</div>
	</div>

<? endif ?>