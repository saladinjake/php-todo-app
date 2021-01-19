<?php

namespace Controllers;

use App\View;
use Models\Todo;

class HomeController
{
    /**
     * Home page rendering to show recent posts
     *
     * @return void
     */
    public function index()
    {
      View::render('home/home',[
          'title' => 'Todo Home',
          'homepage_subtitle' => 'Learn to code daily todo',
          'todos' => Todo::index(15)
        ]
      );
    }
}
