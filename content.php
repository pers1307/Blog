<?php

namespace pers1307\blog;

use pers1307\blog\controllers;

require_once 'src/controllers/ControlContentController.php';

$controlContentContoller = new controllers\ControlContentController();
$controlContentContoller->controlContent();