<div class="articles">
<?php
if (count($this->articles) != 0) :
foreach($this->articles as $article) : ?>

    <div class="article">
        <a href="/index.php/Articles/view/<?=$article['id']?>" class="title"><h2><?=$article['title']?></h2></a>


        <?php
        if (count($article['tags']) != 0) : ?>
        <div class="tags">
            <span>Tags:</span>
                <?php foreach($article['tags'] as $tag) : ?>
                    <a href="/index.php/Articles/tags/<?=$tag?>"><?=$tag?></a>
                <?php endforeach; echo '</div>'; endif; ?>
        <div class="content">
            <?=$article['content']?>
        </div>
    </div>

<?php endforeach; else : echo '<h1>No articles exist</h1>'; endif;?>
</div>