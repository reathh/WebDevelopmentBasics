<?php

namespace Models;


class Article extends \GF\DB\SimpleDB {
    public function getAllArticles()
    {
       return $this->prepare("
            SELECT a.id, `title`, `content`, `visits`, GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
            FROM `articles` AS a
            LEFT JOIN `articles_tags` AS at ON a.id = at.article_id
            LEFT JOIN `tags` AS t ON at.tag_id = t.id
            GROUP BY a.id")->execute()->fetchAllAssoc();
    }

    public function getAllArticleTitles()
    {
        return $this->prepare("
            SELECT `id`, `title`
            FROM `articles`")->execute()->fetchAllAssoc();
    }

    public function getAllArticlesByTagName($tagName) {
        return $this->prepare("
            SELECT a.id, `title`, `content`, GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
            FROM `articles` AS a
            LEFT JOIN `articles_tags` AS at ON a.id = at.article_id
            LEFT JOIN `tags` AS t ON at.tag_id = t.id
            WHERE t.name = ?
            GROUP BY a.id", array($tagName))->execute()->fetchAllAssoc();
    }

    public function getArticleById($id) {
        return $this->prepare("
          SELECT `title`, `content`, GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
          FROM `articles` AS a
          LEFT JOIN `articles_tags` AS at ON a.id = at.article_id
          LEFT JOIN `tags` AS t ON at.tag_id = t.id
          WHERE a.id = ?
          GROUP BY a.id", array($id))->execute()->fetchAllAssoc()[0];
    }

    public function addArticle($title, $tags, $content) {
        $this->prepare("INSERT INTO articles (title, content) VALUES (?, ?)", array($title, $content))->execute();
        $articleId = $this->getLastInsertId();

        $tags = array_filter(explode(", ", $tags));
        foreach ($tags as $tag) {
            $tagId = $this->prepare("
            SELECT id FROM tags
            WHERE name = ?", array($tag))->execute()->fetchAllColumn('name')[0];
            if (!$tagId) {
                $this->prepare("INSERT INTO tags (name) VALUES (?)", array($tag))->execute();
                $tagId = $this->getLastInsertId();
            }
            $this->prepare("INSERT INTO articles_tags (article_id, tag_id) VALUES (?, ?)", array($articleId, $tagId))->execute();
        }
    }

    public function increaseViewsByOne($id) {
        $this->prepare("UPDATE `articles` SET `visits`=visits + 1 WHERE id = ?", array($id))->execute();
    }

    public function deleteArticle($id) {
        $this->prepare("DELETE FROM `articles` WHERE id = ?", array($id))->execute();
    }
}