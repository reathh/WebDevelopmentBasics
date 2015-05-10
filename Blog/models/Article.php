<?php

namespace Models;


use GF\Common;

class Article extends \GF\DB\SimpleDB {
    public function getAllArticles()
    {
       $articles = $this->prepare("
            SELECT a.id, `title`, `content`, `visits`, GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
            FROM `articles` AS a
            LEFT JOIN `articles_tags` AS at ON a.id = at.article_id
            LEFT JOIN `tags` AS t ON at.tag_id = t.id
            GROUP BY a.id")->execute()->fetchAllAssoc();

        for($i = 0; $i < count($articles); $i++) {
            $articles[$i]['title'] = Common::normalize($articles[$i]['title'], 'xss');
        }
        return $articles;
    }

    public function getAllArticleTitles()
    {
        $articles = $this->prepare("
            SELECT `id`, `title`
            FROM `articles`")->execute()->fetchAllAssoc();

        for($i = 0; $i < count($articles); $i++) {
            $articles[$i]['title'] = Common::normalize($articles[$i]['title'], 'xss');
        }
        return $articles;
    }

    public function getAllArticlesByTagName($tagName) {
        $articles =  $this->prepare("
            SELECT a.id, `title`, `content`, GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
            FROM `articles` AS a
            LEFT JOIN `articles_tags` AS at ON a.id = at.article_id
            LEFT JOIN `tags` AS t ON at.tag_id = t.id
            WHERE t.name = ?
            GROUP BY a.id", array($tagName))->execute()->fetchAllAssoc();

        for($i = 0; $i < count($articles); $i++) {
            $articles[$i]['title'] = Common::normalize($articles[$i]['title'], 'xss');
        }
        return $articles;
    }

    public function getArticleById($id) {
        $article = $this->prepare("
          SELECT `title`, `content`, GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
          FROM `articles` AS a
          LEFT JOIN `articles_tags` AS at ON a.id = at.article_id
          LEFT JOIN `tags` AS t ON at.tag_id = t.id
          WHERE a.id = ?
          GROUP BY a.id", array($id))->execute()->fetchAllAssoc()[0];

        $article['title'] =  Common::normalize($article['title'], 'xss');
        return $article;
    }

    public function addArticle($title, $tags, $content) {
        $this->prepare("INSERT INTO articles (title, content) VALUES (?, ?)", array($title, $content))->execute();
        $articleId = $this->getLastInsertId();

        $this->addTagsToArticle($tags, $articleId);
    }

    public function increaseViewsByOne($id) {
        $this->prepare("UPDATE `articles` SET `visits`=visits + 1 WHERE id = ?", array($id))->execute();
    }

    public function deleteArticle($id) {
        $this->prepare("DELETE FROM `articles` WHERE id = ?", array($id))->execute();
    }

    public function editArticle($id, $title, $tags, $content) {
        $this->prepare("UPDATE `articles` SET `title`=?,`content`=? WHERE id=?", array($title, $content, $id))->execute();
        $this->deleteTagsFromArticle($id);
        $this->addTagsToArticle($tags, $id);
    }

    /**
     * @param $tags
     * @param $articleId
     */
    private function addTagsToArticle($tags, $articleId)
    {
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

    private function deleteTagsFromArticle($articleId) {
        $this->prepare("DELETE FROM `articles_tags` WHERE article_id = ?", array($articleId))->execute();
    }
}