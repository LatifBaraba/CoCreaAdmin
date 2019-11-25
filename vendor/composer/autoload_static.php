<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitba4bee8965f2214de4e105933a0da54c
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitba4bee8965f2214de4e105933a0da54c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitba4bee8965f2214de4e105933a0da54c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}