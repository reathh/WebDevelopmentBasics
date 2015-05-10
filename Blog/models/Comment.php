<?php
/**
 * Created by PhpStorm.
 * User: Reath
 * Date: 5/10/15
 * Time: 2:03 AM
 */

namespace Models;


use GF\Common;

class Comment extends \GF\DB\SimpleDB {
    public function addComment($articleId, $name, $email, $content) {
        $this->prepare("INSERT INTO comments (article_id, name, email, content)
                        VALUES (?, ?, ?, ?)", array($articleId, $name, $email, $content))->execute();
    }

    public function getCommentsForArticle($articleId) {
        $comments = $this->prepare("SELECT * FROM comments
                                WHERE article_id = ?", array($articleId))->execute()->fetchAllAssoc();
        for ($i = 0; $i < count($comments); $i++) {
            $comments[$i]['content'] = Common::normalize($comments[$i]['content'], 'xss');
            $comments[$i]['name'] = Common::normalize($comments[$i]['name'], 'xss|trim');
            $comments[$i]['email'] = Common::normalize($comments[$i]['email'], 'xss|trim');
        }
        return $comments;
    }
}