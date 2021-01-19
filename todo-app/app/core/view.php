<?php

namespace App;

class View
{

    /**
     * Load a view file like Home/home and assign data to it
     *
     * @param string $view
     * @param array $data
     * @return void
     */
    public static function render(string $view, array $data = [])
    {
        $file = APP_ROOT . '/app/views/' . $view . '.view.php';
        if (is_readable($file) && file_exists($file) && is_file($file)) require_once $file;
        else die('404 Page not found');
    }


}
