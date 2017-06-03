<?php
// Pages
$router->get(''             , 'PageController@index');
$router->get('about'        , 'PageController@about');
$router->get('about/culture', 'PageController@aboutCulture');
$router->get('contact'      , 'PageController@contact');

// Tasks
$router->get('tasks'        , 'TasksController@index');

// Posts
$router->get('posts'        , 'PostsController@index');
$router->get('post'         , 'PostsController@post');
$router->get('posts/new'    , 'PostsController@postsNew');

$router->post('posts'       , 'PostsController@store');

// Users
$router->get('users'        , 'UsersController@index');
$router->get('user'        , 'UsersController@user');
$router->get('users/new'    , 'UsersController@usersNew');

$router->post('users'       , 'UsersController@store');
