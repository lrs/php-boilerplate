<?php

namespace LRS\App\Controllers;

use LRS\App\Core\App;
use LRS\App\Models\Tasks;

class TasksController
{
    public function index()
    {
        $tasks = Tasks::fetchTasks();

        echo view("pages/tasks/tasks", ['tasks' => $tasks]);
    }
}
