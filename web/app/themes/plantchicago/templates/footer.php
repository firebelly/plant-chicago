<?php
  $phone = get_option( 'contact_phone' );
  $address = get_option( 'contact_address' );
  $phoneUnformatted = preg_replace('/[^0-9]/', '', $phone);
  $email = get_option( 'contact_email' );
  $sponsors = \Firebelly\PostTypes\Sponsor\get_sponsors();
?>

<footer class="site-footer" role="contentinfo">
  <div class="footer-section site-grid grid">

    <div class="main-gutter main-column-left">
      <a href="<?= esc_url(home_url('/')); ?>" class="footer-logo"><svg class="icon icon-logo"><use xlink:href="#icon-logo"></svg><span class="sr-only"><?php bloginfo('name'); ?></span></a>
      <?php dynamic_sidebar('sidebar-footer'); ?>
    </div>

    <div class="main-column-right">

      <div class="grid -inner">

        <div class="content-left flex-item one-half">
          <div class="social">
            <h3>Connect with us</h3>
            <ul>
              <li><a href="https://www.facebook.com/<?= get_option( 'facebook_id', 'plantchicago' ); ?>"><span class="sr-only">Facebook</span><svg class="icon icon-facebook"><use xlink:href="#icon-facebook"></svg></a></li>
              <li><a href="https://www.instagram.com/<?= get_option( 'instagram_id', 'plantchicago' ); ?>"><span class="sr-only">Instagram</span><svg class="icon icon-instagram"><use xlink:href="#icon-instagram"></svg></a></li>
              <li><a href="https://www.twitter.com/<?= get_option( 'twitter_id', 'plantchicago' ); ?>"><span class="sr-only">Twitter</span><svg class="icon icon-twitter"><use xlink:href="#icon-twitter"></svg></a></li>
            </ul>
          </div>
          <div class="newsletter">
            <h3>Subscribe to our newsletter</h3>
            <?php include ('newsletter.php'); ?>
          </div>
        </div>

        <div class="content-right flex-item one-half">
          <div class="visit">
            <?php if (!empty($address)): ?>
              <h3>Visit us</h3>
              <address class="vcard">
                <?= $address ?>
              </address>
            <?php endif ?>
            <?php if (!empty($phone)): ?>
              <a href="tel:<?= $phoneUnformatted; ?>"><?= $phone ?></a> +
            <?php endif ?>
            <?php if (!empty($email)): ?>
              <a href="mailto:<?= $email ?>"><?= $email ?></a>
            <?php endif ?>
          </div>
          <div class="copyright">
            <p>Copyright Plant Chicago <?= date('Y'); ?><br> <em>Plant Chicago is a registered 501(c)3 organization</em></p>
          </div>
        </div>

      </div>

    </div>

  </div>

  <?php if (!empty($sponsors)) { ?>
  <div id="sponsors" class="sponsors-section footer-section site-grid grid">
    <div class="main-gutter main-column-left"></div>
    <div class="main-column-right">
      <div class="-inner">
        <div class="sponsors-grid">
          <?php

            $sponsor_categories = get_terms( array(
              'taxonomy' => 'sponsor_category'
            ));

            foreach ($sponsor_categories as $key => $sponsor_category) {
              echo '<div class="sponsor-category"><h3>'.$sponsor_category->name.'</span></h3>'.Firebelly\PostTypes\Sponsor\get_sponsors(['category'=>$sponsor_category->slug]).'</div>';
            }

          ?>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>

  <svg class="footer-pattern">
    <rect x="0" y="0" width="100%" height="36" fill="url(#footerPattern)">
  </svg>
</footer>
