<?php

namespace LRS\App\Controllers;

use LRS\App\Core\App;
use LRS\App\Models\Posts;

class PostsController
{
    public function index()
    {
        $titles = Posts::fetchPosts();

        echo view("pages/posts/posts", ['posts' => $titles]);
    }

    public function post()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if (is_numeric($id)) {
            $post = Posts::fetchPost($id);
        }

        echo view("pages/posts/post", [ 'post' => isset($post[0]) ? $post[0] : null ]);
    }

    public function postsNew()
    {
        echo view("pages/posts/posts-new");
    }

    public function store()
    {
        $params = [
        'author' => $author = isset($_POST['author']) ? $_POST['author'] : null,
        'title' => $title = isset($_POST['title']) ? $_POST['title'] : null,
        'content' => $content = isset($_POST['content']) ? $_POST['content'] : null,
        'published' => 1
        ];

        if (isset($author) && isset($title) && isset($content)) {
            Posts::addPost($params);
        }

        redirect('posts');
    }
}
