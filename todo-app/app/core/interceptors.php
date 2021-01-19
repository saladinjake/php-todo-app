<?php

namespace App;



class Interceptors{

  /**
     * Check loggedin user
     *
     * @return bool
     */
    private static function webAuth()
    {
        if (isset($_COOKIE['loggedin'])) {
            $email = base64_decode($_COOKIE['loggedin']);
            $user = Database::select("SELECT * FROM users WHERE email = ?",[$email]);
            if (!is_null($user['id'])) return $user;
        }
        return null;
    }

    /**
     * Check access token from header
     * Client should use this `Bearer qwaeszrdxtfcygvuhbijnokmpl0987654321` for Authorization in header
     * That APP_SECRET can be set in ENV or generate after a login or ...
     *
     * @return void
     */
    private static function apiAuth()
    {
        $header = self::getAuthHeader();
        if (!empty($header)) {
            if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
                $user = Database::select("SELECT * FROM users WHERE secret = ?", $matches[1]);


                if (!is_null($user['id'])) {
                    setcookie('loggedin', base64_encode(Database::fetch()['email']), time() + (86400 * COOKIE_DAYS));
                    return $user['id'];
                }
            }
        }
        return null;
    }

    /**
     * Get access token from header
     *
     * @return string
     */
    private static function getAuthHeader()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
}
 ?>
