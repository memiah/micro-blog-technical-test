<?php

// Silex documentation: http://silex.sensiolabs.org/doc/

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_sqlite',
        'path'     => __DIR__.'/app.db',
    ),
));

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));


/* ------- micro-blog api --------- */

$app->get('/api/posts', function() use($app) {
    $sql = "SELECT rowid, * FROM posts";
    $posts = $app['db']->fetchAll($sql);

    return $app->json($posts, 200);
});

$app->get('/api/posts/user/{user_id}', function($user_id) use($app) {
    $sql = "SELECT rowid, * FROM posts WHERE user_id = ?";
    $posts = $app['db']->fetchAll($sql, array((int) $user_id));

    return $app->json($posts, 200);
});

$app->get('/api/posts/id/{post_id}', function($post_id) use($app) {
  $sql = "SELECT rowid, * FROM posts WHERE rowid = ?";
  $post = $app['db']->fetchAssoc($sql, array((int) $post_id));

  return $app->json($post, 200);
});

$app->post('/api/posts/new', function (Request $request) {
  //TODO
});


/* ------- micro-blog web app --------- */

$app->get('/', function() use($app) {
  return $app['twig']->render('index.twig');
});


$app->run();
