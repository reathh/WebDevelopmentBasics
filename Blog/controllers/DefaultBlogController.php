<?php

namespace Controllers;


class DefaultBlogController extends \GF\DefaultController {
    /**
     * @var \Models\Article
     */
    protected $articleModel;

    /**
     * @var \Models\Tag
     */
    protected $tagModel;

    /**
     * @var \Models\User
     */
    protected $userModel;

    public function __construct() {
        parent::__construct();
        $this->articleModel = new \Models\Article();
        $this->tagModel = new \Models\Tag();
        $this->userModel = new \Models\User();

        $this->view->user = array('isLoggedIn' => $this->userModel->isUserLoggedIn());
        $this->view->appendToLayout('user', 'header');
    }
}