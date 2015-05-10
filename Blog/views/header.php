<div>
    <div>
        <?php if ($this->user['isLoggedIn']) : ?>
            <span id="username"><?=$this->user['data']['username']?></span> <a href="/index.php/Users/logout">[logout]</a>
        <?php else : ?>
            <a href="/index.php/Users/login">Login</a> <a href="/index.php/Users/register">Register</a>
        <?php endif ?>
    </div>
    <nav>
        <ul>
            <li><a href="/index.php">Home</a></li>
            <?php if ($this->user['isAdmin']) {
                echo '<li><a href="/index.php/Articles/add">Add Article</a></li>';
                echo '<li><a href="/index.php/Articles/delete">Delete Article</a></li>';
                echo '<li><a href="/index.php/Articles/edit">Edit Article</a></li>';
            } ?>
        </ul>
    </nav>
</div>