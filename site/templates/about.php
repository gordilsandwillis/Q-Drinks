<?php snippet('head') ?>

	<main class="about" role="main">
		<nav class="secondary">
			<div class="container">
				<ul>
					<li><a href="#availability">Availability</a></li>
					<li><a href="#find-q">Find Q Near You</a></li>
					<li><a href="#top">Contact Us</a></li>
					<li><a href="#package">Package Configurations</a></li>
          <li><a href="#leadership">Leadership</a></li>
				</ul>
			</div>
		</nav>

		<section id="availability" class="availability grey transition-in">
			<?php snippet('section-header', ['text' => 'Availability']) ?>
			<div class="container very-narrow align-center intro-p">
				<?= $page->availablityIntro()->kirbytext() ?>
			</div>
			<?php /*
			<div class="container narrow">
				<div class="inline-grid center middle logos break-sm">
					<?php foreach($page->logos()->toStructure() as $section): ?>
						<div class="col">
							<?php snippet('sections/' . $section->_fieldset(), array('data' => $section)) ?>
						</div>
					<?php endforeach ?>
				</div>
			</div>
			*/ ?>
		</section>

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

		<section class="white split">
			<div class="left">
				<div class="top-image">
					<div class="bg-image" style="background-image: url(<?= $page->images()->find($page->headerImage())->focusCrop(1000, 1000)->url() ?>)">
					</div>
				</div>
			</div>
			<div class="right about-info">
				<div>
					<?php snippet('section-header', array('text' => "We'd love to hear from you", 'tag' => 'h1')) ?>
					<div class="container align-center">
						<?php if ($site->phone()->isNotEmpty()): ?>
							<section>
								<h5>Phone</h5>
								<p><a href="tel:<? echo $site->phone()->html() ?>"><? echo $site->phone()->html() ?></a></p>
							</section>
						<? endif; ?>
						<?php if ($site->email()->isNotEmpty()): ?>
							<section>
								<h5>Email</h5>
								<p><a href="mailto:<? echo $site->email()->html() ?>"><? echo $site->email()->html() ?></a></p>
							</section>
						<? endif; ?>
						<section>
							<h5>Sign up for our newsletter</h5>
							<form class="newsletter-form">
								<input class="newsletter-signup" type="text" name="email" id="newsletterSignup" placeholder="Email Address" />
								<button class="newsletter-submit" type="submit" for="newsletterSignup" name="email"></button>
							</form>
						</section>
						<section>
							<hr class="tiny"/>
							<h5>Follow Us</h5>
							<div class="follow-icons">
								<?php if ($site->instagramUrl()->isNotEmpty()): ?>
									<a href="<? echo $site->instagramUrl() ?>" title="Follow on Instagram"><?php snippet('icons/instagram-icon') ?></a>
								<? endif; ?>
								<?php if ($site->facebookUrl()->isNotEmpty()): ?>
									<a href="<? echo $site->facebookUrl() ?>" title="Follow on Facebook"><?php snippet('icons/fb-icon') ?></a>
								<? endif; ?>
							</div>
						</section>
					</div>
				</div>
			</div>
		</section>

		<section id="package" class="package-configs grey">
			<div class="transition-in">
				<?php snippet('section-header', ['text' => 'Package Configurations']) ?>
				<div class="container very-narrow align-center lg intro-p">
					<p><?= $page->packageIntro()->html() ?></p>
				</div>
			</div>
			<div class="container transition-in">
				<div class="inline-grid center top">
					<?php foreach($page->packageTypes()->toStructure() as $section): ?>
						<div class="col-3">
							<?php snippet('sections/' . $section->_fieldset(), array('data' => $section)) ?>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</section>

    <?php if ($page->teamMembers()->isNotEmpty()): ?>
  		<section id="leadership" class="white team-list">
  			<div class="container">
          <?php snippet('section-header', ['text' => 'Leadership']) ?>
  				<ul class="flex-grid">
  					<?php foreach($page->teamMembers()->toStructure() as $section): ?>
  						<?php snippet('sections/' . $section->_fieldset(), array('data' => $section)) ?>
  					<?php endforeach ?>
  				</ul>
  			</div>
  		</section>
    <?php endif ?>

	</main>

<?php snippet('footer', ['footerClass' => '']) ?>