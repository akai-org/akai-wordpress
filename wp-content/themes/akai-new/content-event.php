<?php $time = get_field('event_date') ?: get_the_time('U'); ?>

<a href="<?php esc_attr_e(get_permalink()); ?>" id="post-<?php the_ID(); ?>" <?php post_class('eventbox'); ?>>
  <figure>
    <?php 
    $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full')[0];
    ?>
    <?php if ($src): ?>
      <div class="entry-image post-thumbnail" style="background-image: url(<?= $src ?>)"></div>
    <?php else: ?>
      <div class="entry-image post-thumbnail noimage"></div>
    <?php endif ?>

    <figcaption>
      <h4 class="entry-title"><?php the_title(); ?></h4>
      <div class="entry-content"><?php the_excerpt(); ?></div>
    </figcaption>
  </figure>

  <div class="caption">
    <h2 class="entry-title"><?php the_title(); ?></h2>
    <time datetime="<?php echo date_i18n('c', $time); ?>"><?php echo date_i18n('d/m/y', $time); ?></time>
  </div>
</a>
