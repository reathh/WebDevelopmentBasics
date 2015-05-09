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

        $this->view->display('layouts.default');
    }

    private function showAllArticles()
    {
        $articles = $this->articleModel->getAllArticles();
        $this->prepareArticlesForView($articles);

        $this->view->display('layouts.default');
    }

    private function showArticleById($id) {
        if ($this->input->post('content')) {
            
        }
        $article = $this->articleModel->getArticleById($id);
        $articleComments = $this->commentModel->getCommentsForArticle($id);
        $this->prepareTagsForView($article);

        $this->view->article = $article;
        $this->view->comments = $articleComments;
        $this->view->appendToLayout('body', 'article');

        $this->view->display('layouts.default');
    }

    private function prepareArticlesForView($articles) {
        for ($i = 0; $i < count($articles); $i++) {
            $articles[$i]['content'] = substr($articles[$i]['content'], 0, $this->config->blog['allArticlesContentLength']) . '...';
            $this->prepareTagsForView($articles[$i]);
        }

        $this->view->articles = $articles;

        $this->view->appendToLayout('body', 'articles');
    }



    private function prepareTagsForView(&$article) {
        $article['tags'] = array_filter(explode(',',  $article['tags']));
        $article['tags'] = array_map('trim', $article['tags']);
    }



}