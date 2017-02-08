<?php snippet('head') ?>

  <main class="about" role="main">
    <nav class="secondary">
      <div class="container">
        <ul>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Availability</a></li>
          <li><a href="#">Find Q Near You</a></li>
          <li><a href="#">Package Configurations</a></li>
        </ul>
      </div>
    </nav>

    <section class="white split">
      <div class="left">
        <div class="bg-image" style="background-image: url(<?= $page->images()->find($page->headerImage())->crop(1000, 1000)->url() ?>)">
        </div>
      </div>
      <div class="right about-info">
        <div>
          <?php snippet('section-header', ['text' => 'About Us']) ?>
          <div class="container align-center">
            <section>
              <h5>Phone</h5>
              <p><a href="tel:<? echo $site->phone()->html() ?>"><? echo $site->phone()->html() ?></a></p>
            </section>
            <section>
              <h5>Email</h5>
              <p><a href="<? echo $site->email()->html() ?>"><? echo $site->email()->html() ?></a></p>
            </section>
            <section>
              <h5>Sign up for our newsletter</h5>
              <form class="newsletter-form">
                <input class="newsletter-signup" type="text" name="signup" id="newsletterSignup" placeholder="Email Address" />
                <button class="newsletter-submit" type="submit" name="signup"></button>
              </form>
            </section>
            <section>
              <hr class="tiny"/>
              <h5>Follow Us</h5>
              <?php //if ($site->instagramUrl()->find($page->headerImage())) : ?>
              <a href="<? echo $site->instagramUrl() ?>">Instagram</a>
              <a href="<? echo $site->facebookUrl() ?>">Facebook</a>
              <a href="<? echo $site->twitterUrl() ?>">Twitter</a>
            </section>
          </div>
        </div>
      </div>
    </section>

    <section class="availability grey">
      <?php snippet('section-header', ['text' => 'Availability']) ?>
      <div class="container very-narrow align-center intro-p">
        <p><?= $page->availablityIntro()->html() ?></p>
      </div>
      <div class="container">
        <div class="inline-grid center middle logos">
          <?php foreach($page->logos()->toStructure() as $section): ?>
            <div class="col">
              <?php snippet('sections/' . $section->_fieldset(), array('data' => $section)) ?>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </section>

    <section class="white">
      <?php snippet('section-header', ['text' => 'Find Q Near You']) ?>
      <div class="container">
        
      </div>
    </section>

    <section class="package-configs grey">
      <?php snippet('section-header', ['text' => 'Package Configurations']) ?>
      <div class="container very-narrow align-center lg intro-p">
        <p><?= $page->packageIntro()->html() ?></p>
      </div>
      <div class="container">
        <div class="inline-grid center bottom">
          <?php foreach($page->packageTypes()->toStructure() as $section): ?>
            <div class="col-4">
              <?php snippet('sections/' . $section->_fieldset(), array('data' => $section)) ?>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </section>

  </main>

<?php snippet('footer') ?>