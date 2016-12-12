<?php

// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('../templates', [
        // 'cache' => '../cache'
    ]);

    /**
     * Add Slim-specific extensions
     */
    $basePath = rtrim(
      str_replace(
        'index.php','',
        $container['request']->getUri()->getBasePath()
      ), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    /**
     * Get date from image name, won't need this once we're in DB
     */
    $img_name_to_date = new Twig_SimpleFunction('img_name_to_date', function ($imgName) {

      $cleanedName = substr($imgName, -14, 10);
      $date = date("F j, Y, g:i a", $cleanedName);

      return $date;
    });

    $view->getEnvironment()->addFunction($img_name_to_date);

    /**
     * For debugging
     */
    $var_dump = new Twig_SimpleFunction('var_dump', function ($object) {

      return var_dump($object);

    });

    $view->getEnvironment()->addFunction($var_dump);

    return $view;
};
