<table id="delete-articles">
<?php foreach ($this->articles as $article) : ?>
    <tr>
        <td><?=$article['title']?></td>
        <td><a href="/index.php/Articles/delete/<?=$article['id']?>">Delete</a></td>
    </tr>
<?php endforeach ?>
</table>
