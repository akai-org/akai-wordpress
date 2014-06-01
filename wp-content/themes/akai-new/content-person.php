<article id="post-<?php the_ID(); ?>" <?php post_class('person'); ?>>
  <figure>
    <?php if (has_post_thumbnail()): ?>
      <?php the_post_thumbnail(); ?>
    <?php else: ?>
      <img src="<?php bloginfo('template_directory'); ?>/images/avatar.png" class="post-thumbnail">
    <?php endif ?>
    <figcaption>
      <h4 class="entry-title"><?php the_title(); ?></h4>
      <div class="entry-position"><?php the_field('position_name'); ?></div>
      <div class="entry-icons">
        <?php 
        $fields = [
          'email' => [
            'icon' => 'fa fa-envelope',
            'value' => 'mailto:%s'
          ],
          'homepage_url' => [
            'icon' => 'fa fa-globe'
          ],
          'phone' => [
            'icon' => 'fa fa-phone',
            'value' => 'skype:%s'
          ],
          'facebook_handle' => [
            'icon' => 'fa fa-facebook-square',
            'value' => 'https://facebook.com/%s'
          ],
          'twitter_handle' => [
            'icon' => 'fa fa-twitter-square',
            'value' => 'https://twitter.com/%s'
          ],
          'linkedin_username' => [
            'icon' => 'fa fa-linkedin-square',
            'value' => '%s'
          ],
          'github_username' => [
            'icon' => 'fa fa-github-square',
            'value' => 'https://github.com/%s'
          ]
        ];
        array_walk($fields, function($options, $field_name) {
          $field_value = get_field($field_name);

          if ($field_value) {
            printf('<a href="%s" class="btn-icon btn"><i class="%s"></i></a>',
              esc_attr( sprintf($options['value'] ?: '%s', $field_value) ),
              esc_attr( $options['icon'] )
            );
          }
        });
        ?>
      </div>
    </figcaption>
  </figure>
</article>
