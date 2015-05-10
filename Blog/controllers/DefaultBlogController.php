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


    /**
     * @var \Models\Comment
     */
    protected $commentModel;

    public function __construct() {
        parent::__construct();
        $this->articleModel = new \Models\Article();
        $this->tagModel = new \Models\Tag();
        $this->userModel = new \Models\User();
        $this->commentModel = new \Models\Comment();

        $this->view->user = array('isLoggedIn' => $this->userModel->isUserLoggedIn(),
                                    'data' => $this->userModel->getCurrentlyLoggedUser(),
                                    'isAdmin' => $this->userModel->isUserAdmin());
        $this->view->appendToLayout('user', 'header');

        $tags = $this->tagModel->getAllTags();
        $this->view->tags = $tags;
        $this->view->appendToLayout('tags', 'tags');

    }
}