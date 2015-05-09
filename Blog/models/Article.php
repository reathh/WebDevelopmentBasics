<?php

namespace Models;


class Article extends \GF\DB\SimpleDB {
    public function getAllArticles()
    {
       return $this->prepare("
            SELECT a.id, `title`, GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
            FROM `articles` AS a
            LEFT JOIN `articles_tags` AS at ON a.id = at.article_id
            LEFT JOIN `tags` AS t ON at.tag_id = t.id
            GROUP BY a.id")->execute()->fetchAllAssoc();
    }

    public function getAllArticlesByTagName($tagName) {
        return $this->prepare("
            SELECT a.id, `title`, GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
            FROM `articles` AS a
            LEFT JOIN `articles_tags` AS at ON a.id = at.article_id
            LEFT JOIN `tags` AS t ON at.tag_id = t.id
            WHERE t.name = ?
            GROUP BY a.id", array($tagName))->execute()->fetchAllAssoc();
    }
}