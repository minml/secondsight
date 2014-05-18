<?php snippet('header') ?>

<section class="content cf">


	<?php if(param('tag')) {
	
	  $articles = $pages->find('notes')
	                    ->children()
	                    ->visible()
	                    ->filterBy('tags', param('tag'), ',')
	                    ->flip()
	                    ->paginate(5);
	
	} else {
	
	  $articles = $pages->find('notes')
	                    ->children()
	                    ->visible()
	                    ->flip()
	                    ->paginate(5);
	
	} ?>

	<?php if ( $page->children()->visible()->count() ) : foreach($articles as $article): ?>
	
	<article>
		<div id="headnotes" class="cf">
			<time datetime="<?php echo $article->date('c') ?>" pubdate="pubdate"><?php echo $article->date('d.m.Y') ?></time>
			<h1><a href="<?php echo $article->url() ?>"><?php echo html($article->title()) ?></a></h1>
		</div>
		<p><?php echo excerpt($article->text(), 300) ?></p>

		<div id="footnotes" class="cf">
			<a class="read" href="<?php echo $article->url() ?>">Read</a>

			<p class="tags">Tags: <?php foreach(str::split($article->tags()) as $tag): ?>
				<a href="<?php echo url('tag:' . urlencode($tag)) ?>">#<?php echo html($tag) ?></a>
			<?php endforeach ?></p>
		</div>
	</article>

	<?php endforeach; else : ?>

	<article>
		<h1><?php echo html($page->subtitle()) ?></h1>
		<?php echo kirbytext($page->text()) ?>
	</article>

	<?php endif; ?>

	<?php if($articles->pagination()->hasPages()): ?>
	<nav class="pagination cf">  

		<?php if($articles->pagination()->hasNextPage()): ?>
		<a class="next" href="<?php echo $articles->pagination()->nextPageURL() ?>">&lsaquo; newer posts</a>
		<?php endif ?>

		<?php if($articles->pagination()->hasPrevPage()): ?>
		<a class="prev" href="<?php echo $articles->pagination()->prevPageURL() ?>">older posts &rsaquo;</a>
		<?php endif ?>

	</nav>
	<?php endif ?>

</section>

<?php snippet('footer') ?>