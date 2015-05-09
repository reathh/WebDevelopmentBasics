<?php

namespace Models;

class User extends \GF\DB\SimpleDB {
    private $app;

    public function __construct() {
        parent::__construct();
        $this->app =  \GF\App::getInstance();
    }
    public function register($username, $password, $email) {
        $hash = md5($username.$password);
        $this->prepare("INSERT INTO users (username, email, hash)
                        VALUES (?, ?, ?)", array($username, $email, $hash))->execute();
        $this->login($username, $password);
    }

    public function login($username, $password) {
        $hash = md5($username.$password);

        $user = $this->prepare("SELECT * FROM users
                        WHERE username = ? AND hash = ?", array($username, $hash))->execute()->fetchRowAssoc();
        if (!$user) {
            throw new \Exception("invalid login details", 400);
        }
        $this->loginUser($user);
    }

    private function loginUser($user) {
        unset($user['hash'], $user['id'], $user['is_admin']);

        $this->app->getSession()->user = serialize($user);
    }

    public function isUserLoggedIn() {
        return (bool) $this->getCurrentlyLoggedUser();
    }
    public function getCurrentlyLoggedUser() {
        return unserialize($this->app->getSession()->user);
    }

    public function isUserAdmin() {
        if (!$this->getCurrentlyLoggedUser()['username']) {
            return false;
        }

        $isAdmin = $this->prepare("
        SELECT is_admin FROM users
        WHERE username = ?", array($this->getCurrentlyLoggedUser()['username']))->execute()->fetchAllColumn('is_admin')[0];

        return (bool) $isAdmin;
    }
}