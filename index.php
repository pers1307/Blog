<?php

namespace pers1307\blog;

require __DIR__ . '/vendor/autoload.php';

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

autorization\Autorization::getInstance()->starSession();

$router = new RouteCollector();

$router->any('/', ['pers1307\blog\controllers\IndexController', 'indexAction']);
$router->any('/articlesDesk', ['pers1307\blog\controllers\ArticlesDeskController', 'articlesDeskAction']);
$router->any('/deleteArticle/{id}',['pers1307\blog\controllers\AjaxController','deleteArticle']);
$router->any('/EditArticle',['pers1307\blog\controllers\ArticlesDeskController','editArticleAction']);

$dispatcher = new Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
echo $response;