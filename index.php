<?php

namespace pers1307\blog;

use pers1307\blog\controllers;

require_once 'src/controllers/IndexController.php';

$indexContoller = new controllers\IndexController();
$indexContoller->index();