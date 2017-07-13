<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php wp_title(''); if (wp_title('', false))  echo ' | '; bloginfo('name'); ?>
    </title>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/bundle.min.css">
    <?php wp_head(); ?>
</head>

<body>
  <?php  // get_template_part('template-parts/modules/inner', 'hero'); ?>
