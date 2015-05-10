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

    public function add() {
        if (!$this->userModel->isUserAdmin()) {
            Common::redirect($this->config->app['rootUrl']);
            return;
        }
        if ($this->input->post('title') && $this->input->post('content')) {
            try {
                $this->articleModel->addArticle($this->input->post('title'), $this->input->post('tags'), $this->input->post('content'));
                echo 'Successfully added article.';
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
        $this->view->appendToLayout('body', 'addArticle');
        $this->view->display('layouts.default');
    }

    public function delete() {
        if (!$this->userModel->isUserAdmin()) {
            Common::redirect($this->config->app['rootUrl']);
            return;
        }

        $articleId = $this->input->get(0);
        if ($articleId) {
            try {
                $this->articleModel->deleteArticle($articleId);
                echo 'Successfully deleted article';
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
        $this->view->articles = $this->articleModel->getAllArticleTitles();
        $this->view->appendToLayout('body', 'listArticlesToDelete');
        $this->view->display('layouts.default');
    }

    public function edit() {
        if (!$this->userModel->isUserAdmin()) {
            Common::redirect($this->config->app['rootUrl']);
            return;
        }

        $articleId = $this->input->get(0);
        if ($articleId) {
            if ($this->input->post('title') && $this->input->post('content')) {
                try {
                    $this->articleModel->editArticle($articleId,
                        $this->input->post('title'),
                        $this->input->post('tags'),
                        $this->input->post('content'));
                    echo 'Successfully edited article';
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            }
            $this->view->article = $this->articleModel->getArticleById($articleId);
            $this->view->appendToLayout('body', 'editArticle');
            $this->view->display('layouts.default');
        }
        else {
            $this->view->articles = $this->articleModel->getAllArticleTitles();
            $this->view->appendToLayout('body', 'listArticlesToEdit');
            $this->view->display('layouts.default');
        }
    }

    private function showAllArticles()
    {
        $articles = $this->articleModel->getAllArticles();
        $this->prepareArticlesForView($articles);

        $this->view->display('layouts.default');
    }

    private function showArticleById($id) {
        if ($this->input->post('content')) {
            try {
                $this->addComment($id, $this->input->post('content'));
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
        $article = $this->articleModel->getArticleById($id);
        $this->articleModel->increaseViewsByOne($id);

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

    /**
     * @param $id
     * @throws \Exception
     */
    private function addComment($id, $content)
    {
        if (strlen($content) < $this->config->blog['minimumLengthForComments']) {
            throw new \Exception('Length of content too low.');
        }

        $name = null;
        $email = null;


        if (!$this->userModel->isUserLoggedIn()) {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            if (!$name) {
                throw new \Exception('No name provided for comment');
            }
        } else {
            $name = $this->userModel->getCurrentlyLoggedUser()['username'];
            $email = $this->userModel->getCurrentlyLoggedUser()['email'];

        }

        $this->commentModel->addComment($id, $name, $email, $content);

    }

}