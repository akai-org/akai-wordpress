<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

    </div>
  </div>
  
  <div id="newsletter-bar">
    <div class="container">
      <div class="content-left content-form">
        <div class="message">
          Chcesz być na bieżąco informowany o naszych wydarzeniach? Wpisz się na listę: 
        </div>
        <form>
          <input type="email" placeholder="Twój adres e-mail" name="email" />
          <button type="submit" class="btn btn-orange">Wyślij</button>
        </form>
      </div>
      <div class="content-left content-message">
        <div class="message">
          <span class="js-message-content">Here be dragons.</span>
          <a href="#" class="btn btn-orange js-back-button">Wróć</a>
        </div>
      </div>
      <div class="content-right">
        <i class="fa fa-times js-close-button"></i>
      </div>
    </div>
  </div>
  
  <footer class="site-footer">
    <div class="container">
      <section class="copyright">
        &copy; <a href="<?php echo esc_url( home_url( '/' ) ); ?>">AKAI</a> <?= "2010 - " . date("Y") ?>
      </section>

      <section class="partners">
        <a href="http://put.poznan.pl/" class="partner">
          <img src="<?php bloginfo('template_directory'); ?>/images/pp.svg" alt="Politechnika Poznańska">
        </a>
        <a href="http://amu.edu.pl/" class="partner">
          <img src="<?php bloginfo('template_directory'); ?>/images/uam.svg" alt="Uniwersytet Adama Mickiewicza">
        </a>
      </section>
    </div>
  </footer>

  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-81404837-1', 'auto');
    ga('send', 'pageview');

  </script>  
  <?php wp_footer(); ?>
</body>
</html>
