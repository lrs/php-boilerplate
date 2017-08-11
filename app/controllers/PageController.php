<?php

namespace LRS\App\Controllers;

class PageController
{
    public function index()
    {
        echo view("pages/index");
    }

    public function contact()
    {
        echo view("pages/contact");
    }

    public function about()
    {
        echo view("pages/about");
    }

    public function aboutCulture()
    {
        echo view("pages/about-culture");
    }

    public function notFound()
    {
        echo view("pages/404");
    }
}
