<?php

namespace App;

class Helper
{



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
