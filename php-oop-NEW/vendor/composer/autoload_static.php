<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7b0de0a7a597f36f1bbef95354ab831d
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'Game\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Game\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7b0de0a7a597f36f1bbef95354ab831d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7b0de0a7a597f36f1bbef95354ab831d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7b0de0a7a597f36f1bbef95354ab831d::$classMap;

        }, null, ClassLoader::class);
    }
}
