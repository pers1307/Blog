<?php

namespace pers1307\blog;

use pers1307\blog\controllers;

require_once 'src/controllers/AutorizationController.php';

$AutorizationContoller = new controllers\AutorizationController();
$AutorizationContoller->autorization();