<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit33a7810067f8d79a209bbf53db28a401
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Whoops\\' => 7,
        ),
        'R' => 
        array (
            'Root\\' => 5,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'G' => 
        array (
            'GetUKID\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Whoops\\' => 
        array (
            0 => __DIR__ . '/..' . '/filp/whoops/src/Whoops',
        ),
        'Root\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'GetUKID\\' => 
        array (
            0 => __DIR__ . '/../..' . '/uk_id',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit33a7810067f8d79a209bbf53db28a401::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit33a7810067f8d79a209bbf53db28a401::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
