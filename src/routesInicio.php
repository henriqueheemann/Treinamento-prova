<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/inicio/[{sucesso}]', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/inicio/' route");
        if ($_SESSION['login']['ehLogado'] != true) {
            return $response->withRedirect('/login/');
            exit;
        }

        $conexao = $container->get('pdo');

        $resultSet = $conexao->query('SELECT * FROM inicio')->fetchAll();

        $args['textos'] = $resultSet;
        
        // Render index view
        return $container->get('renderer')->render($response, 'inicio.phtml', $args);
    });
};
