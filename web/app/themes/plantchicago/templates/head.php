<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Karla:400,400italic,700' rel='stylesheet' type='text/css'>
  <?php wp_head(); ?>
  <meta name="description" content="">
  <meta property="og:title" content="<?= the_title(); ?> | Plant Chicago" />
  <?php $fb_image = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), ''); ?>
  <?php if ($fb_image) : ?>
    <meta property="og:image" content="<?php echo $fb_image[0]; ?>" />
  <?php endif; ?>
</head>
