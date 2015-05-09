<?php

namespace Controllers;

use GF\Common;

class Users extends DefaultBlogController {
    public function register() {
        if ($this->input->post('username') && $this->input->post('email') && $this->input->post('password')) {
            $this->userModel->register($this->input->post('username'), $this->input->post('password'), $this->input->post('email'));
            Common::redirect($this->config->app['rootUrl']);
        }
        $this->view->appendToLayout('body', 'register');
        $this->view->display('layouts.default');
    }

    public function login() {
        if ($this->input->post('username') && $this->input->post('password')) {
            try {
                $this->userModel->login($this->input->post('username'), $this->input->post('password'));
                Common::redirect($this->config->app['rootUrl']);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
        $this->view->appendToLayout('body', 'login');
        $this->view->display('layouts.default');
    }

    public function logout() {
        $this->userModel->logout();
        Common::redirect($this->config->app['rootUrl']);
    }

}