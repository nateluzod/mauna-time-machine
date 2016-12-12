<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Aws\S3\S3Client;

/**
 * Home
 */
$app->get('/', function ($request, $response) {

    $client = S3Client::factory(array(
        'credentials' => array(
            'key'    => getenv('AWS_ACCESS_KEY_ID'),
            'secret' => getenv('AWS_SECRET_KEY'),
        ),
        'region' => 'us-east-1',
        'version' => 'latest'
    ));

    $iterator = $client->getIterator('ListObjects', array(
        'Bucket' => 'mauna-time-machine'
    ));

    return $this->view->render($response, 'home.twig', [
      'images' => $iterator
    ]);

})->setName('home');

/**
 * Filter
 */
$app->get('/filter', function ($request, $response) {

    return $this->view->render($response, 'filter.twig');

})->setName('filter');
