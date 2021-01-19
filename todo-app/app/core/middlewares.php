<?php

namespace App;

class Middleware
{
    /**
     * Define controller methods' custom middleware for the web routes
     * eg ['AuthController@login' => 'WEBACCESSREQUIRED'],
     * @var array
     */
    private static $web_middlewares = [
      'AuthController@logout' => 'WEBACCESSREQUIRED',
      'TodoController@create' => 'WEBACCESSREQUIRED',
      'TodoController@store' => 'WEBACCESSREQUIRED',
      'TodoController@edit' => 'WEBACCESSREQUIRED',
      'TodoController@update' => 'WEBACCESSREQUIRED',
      'TodoController@delete' => 'WEBACCESSREQUIRED',
    ];

    /**
     *  api routes middle ware access
     *
     * @var array
     */
    private static $api_middlewares = [
      'TodoController@store' => 'APIACCESSREQUIRED',
      'TodoController@update' => 'APIACCESSREQUIRED',
      'TodoController@delete' => 'APIACCESSREQUIRED',
      'AuthController@logout' => 'APIACCESSREQUIRED',
    ];

    /**
     * This is just a replacer function that calls a method from the namedspaced class  in the target controller
     *
     * @param string class method name $classMethod
     * @return void
     */
    public static function init($classMethod)
    {
        $classMethod = str_replace('Controllers\\', '', $classMethod);
        $classMethod = str_replace('::', '@', $classMethod);
        if (strpos($classMethod, 'API\\') !== false) {
            $classMethod = str_replace('API\\', '', $classMethod);
            if (array_key_exists($classMethod, self::$api_middlewares)) return self::{self::$api_middlewares[$classMethod]}();
        } else {
            if (array_key_exists($classMethod, self::$web_middlewares)) return self::{self::$web_middlewares[$classMethod]}();
        }
    }


  }
