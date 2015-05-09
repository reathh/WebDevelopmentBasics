<?php

namespace Controllers;


use GF\Common;

class Articles extends \Controllers\DefaultBlogController {

    public function view() {
        $id = $this->input->get(0);
        if (!$id) {
            $this->showAllArticles();
        } else {
            $this->showArticleById($id);
        }
    }

    public function tags() {
        $tagName = $this->input->get(0);
        if (!$tagName) {
            Common::redirect($this->config->app['rootUrl']);
            return;
        }

        $articles = $this->articleModel->getAllArticlesByTagName($tagName);
        $this->prepareArticlesForView($articles);

        $this->view->display('layouts.search');
    }

    private function prepareArticlesForView($articles) {
        for ($i = 0; $i < count($articles); $i++) {
            $articles[$i]['tags'] = array_filter(explode(',',  $articles[$i]['tags']));
            $articles[$i]['tags'] = array_map('trim', $articles[$i]['tags']);
        }

        $this->view->articles = $articles;
        $this->view->appendToLayout('body', 'articles');
    }

    private function showAllArticles()
    {
        $articles = $this->articleModel->getAllArticles();
        $this->prepareArticlesForView($articles);

        $tags = $this->tagModel->getAllTags();

        $this->view->tags = $tags;
        $this->view->appendToLayout('tags', 'tags');

        $this->view->display('layouts.default');
    }

    private function showArticleById($id) {

    }
}