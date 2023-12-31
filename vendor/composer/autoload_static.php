<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8f408d3aaf8774b2a5e9fdd168eb0b4f
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sergeybruhin\\LaravelService\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sergeybruhin\\LaravelService\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit8f408d3aaf8774b2a5e9fdd168eb0b4f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8f408d3aaf8774b2a5e9fdd168eb0b4f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8f408d3aaf8774b2a5e9fdd168eb0b4f::$classMap;

        }, null, ClassLoader::class);
    }
}
