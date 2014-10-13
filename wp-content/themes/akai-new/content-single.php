<?php akai_the_horizontal_photo(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>
  <header class="entry-header">
    <h1 class="entry-title"><?php the_title(); ?></h1>

    <?php if (get_field('registration_url')): ?>
      <a href="<?php esc_attr_e(get_field('registration_url')); ?>" class="btn btn-blue">
        <i class="fa fa-check-square-o"></i>
        Rejestracja
      </a>
    <?php endif ?>

    <?php if (get_field('facebook_url')): ?>
      <a href="<?php esc_attr_e(get_field('facebook_url')); ?>" class="btn btn-blue">
        <i class="fa fa-facebook-square"></i>
        Wydarzenie na Facebooku
      </a>
    <?php endif ?>

    <?php if (get_field('event_date')): ?>
      <a href="<?php esc_attr_e(akai_add_to_calendar_url()); ?>" class="btn btn-blue" target="_blank">
        <i class="fa fa-google-plus-square"></i>
        Dodaj do kalendarza
      </a>
    <?php endif ?>

    <?php get_ssb(); ?>
  </header>

  <section class="entry-main column content">
    <section class="entry-content">
      <?php the_content(); ?>
    </section>

    <?php if (get_field('presentation')): ?>
      <section class="entry-presentation">
        <?php the_field('presentation'); ?>
      </section>
    <?php endif ?>

    <?php if (($fb_album_id = get_field("fb_album_id")) && function_exists("srz_fb_render_fullpage")): ?>
      <div class="entry-gallery">
        <h3>Zdjęcia</h3>

        <?php 
        $album = [
          "albumid" => $fb_album_id,
          "shuffle_images" => false,
          "updatefeed" => 60 * 24,
          "paginatenum" => 999,
          "thumbwidth" => 202,
          "thumbheight" => 202
        ];
        $images = srz_fb_get_album_api($album['albumid'], $album['shuffle_images'], $album['updatefeed'] * 60);
        $common_options = SrizonFBDB::GetCommonOpt();

        echo srz_fb_render_fullpage($album, $images, $common_options);
        ?>
      </div>
    <?php endif ?>
  </section>

  <aside class="column sidebar">
    <?php if (!get_field('horizontal_photo')): ?>
      <section class="entry-thumbnail">
        <?php the_post_thumbnail(); ?>
      </section>
    <?php endif ?>

    <?php if (get_field('event_date')): ?>
      <section class="entry-date">
        <h4>Czas</h4>
        <?php echo ucfirst(date_i18n('l, j M Y, H:i', get_field('event_date'))); ?>
      </section>
    <?php endif ?>

    <?php 
    $location_address = get_field('location_address');
    $location = get_field('location');
    if ( ($location && $location['lat']) || $location_address ): ?>
      <section class="entry-location">
        <h4>Miejsce</h4>
        <?php echo $location_address ?: $location['address']; ?>
        <?php if ($location['lat']): ?>
          <div class="acf-map">
            <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
          </div>
        <?php endif ?>
      </section>
    <?php endif ?>
  </aside>

</article><!-- #post-<?php the_ID(); ?> -->
