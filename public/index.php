<?php

date_default_timezone_set('Pacific/Honolulu');

require '../vendor/autoload.php';

$app = new \Slim\App();

require __DIR__ . '/../src/middleware.php';

require __DIR__ . '/../src/routes.php';

$app->run();
