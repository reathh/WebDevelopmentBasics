<?php
$cnf['default']['connection_uri']='mysql:host=localhost;dbname=reaths3_blog';
$cnf['default']['username']='reaths3_blog';
$cnf['default']['password']='root1';
$cnf['default']['pdo_options'][PDO::MYSQL_ATTR_INIT_COMMAND]="SET NAMES 'UTF8'";
$cnf['default']['pdo_options'][PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;

return $cnf;