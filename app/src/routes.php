<?php
namespace MPULL\DockerDemo;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Doctrine\ORM\EntityManager;
use MPULL\DockerDemo\Models\User;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });

    $app->get('/users', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/users' route");
        $db = $container->get(EntityManager::class)->getConnection();
        $sql = "SELECT * from users";
        // Render index view
        return $response->withJson($db->fetchAll($sql));
    });

    $app->get('/users/{id}', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/users' route");
        $db = $container->get(EntityManager::class)->getConnection();
        $sql = "SELECT * from users WHERE id = ?";
        // Render index view
        return $response->withJson($db->fetchAll($sql, [$args['id']]));
    });

    // $app->get('/users/[id]')
};
