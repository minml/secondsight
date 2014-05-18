<?php snippet('header') ?>

        <section class="content cf">
                
                <article>
                        <?php $articles = $pages->findByUID('home')->children()->visible()->limit(1) ?>
                        <?php if($articles == ''): ?>
                                <?php go('notes') ?>
                        <?php else: ?>
                        <?php foreach($articles as $article): ?>
                        
                                <div id="headnotes" class="cf">
                                        <h1><?php echo html($article->title()) ?></h1>
                                </div>
                        
                        		<?php echo kirbytext($article->text()) ?>
                        <?php endforeach ?>
                        <?php endif ?>
                </article>
                
        </section>

<?php snippet('footer') ?>