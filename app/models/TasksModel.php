<?php

namespace LRS\App\Models;

use LRS\App\Core\App;

Class Tasks {
  public static function fetchTasks() {
    return App::get('database')->selectAll('todos');
  }
}
