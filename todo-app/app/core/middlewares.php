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

    ];

    /**
     *  api routes middle ware access
     *
     * @var array
     */
    private static $api_middlewares = [

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
            if (array_key_exists($classMethod, self::$api_middlewares)) return self::{self::$APImiddlewares[$classMethod]}();
        } else {
            if (array_key_exists($classMethod, self::$web_middlewares)) return self::{self::$WEBmiddlewares[$classMethod]}();
        }
    }


  }
