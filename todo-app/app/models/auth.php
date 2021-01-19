<?php

namespace Models;

use App\Database;

class Auth
{

      /**
       * Logout
       *
       * @return bool
       */
      public static function logout()
      {
          if (setcookie('loggedin', '', time() - (86400 * COOKIE_DAYS))) {
              unset($_COOKIE['loggedin']);
              return true;
          }
          return false;
      }

    /**
     * Register
     *
     * @param object $request
     * @return bool
     */
    public static function register($request)
    {
        Database::query("INSERT INTO users (
            `email`,
            `password`,
            `secret`,
            `username`
        ) VALUES (?, ?, ?, ?)", [$request->email,password_hash($request->password1, PASSWORD_DEFAULT), $request->secret, $request->username]);

        if (setcookie('loggedin', base64_encode($request->email), time() + (86400 * COOKIE_DAYS))) {
          return true;
        }
        return false;
    }

    /**
     * Check for existed Email
     *
     * @param string $email
     * @return bool
     */
    public static function existed($email)
    {
        Database::query("SELECT * FROM users WHERE email = :email");
        if (!is_null(Database::fetch()['id'])) return true;
        return false;
    }

    /**
     * Login
     *
     * @param object $request
     * @return bool
     */
    public static function login($request)
    {
        Database::query("SELECT * FROM users WHERE email = :email");
        Database::bind(':email', $request->email);

        if (password_verify($request->password, Database::fetch()['password']) && setcookie('loggedin', base64_encode($request->email), time() + (86400 * COOKIE_DAYS))) return true;
        return false;
    }

}
