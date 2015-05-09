<?php
/**
 * Created by PhpStorm.
 * User: Reath
 * Date: 5/10/15
 * Time: 2:03 AM
 */

namespace Models;


class Comment extends \GF\DB\SimpleDB {
    public function addComment($articleId, $name, $email, $content) {
        $this->prepare("INSERT INTO comments (article_id, name, email, content)
                        VALUES (?, ?, ?, ?)", array($articleId, $name, $email, $content))->execute();
    }

    public function getCommentsForArticle($articleId) {
        return $this->prepare("SELECT * FROM comments
                                WHERE article_id = ?", array($articleId))->execute()->fetchAllAssoc();
    }
}