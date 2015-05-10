<?php

namespace Models;


class Tag extends \GF\DB\SimpleDB {
    public function getAllTags() {
        return $this->prepare("SELECT name FROM tags")->execute()->fetchAllAssoc();
    }

    public function getCountOfQuestionsByTagName($name) {
        return $this->prepare("SELECT COUNT(*) AS count
                        FROM articles_tags AS at
                        JOIN tags AS t ON at.tag_id = t.id
                        WHERE t.name = ?", array($name))->execute()->fetchAllColumn('count')[0];
    }
}