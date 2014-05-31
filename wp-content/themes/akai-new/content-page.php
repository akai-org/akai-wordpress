<?php akai_the_horizontal_photo(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('column content'); ?>>
  <h1 class="entry-title"><?php the_title(); ?></h1>

  <div class="entry-content">
    <?php
      the_content();
    ?>
  </div>
</article>

<?php if (trim(get_field('sidebar'))): ?>
  <aside class="column sidebar">
    <?php the_field('sidebar'); ?>
  </aside>
<?php endif; ?>
