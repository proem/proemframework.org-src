<?php

desc('Build website');
task('build', function($args) {
    $verbose = false;
    if (isset($args['verbose'])) {
        $verbose = true;
    }

    $dest = realpath(__DIR__) . '/build';
    if (isset($args['dest'])) {
        $dest = $args['dest'];
    }

    require realpath(__DIR__) . '/vendor/autoload.php';

    $gen = new Gen\Gen($verbose);
    $gen->build(realpath(__DIR__));
});

desc('Serve website locally on 127.0.0.1:<8080>');
task('serve', 'build', function($args) {
    $port = '8080';
    if (isset($args['port'])) {
        $port = $args['port'];
    }

    if (is_dir(realpath(__DIR__) . '/build')) {
        echo "http://127.0.0.1:$port\n";
        chdir(realpath(__DIR__) . '/build');
        system('php -S 127.0.0.1:' . $port);
    }
});

task('default', 'build');
