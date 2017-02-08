<header class="header font-smooth <?php echo $headerClass ?>" role="banner">
  <div class="container">

    <!-- <?php snippet('menu') ?> -->
    <a class="logo" href="<?= url() ?>" rel="home" title="<?= $site->title()->html() ?>">
        <?php snippet('icons/logo') ?>   
    </a>

    <div class="menu-link">
        <div class="menu-icon">
            <div class="center"></div>
        </div>
    </div>

    <nav>
        <div class="left">
    		<a href="<?= url() ?>/mixers">Our Mixers</a>
    		<a href="<?= url() ?>/inspiration">Inspiration</a>
    		<a href="<?= url() ?>/highball">Highball</a>
        </div>
        <div class="right">
    		<a href="<?= url() ?>/spectacular-serve">Spectacular Serve</a>
    		<a href="<?= url() ?>/accolades">Accolades</a>
    		<a href="<?= url() ?>/about">About Us</a>
        </div>
    </nav>

  </div>
</header>