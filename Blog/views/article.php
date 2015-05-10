<h1><?=$this->article['title']?></h1>
<?php
if (count($this->article['tags']) != 0) : ?>
<div class="tags">
    <span>Tags:</span>
    <?php foreach($this->article['tags'] as $tag) : ?>
        <a href="/Articles/tags/<?=$tag?>"><?=$tag?></a>
    <?php endforeach; echo '</div>'; endif; ?>
<div id="article-content"><?=$this->article['content']?></div>
<div class="comments">
    <?php foreach ($this->comments as $comment) : ?>
        <div class="comment">
            <div class="user-data">
                Date: <span class="name"><?=$comment['date_created']?></span>
                Name: <span class="name"><?=$comment['name']?></span>
                <?php if ($comment['email']) : ?> - Email: <span class="email"><?=$comment['email']?></span> <?php endif ?>
            </div>
            <div class="comment-content">
                <?=$comment['content']?>
            </div>
        </div>
    <?php endforeach ?>
</div>
<div class="add-comment">
    <form method="post">

    <?php if ($this->user['isLoggedIn']) : ?>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea>
        <input type="submit"/>
    <?php else : ?>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
        </div>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea>
        <input type="submit"/>
    <?php endif ?>

    </form>
</div>