<?php snippet('header') ?>

    <div class="shop_page">

        <?php $articles = $pages->findByUID('notes')->children()->visible()->filterBy('sale', 'forsale'); ?>

        <?php if($articles == ''): ?>

            Sorry, No products currently for sale

        <?php else: ?>

            <?php foreach($articles as $article): ?>

                <article class="product">
                    <a href="<?php echo $article->url() ?>">
                        <?php if($article->hasImages()): ?>
                            <img src="<?php echo $article->images()->first()->url() ?>" class="responsive" />
						<?php else: ?>
							<img src="assets/images/placeholder.png" class="responsive" />
                        <?php endif ?>

                        <?php echo $article->title() ?>
                    </a>
                </article>  

            <?php endforeach ?>  

        <?php endif ?>

    </div>

<?php snippet('footer') ?>