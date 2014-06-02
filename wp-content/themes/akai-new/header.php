<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title( '|', true, 'right' ); ?><?php echo get_bloginfo('name'); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <link rel="alternate" type="application/rss+xml" title="AKAI - Wydarzenia" href="<?= esc_attr_e(RSS_LINK); ?>" />

  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/main.css?ver=<?= AKAI_VERSION ?>">
  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/skrollr.css?ver=<?= AKAI_VERSION ?>" media="screen and (min-width:960px)" data-skrollr-stylesheet>
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

  <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/logo.png" />

  <script type="text/javascript">
  window.PATH = <?= json_encode(home_url("/")) ?>;
  </script>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="skrollr-body">

  <header class="site-header big">
    <div class="navigation-bar">
      <div class="bg"></div>
      
      <div class="navigation js-expand">
        <ul>
          <li>
            <a href="#">menu</a>
          </li>
        </ul>
      </div>

      <div class="container">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'primary_left',
          'menu_class' => 'navigation left',
          'container' => false,
          'walker' => new Akai_Walker_Nav_Menu
        ));
        ?>

        <?php
        wp_nav_menu(array(
          'theme_location' => 'primary_right',
          'menu_class' => 'navigation right',
          'container' => false,
          'walker' => new Akai_Walker_Nav_Menu
        ));
        ?>
      </div>
    </div>

    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo">
      <img src="<?php bloginfo('template_directory'); ?>/images/logo.svg" alt="AKAI">
    </a>

    <div class="site-header-links">
      <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Akademickie Koło Aplikacji Internetowych</a></h1>

      <div class="social-buttons">
        <a href="http://www.facebook.com/akai.pp">
          <i class="fa fa-facebook"></i>
          akai.pp
        </a>
        <a href="http://twitter.com/akai_pp">
          <i class="fa fa-twitter"></i>
          akai_pp
        </a>
        <a href="mailto:kontakt@akai.org.pl">
          <i class="fa fa-envelope"></i>
          kontakt@akai.org.pl
        </a>
        <a href="<?= esc_attr_e(RSS_LINK); ?>">
          <i class="fa fa-rss"></i>
          RSS
        </a>
      </div>
    </div>
  </header>

  <div id="main" class="site-main">
    <div class="container">
