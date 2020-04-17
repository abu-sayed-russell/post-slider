<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit920a3360809bee3776051138ac935f6e
{
    public static $files = array (
        'ab20129202d1d8ee230c1b39937847d7' => __DIR__ . '/../..' . '/include/Helpers/MMWPS_Common_Helper.php',
        '0d649a8bec1692cae5ec33f2c5a1a648' => __DIR__ . '/../..' . '/include/Helpers/MMWPSFunctionHelper.php',
    );

    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MMWPS\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MMWPS\\' => 
        array (
            0 => __DIR__ . '/../..' . '/include',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit920a3360809bee3776051138ac935f6e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit920a3360809bee3776051138ac935f6e::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}