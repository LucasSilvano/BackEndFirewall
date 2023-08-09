<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3bcc04644006bce6321c9e6bd7ab7e60
{
    public static $files = array (
        'b6acbc2c66101dac6f1dafae7ff2fb36' => __DIR__ . '/../..' . '/App/Utils/Config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3bcc04644006bce6321c9e6bd7ab7e60::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3bcc04644006bce6321c9e6bd7ab7e60::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3bcc04644006bce6321c9e6bd7ab7e60::$classMap;

        }, null, ClassLoader::class);
    }
}
