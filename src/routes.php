<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;



$app->get('/', function ($request, $response, $images) {

    $images = glob('../public/img/*.{jpg}', GLOB_BRACE);
    $images = str_replace('../public/', '', $images);
    return $this->view->render($response, 'home.twig', [
      'images' => $images
    ]);
})->setName('home');


$app->get('/filter', function ($request, $response) {
    return $this->view->render($response, 'filter.twig');
})->setName('filter');
