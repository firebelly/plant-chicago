<div class="share">
  <h4 class="sr-only">Share on social media:</h4>
  <ul class="social">
    <li>
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?= get_permalink( $post->ID ); ?>" target="_blank"><span class="sr-only">Facebook</span><svg class="icon icon-facebook"><use xlink:href="#icon-facebook"></svg></a>
    </li>
    <li>
      <a href="https://twitter.com/share?text=<?= the_title(); ?>&via=plantchicago&url=<?= get_permalink( $post->ID ) ?>" target="_blank"><span class="sr-only">Twitter</span><svg class="icon icon-twitter"><use xlink:href="#icon-twitter"></svg></a>
    </li>
  </ul>
</div>
