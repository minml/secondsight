<?php snippet('header') ?>

<section class="content">

	<article>
		<div id="headnotes" class="cf">
			<a class="twitter" href="https://twitter.com/<?php echo $page->twitter() ?>">twitter</a>
			<h1><?php echo html($page->title()) ?></h1>
		</div>
		<?php snippet('contactform') ?>
	</article>

</section>

<?php snippet('footer') ?>