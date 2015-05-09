<div>
    <?php if ($this->user['isLoggedIn']) : ?>
        <span id="username"><?=$this->user['data']['username']?></span> <a href="/index.php/Users/logout">[logout]</a>
    <?php else : ?>
        <a href="/index.php/Users/login">Login</a> <a href="/index.php/Users/register">Register</a>
    <?php endif ?>
</div>
<div class="clear"></div>