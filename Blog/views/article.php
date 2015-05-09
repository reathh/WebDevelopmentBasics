<h1><?=$this->article['title']?></h1>
<?php
if (count($this->article['tags']) != 0) : ?>
<div class="tags">
    <span>Tags:</span>
    <?php foreach($this->article['tags'] as $tag) : ?>
        <a href="/index.php/Articles/tags/<?=$tag?>"><?=$tag?></a>
    <?php endforeach; echo '</div>'; endif; ?>
<div><?=$this->article['content']?></div>