<?php

namespace LRS\App\Models;

use LRS\App\Core\App;

class Tasks
{
    public static function fetchTasks()
    {
            return App::get('database')->selectAll('todos');
    }
}
