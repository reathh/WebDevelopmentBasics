<?php

namespace Controllers;


use GF\Common;

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

        $this->populateTagsToView();
        $this->populateLastArticlesToView();

        $f = \GF\FrontController::getInstance();
        $this->view->title = ucfirst($f->method) . ' ' . ucfirst($f->controller);
        if ($this->input->get(0)) {
            $this ->view->title .= ' ' . $this->input->get(0);
        }
    }

    private function populateTagsToView() {
        $tags = $this->tagModel->getAllTags();
        for($i = 0; $i < count($tags); $i++) {
            $tags[$i]['count'] = $this->config->blog['startingSizeForTags'] + Common::normalize($this->tagModel->getCountOfQuestionsByTagName($tags[$i]['name']), 'int');
        }
        $this->view->tags = $tags;
        $this->view->maxSizeForTags = $this->config->blog['maxSizeForTags'];
        $this->view->appendToLayout('tags', 'partials.tags');
    }

    private function populateLastArticlesToView() {
        $this->view->lastArticles = $this->articleModel->getAllArticles($this->config->blog['numberOfArticlesAtSidebar']);
        $this->view->appendToLayout('lastArticles', 'partials.last-articles');
    }
}