<?php

use LRS\App\Core\App;
use LRS\App\Core\Database\Connection;
use LRS\App\Core\Database\QueryBuilder;
use LRS\App\Core\Request;
use LRS\App\Core\Router;
use LRS\App\Core\Session\SessionManager;

App::bind('config', require __DIR__ . '/../app/config.php');

App::bind('database', new QueryBuilder(
  Connection::make(App::get('config')['database'])
));

App::bind('session', new SessionManager('database'));

Router::load(__DIR__ . '/../app/routes.php')->direct(Request::uri(), Request::method());
