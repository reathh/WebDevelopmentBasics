<table id="delete-articles">
<?php foreach ($this->articles as $article) : ?>
    <tr>
        <td><?=$article['title']?></td>
        <td><a href="/Admin/Articles/delete/<?=$article['id']?>">Delete</a></td>
    </tr>
<?php endforeach ?>
</table>
