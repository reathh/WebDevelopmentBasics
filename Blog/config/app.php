<?php
$cnf['default_controller']='Articles';
$cnf['default_method']='view';
$cnf['namespaces']['Controllers']='../controllers/';
$cnf['namespaces']['Models']='../models/';
$cnf['rootUrl'] = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

$cnf['displayExceptions'] = true;

$cnf['session']['autostart'] = true;
$cnf['session']['type'] = 'native';
$cnf['session']['name'] = '__sess';
$cnf['session']['lifetime'] = 3600;
$cnf['session']['path'] = '/';
$cnf['session']['domain'] = '';
$cnf['session']['secure'] = false;
$cnf['session']['dbConnection'] = 'default';
$cnf['session']['dbTable'] = 'sessions';
return $cnf;
