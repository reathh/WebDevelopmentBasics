<?php

namespace Controllers\Admin;


use GF\Common;

class Articles extends \Controllers\Admin\DefaultAdminBlogController {
    public function add() {
        if ($this->input->post('title') && $this->input->post('content')) {
            try {
                $this->articleModel->addArticle($this->input->post('title'), $this->input->post('tags'), $this->input->post('content'));
                echo 'Successfully added article.';
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
        $this->view->appendToLayout('body', 'admin.addArticle');
        $this->view->display('layouts.default');
    }

    public function delete() {
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
        $this->view->appendToLayout('body', 'admin.listArticlesToDelete');
        $this->view->display('layouts.default');
    }

    public function edit() {
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
            $this->view->appendToLayout('body', 'admin.editArticle');
            $this->view->display('layouts.default');
        }
        else {
            $this->view->articles = $this->articleModel->getAllArticleTitles();
            $this->view->appendToLayout('body', 'admin.listArticlesToEdit');
            $this->view->display('layouts.default');
        }
    }

}