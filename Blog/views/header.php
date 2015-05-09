<div>
    <?php
    if ($this->user['isLoggedIn']) {
        echo 'logged in';
    }
    else {
        echo 'not logged in';
    }
    ?>
</div>