<?php
if (count($this->tags) == 0) :
    echo "There aren't any tags at the moment";
else:
foreach($this->tags as $tag) : ?>
    <a href="/index.php/Articles/tags/<?=$tag?>"><?=$tag?></a>
<?php endforeach; endif; ?>