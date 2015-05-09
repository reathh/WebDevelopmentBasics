<?php

namespace Models;


class Tag extends \GF\DB\SimpleDB {
    public function getAllTags() {
        return $this->prepare("SELECT name FROM tags")->execute()->fetchAllColumn('name');
    }
}