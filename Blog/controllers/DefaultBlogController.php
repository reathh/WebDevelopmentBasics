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

    public function __construct() {
        parent::__construct();
        $this->articleModel = new \Models\Article();
        $this->tagModel = new \Models\Tag();
    }
}