<div class="articles">
<?php
if (count($this->articles) != 0) :
foreach($this->articles as $article) : ?>

    <div class="article">
        <h2 class="title"><?=$article['title']?></h2>
        <div class="tags">
            <span>Tags:</span>

            <?php
            if (count($article['tags']) == 0) :
                echo 'None';
            else:
                foreach($article['tags'] as $tag) : ?>
                    <a href="/index.php/Articles/tags/<?=$tag?>"><?=$tag?></a>
                <?php endforeach; endif; ?>
        </div>
    </div>

<?php endforeach; else : echo '<h1>No articles exist</h1>'; endif;?>
</div>