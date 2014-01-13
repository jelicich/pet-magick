<?php

session_start();
include_once "../php/classes/BONews.php";
$news = new BONews;

var_dump($news->getNews($_SESSION['id']));