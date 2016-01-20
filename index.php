<?php

namespace pers1307\blog;

use pers1307\blog\service\Autorization;

require __DIR__ . '/vendor/autoload.php';

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

Autorization::getInstance()->starSession();

$router = new RouteCollector();

$router->any('/', ['pers1307\blog\controllers\IndexController', 'indexAction']);
$router->any('/articlesDesk', ['pers1307\blog\controllers\ArticlesDeskController', 'findAllAction']);
$router->any('/deleteArticle/{id}', ['pers1307\blog\controllers\ArticlesDeskController','deleteArticle']);
$router->any('/article/{id}', ['pers1307\blog\controllers\ArticleController','findAction']);
$router->any('/article', ['pers1307\blog\controllers\ArticleController','displayAction']);
$router->any('/addArticle', ['pers1307\blog\controllers\ArticleController','addArticleAction']);

$dispatcher = new Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if (!is_null($response)) {
    $response->send();
}