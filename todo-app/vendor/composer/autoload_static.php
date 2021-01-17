<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit093cd57df85e2afeda318bc287d2156c
{
    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'todotask\\bingoproject\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'todotask\\bingoproject\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit093cd57df85e2afeda318bc287d2156c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit093cd57df85e2afeda318bc287d2156c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
