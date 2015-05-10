<div id="edit-article">
    <a href="/index.php/Articles/edit">Go back to list of articles</a>
    <form method="post">
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?=$this->article['title']?>">
        </div>
        <div>
            <label for="tags">Tags:</label>
            <input type="text" id="tags" name="tags" value="<?=$this->article['tags']?>">
        </div>
        <div>
            <label for="content">Content:</label>
            <textarea id="content" name="content"><?=$this->article['content']?></textarea>
        </div>
        <div>
            <input type="submit"/>
        </div>
    </form>
</div>