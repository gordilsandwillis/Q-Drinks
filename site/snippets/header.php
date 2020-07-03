<?php
$theHeaderClass = '';
$theDesktopTextColor = '';
$theMobileTextColor = '';

if(isset($headerClass)) {
    $theHeaderClass = $headerClass;
} else {
    $theHeaderClass = '';
}

if(isset($desktopTextColor)) {
    $theDesktopTextColor = $desktopTextColor;
} else {
    $theDesktopTextColor = '';
}

if(isset($mobileTextColor)) {
    $theMobileTextColor = $mobileTextColor;
} else {
    $theMobileTextColor = '';
}

?>

<header class="header font-smooth<?= ' ' . $theHeaderClass ?><?= ' ' . $theDesktopTextColor ?><?= ' ' . $theMobileTextColor ?>" role="banner">
  <div class="container">
    <!-- <?php snippet('menu') ?> -->
    <a class="logo" href="<?= url() ?>" rel="home" title="<?= $site->title()->html() ?>">
        <?php snippet('icons/logo') ?>   
    </a>

    <div id="menu-toggle" class="menu-link">
        <div class="menu-icon">
            <div class="center"></div>
        </div>
    </div>

    <nav>
    <div>
        <div class="left">
    		<a class="nav-link" href="<?= url() ?>/mixers">Our Mixers</a>
    		<a class="nav-link" href="<?= url() ?>/inspiration">Inspiration</a>
    		<a class="nav-link" href="<?= url() ?>/cocktails">Cocktails</a>
        </div>
        <div class="right">
    		<a class="nav-link" href="<?= url() ?>/spectacular-serve">Spectacular Serve</a>
    		<a class="nav-link" href="<?= url() ?>/accolades">Accolades</a>
    		<a class="nav-link no-barba" href="<?= url() ?>/about">About Us</a>
        </div>
    </div>
    </nav>

  </div>
</header>