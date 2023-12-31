<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite46eca470777a0eee2416d9248e885db
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Bkash\\Dynamiccharging\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Bkash\\Dynamiccharging\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInite46eca470777a0eee2416d9248e885db::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite46eca470777a0eee2416d9248e885db::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite46eca470777a0eee2416d9248e885db::$classMap;

        }, null, ClassLoader::class);
    }
}
