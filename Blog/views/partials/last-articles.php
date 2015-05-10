<?php
foreach ($this->lastArticles as $article) : ?>
    <ul>
        <li><a href="/Articles/view/<?=$article['id']?>"><?=$article['title']?></a></li>
    </ul>
<?php endforeach ?>