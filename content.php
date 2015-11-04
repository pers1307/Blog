<?php

namespace pers1307\blog;

use pers1307\blog\controllers\ControlContentController;

require __DIR__ . '/vendor/autoload.php';

$controlContentContoller = new controllers\ControlContentController();
$controlContentContoller->controlContent();