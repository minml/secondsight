<?php snippet('header') ?>

<section class="content cf">

	<article>
		<h1><?php echo html($page->title()) ?></h1>
		<?php echo kirbytext($page->text()) ?>
	</article>

</section>

<?php snippet('footer') ?>