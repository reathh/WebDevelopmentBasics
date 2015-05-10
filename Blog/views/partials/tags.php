<?php
if (count($this->tags) == 0) :
    echo "There aren't any tags at the moment";
else:
foreach($this->tags as $tag) : ?>
    <a href="/Articles/tags/<?=$tag['name']?>" style="font-size: <?=min($tag['count'], $this->maxSizeForTags)?>"><?=$tag['name']?></a>
<?php endforeach; endif; ?>