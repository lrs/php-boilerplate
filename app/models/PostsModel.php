<?php

namespace LRS\App\Models;

use LRS\App\Core\App;

Class Posts {
  public static function fetchPosts() {
    $published = App::get('database')->select('posts', 'published=true');
    $mapped = array_map(function($post) { return (array)$post; }, $published);

    return array_column($mapped, 'title', 'id');
  }

  public static function fetchPost($id) {
    return App::get('database')->select('posts', "id={$id} and published=true");
  }

  public static function addPost($params) {
    return App::get('database')->insert('posts', $params);
  }
}
