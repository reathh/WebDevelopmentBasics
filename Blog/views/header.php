<div>
    <div>
        <?php if ($this->user['isLoggedIn']) : ?>
            <span id="username"><?=$this->user['data']['username']?></span> <a href="/Users/logout">[logout]</a>
        <?php else : ?>
            <a href="/Users/login">Login</a> <a href="/Users/register">Register</a>
        <?php endif ?>
    </div>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <?php if ($this->user['isAdmin']) {
                echo '<li><a href="/Admin//Articles/add">Add Article</a></li>';
                echo '<li><a href="/Admin//Articles/delete">Delete Article</a></li>';
                echo '<li><a href="/Admin/Articles/edit">Edit Article</a></li>';
            } ?>
        </ul>
    </nav>
</div>