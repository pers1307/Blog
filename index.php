<?php

namespace pers1307\blog;

use pers1307\blog\controllers\IndexController;

require __DIR__ . '/vendor/autoload.php';

$indexContoller = new IndexController();
$indexContoller->index();