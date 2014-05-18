<?php snippet('header') ?>

        <section class="content cf">

                <article>

                        <div id="headnotes" class="cf">
                                <h1><?php echo html($page->title()) ?></h1>
                        </div>

                        <?php echo kirbytext($page->text()) ?>

                </article>

        </section>

<?php snippet('footer') ?>