<?php

namespace App;

class Helper
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
        $file = APP_ROOT . '/app/views/' . $view . '.php';

        if (is_readable($file)) require_once $file;
        else die('404 Page not found');
    }

    /**
     * Checks for Cross-site request forgery token
     *
     * @param string $token
     * @return bool
     */
    public static function csrf($token)
    {
        if ($_SESSION['token'] === $token) {
            if (time() <= $_SESSION['token-expire']) {
                return true;
            }
        }
        return false;
    }





    /**
     * Send HTML Email
     *
     * @param string $to
     * @param string $subject
     * @param string $message
     * @return bool
     */
    public static function mailto($to, $subject, $message)
    {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . APP_EMAIL. "\r\n";
        // $headers .= 'Cc: ' . EMAIL_CC . "\r\n";

        return mail($to, $subject, $message, $headers);
    }
}
