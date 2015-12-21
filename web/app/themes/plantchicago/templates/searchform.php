<form role="search" method="get" class="search-form form-inline" action="<?= esc_url(home_url('/')); ?>">
  <label class="sr-only"><?php _e('Search for:', 'sage'); ?></label>
  <input type="search" value="" autocomplete="off" name="s" class="search-field form-control" placeholder="Search..." required>
  <button type="submit" class="search-submit"><span class="sr-only"><?php _e('Search', 'sage'); ?></span><svg class="icon icon-search"><use xlink:href="#icon-search"></svg></button>
  <div aria-hidden="true" class="close-button x-button"><div class="x"></div></div>
</form>