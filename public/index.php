<?php

// echo getenv('AWS_ACCESS_KEY_ID');
// echo getenv('AWS_SECRET_KEY');

date_default_timezone_set('Pacific/Honolulu');

require '../vendor/autoload.php';

$app = new \Slim\App();

require __DIR__ . '/../src/middleware.php';

require __DIR__ . '/../src/routes.php';

$app->run();
