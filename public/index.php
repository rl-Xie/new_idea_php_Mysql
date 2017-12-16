<?php
require_once('../util/helper.php');
tpl('Pdo/pdo');
$db = new Db('user');
$db->connect();

$data = $db
    ->where('title', '>', '10')
    ->order_by('id','desc')
    ->limit('10','0');


