<?php
    require_once __DIR__.'/config.php';
    require_once __DIR__.'/vendor/ff/lib/base.php';
    require_once __DIR__.'/vendor/Twig/Autoloader.php';

    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem(__DIR__.'/templates', array(
        'auto_reload' => true
    ));

    $twig = new Twig_Environment($loader);
    $twig->addFilter('f3', new Twig_Filter_Function('F3::get'));
    $twig->addGlobal('is_ajax', Web::isajax());

    global $twig;

    F3::set('DB', new DB($config['db_dsn'], $config['db_user'], $config['db_pass']));