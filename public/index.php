<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

// Create app
$app = new \Slim\App();

// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('../templates', [
        // 'cache' => '../cache'
    ]);

    // Add Slim-specific extensions
    $basePath = rtrim(
      str_ireplace(
        'index.php','',
        $container['request']->getUri()->getBasePath()
      ), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

$args = array();
$args['name'] = "Nate";

$app->get('/', function ($request, $response, $args) {
    return $this->view->render($response, 'home.twig', [
      'name' => $args['name']
    ]);
})->setName('home');

$app->get('/filter', function ($request, $response) {
    return $this->view->render($response, 'filter.twig');
})->setName('filter');

$app->run();
