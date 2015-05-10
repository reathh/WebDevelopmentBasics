<table id="delete-articles">
<?php foreach ($this->articles as $article) : ?>
    <tr>
        <td><?=$article['title']?></td>
        <td><a href="/index.php/Articles/edit/<?=$article['id']?>">Edit</a></td>
    </tr>
<?php endforeach ?>
</table>
