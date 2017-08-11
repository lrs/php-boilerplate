<?php

namespace LRS\App\Controllers;

use DateTime;

use LRS\App\Core\App;
use LRS\App\Models\Users;
use LRS\App\Core\Session\SessionManager;

class UsersController
{
    public function index()
    {
        $users = Users::fetchUsers();
        SessionManager::setFlash('hello world');
        echo view("pages/users/users", ['users' => $users, 'flash' => SessionManager::flash()]);
    }

    public function user()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if (is_numeric($id)) {
            $user = Users::fetchUser($id);
        }

        echo view("pages/users/user", [ 'user' => isset($user[0]) ? $user[0] : null ]);
    }

    public function usersNew()
    {
        echo view("pages/users/users-new");
    }

    public function store()
    {
        $d = new DateTime('2001-01-01T00:00:00.000000Z');

        $params = [
        'name' => $name = isset($_POST['name']) ? $_POST['name'] : null,
        'email' => $email = isset($_POST['email']) ? $_POST['email'] : null,
        'pwd' => $password = isset($_POST['password']) ? $_POST['password'] : null,
        'created' => $d->format('Y-m-d\TH:i:s.u')
        ];

        if (isset($name) && isset($email) && isset($password)) {
            Users::addUser($params);
        }

        redirect('users');
    }
}
