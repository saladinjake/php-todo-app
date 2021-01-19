<?php

namespace Controllers;

use App\Database;
use App\View;
use App\Middleware;

use Models\Todo;

class TodoController
{
    /**
     * READ all
     *
     * @return void
     */
    public function index()
    {
        View::render(
            'todo/index',
            [
                'page_title' => 'Todo',
                'page_subtitle' => 'Basic PHP MVC | Todo',

                'posts' => Todo::index()
            ]
        );
    }

    /**
     * READ one
     *
     * @param string $slug
     * @return void
     */
    public function show($slug)
    {
        $post = Todo::show($slug);
        View::render(
            'todo/show',
            [
                'page_title' => $post['title'],
                'page_subtitle' => $post['subtitle'],

                'post' => $post
            ]
        );
    }

    /**
     * CREATE
     *
     * @return void
     */
    public function create()
    {
        if (is_null(Middleware::init(__METHOD__))) {
            header('location: ' . URL_ROOT . '/login', true, 303);
            exit();
        }
        View::render(
            'todo/create',
            [
                'page_title' => 'Create Post',
                'page_subtitle' => 'Create new post in Blog'
            ]
        );
    }

    /**
     * STORE
     *
     * @return void
     */
    public function store()
    {

    }

    /**
     * EDIT
     *
     * @param string $slug
     * @return void
     */
    public function edit($slug)
    {
        if (is_null(Middleware::init(__METHOD__))) {
            header('location: ' . URL_ROOT . '/login', true, 303);
            exit();
        }
        $post = Todo::show($slug);
        View::render(
            'todo/edit',
            [
                'page_title' => 'Edit ' . $post['title'],
                'page_subtitle' => $post['subtitle'],
                'post' => $post
            ]
        );
    }

    /**
     * UPDATE
     *
     * @return void
     */
    public function update()
    {


    }

    /**
     * DELETE
     *
     * @param string $slug
     * @return void
     */
    public function delete($slug)
    {
        if (is_null(Middleware::init(__METHOD__))) {
            header('location: ' . URL_ROOT . '/login', true, 303);
            exit();
        }
        $output = [];
        if (Todo::delete($slug)) {
            $output['status'] = 'OK';
            $output['message'] = 'Process complete successfully!';
        } else {
            $output['status'] = 'ERROR';
            $output['message'] = 'There is an error! Please try again.';
        }
        echo json_encode($output);
    }
}
