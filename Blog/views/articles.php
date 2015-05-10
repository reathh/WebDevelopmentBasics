<div class="articles">
<?php
if (count($this->articles) != 0) :
foreach($this->articles as $article) : ?>

    <div class="article">
        <a href="/Articles/view/<?=$article['id']?>" class="title"><h2><?=$article['title']?></h2></a>
        <div class="visits">
            <span>Visits: </span> <?=$article['visits']?>
        </div>
        <?php
        if (count($article['tags']) != 0) : ?>
        <div class="tags">
            <span>Tags:</span>
                <?php foreach($article['tags'] as $tag) : ?>
                    <a href="/Articles/tags/<?=$tag?>"><?=$tag?></a>
                <?php endforeach; echo '</div>'; endif; ?>
        <div class="content">
            <?=$article['content']?>
        </div>
    </div>

<?php endforeach; else : echo '<h1>No articles exist</h1>'; endif;?>
</div>