<?php

namespace LRS\App\Models;

use LRS\App\Core\App;

Class Users {
  public static function fetchUsers() {
    $enabled = App::get('database')->select('users', 'enabled=true');
    $mapped = array_map(function($user) { return (array)$user; }, $enabled);

    return array_column($mapped, 'name', 'id');
  }

  public static function fetchUser($id) {
    return App::get('database')->select('users', "id={$id} and enabled=true");
  }

  public static function addUser($params) {
    $params['pwd'] = password_hash($params['pwd'], PASSWORD_DEFAULT, ['cost' => 12]);
    $params['guid'] = guid();

    $result = App::get('database')->insert('users', $params);
    App::get('session')->store('session');

    return $result;
  }

  public static function signIn($usr, $pwd) {
    $pwd = password_hash($pwd, PASSWORD_DEFAULT, ['cost' => 12]);

    $match = App::get('database')->select('users', "name={$id} and pwd={$pwd}");
    // if usr/pwd match in users db
    $date = dateStammp();
    $result = App::get('database')->update('users', "active=1, lastloggedin={$date}", "name={$id}");
    App::get('session')->store($result);
    return $result;
  }

  public static function signOut($id) {
    App::get('database')->update('users', 'active=0', "name={$id}");
    App::get('session')->release('session');
  }
}
