<footer class="site-footer" role="contentinfo">
  <div class="site-grid grid">

    <div class="main-gutter main-column-left">
      <a href="<?= esc_url(home_url('/')); ?>" class="footer-logo"><svg class="icon icon-logo"><use xlink:href="#icon-logo"></svg><span class="sr-only"><?php bloginfo('name'); ?></span></a>
      <?php dynamic_sidebar('sidebar-footer'); ?>
    </div>

    <div class="main-column-right">

      <div class="grid">

        <div class="content-left flex-item one-half">
          <div class="social">
            <h3>Connect with us</h3>
            <ul>
              <li><a href="https://www.facebook.com/<?php echo get_option( 'facebook_id', 'plantchicago' ); ?>"><span class="sr-only">Facebook</span><svg class="icon icon-facebook"><use xlink:href="#icon-facebook"></svg></a></li>
              <li><a href="https://www.instagram.com/<?php echo get_option( 'instagram_id', 'plantchicago' ); ?>"><span class="sr-only">Instagram</span><svg class="icon icon-instagram"><use xlink:href="#icon-instagram"></svg></a></li>
              <li><a href="https://www.twitter.com/<?php echo get_option( 'twitter_id', 'plantchicago' ); ?>"><span class="sr-only">Twitter</span><svg class="icon icon-twitter"><use xlink:href="#icon-twitter"></svg></a></li>
            </ul>
          </div>
          <div class="newsletter">
            <h3>Subscribe to our newsletter</h3>
            <?php include ('newsletter.php'); ?>
          </div>
        </div>

        <div class="content-right flex-item one-half">    
          <div class="visit">
            <h3>Visit us at The Plant</h3>
            <address class="vcard"> 
              <a target="_blank" href="https://goo.gl/maps/RRoM9Dco5BC2">1400 W 46th St, Chicago, IL 60609</a>
            </address>
            <a href="mailto:<?php echo get_option( 'contact_email' ); ?>"><?php echo get_option( 'contact_email' ); ?></a>
          </div>
          <div class="copyright">
            <p>Copyright Plant Chicago <?php echo date('Y'); ?><br> <em>Plant Chicago is a registered 501(c)3 organization</em></p>
          </div>
        </div>

      </div>

    </div>

  </div>
  <svg class="footer-pattern">
    <rect x="0" y="0" width="100%" height="36" fill="url(#footerPattern)">
  </svg>
</footer>
