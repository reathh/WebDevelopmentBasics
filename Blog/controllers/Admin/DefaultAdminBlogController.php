<?php
/**
 * Created by PhpStorm.
 * User: Reath
 * Date: 5/10/15
 * Time: 1:53 PM
 */

namespace Controllers\Admin;


use Controllers\DefaultBlogController;
use GF\Common;

class DefaultAdminBlogController extends DefaultBlogController {
    public function __construct() {
        parent::__construct();

        if (!$this->userModel->isUserAdmin()) {
            Common::redirect($this->config->app['rootUrl']);
            return;
        }
    }

}