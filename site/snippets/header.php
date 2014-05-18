<!doctype html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<!--[if lt IE 9]> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<title><?php echo html($site->title()) ?> - <?php echo html($page->title()) ?></title>
	<meta name="description" content="<?php echo html($site->description()) ?>" />
	<meta name="keywords" content="<?php echo html($site->keywords()) ?>" />
	<meta name="robots" content="index, follow" />

	<?php echo css('//fonts.googleapis.com/css?family=Lato:400,700') ?>
	<?php echo css('assets/styles/styles.css') ?>

	<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
</head>

<body class="<?php echo $page->template() ?>">

<section id="wrap">

<header class="header cf">
	<a class="logo" href="<?php echo $site->url() ?>">
        <?php if($page->isHomePage()): ?>
		      <img src="<?php echo url('assets/images/logo_black.jpg') ?>" alt="<?php echo html($site->title()) ?>" class="logo" />
        <?php else: ?>
                <img src="<?php echo url('assets/images/logo_white.jpg') ?>" alt="<?php echo html($site->title()) ?>" class="logo" />
        <?php endif ?>
	</a>
	<?php snippet('menu') ?>
</header>