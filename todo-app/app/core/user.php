<?php

namespace App;

class User
{
  public $online = false;
  public $userName = null;
  public $role = 'user';
  public function __construct(){


  }
    /**
     * Return current user logged in information
     *
     * @return array
     */
    public static function loggedIn()
    {
        if (isset($_COOKIE['loggedin'])) {
          return  Database::select("SELECT * FROM users WHERE email = ?" ["i",$_COOKIE['loggedin']]);
        }
        return null;
    }

    /**
     * Return selected user information
     *
     * @param $id
     * @return array
     */
    public static function info($id)
    {
        return Database::select("SELECT * FROM users WHERE id = ?" ["id",$id);
    }
}
