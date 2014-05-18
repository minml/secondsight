<?php snippet('header') ?>

<section class="content cf">

	<article>
		<div id="headnotes" class="cf">
			<time datetime="<?php echo $page->date('c') ?>" pubdate="pubdate"><?php echo $page->date('d.m.Y') ?></time>
			<h1><?php echo html($page->title()) ?><?php if($page->price() != ''): ?> - 
                <span class="price">€<?php echo $page->price() ?></span>
                <span class="pricetest">€<?php echo $page->price() ?></span>
                <span class="vat">€<?php echo $page->vat() ?></span>
                <?php endif ?>
            </h1>
		</div>
		<?php echo kirbytext($page->text()) ?>
        
        <div id="footnotes" class="cf">
			<a class="read" href="<?php echo url('notes') ?>">Back</a>
            
            <?php if($page->price() != ''): ?>
                <form method="post" action="<?php echo url('notes/cart') ?>">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="id" value="<?php echo $page->uid() ?>">
                    <button type="submit" class="addcart">Add to Cart</button>
                </form>
            <?php endif ?>

			<p class="tags">Tags: <?php foreach(str::split($page->tags()) as $tag): ?>
				<a href="<?php echo url('tag:' . urlencode($tag)) ?>">#<?php echo html($tag) ?></a>
			<?php endforeach ?></p>
		</div>
	</article>

</section>

<?php snippet('footer') ?>