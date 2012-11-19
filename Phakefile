<?php

desc('Build website');
task('build', function($args) {
    $dest = realpath(__DIR__) . '/build';
    if (isset($args['dest'])) {
        $dest = $args['dest'];
    }

    require realpath(__DIR__) . '/vendor/autoload.php';

    $gen = new Gen\Builder(new Gen\Config, new Gen\Util(isset($args['verbose'])));
    $gen->build(realpath(__DIR__), $dest);
});

desc('Serve website locally on 127.0.0.1:<8080>');
task('serve', 'build', 'api', function($args) {
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

desc('Build api docs');
task('api', 'build', function() {
    system('mkdir -p build/api/{current,dev}');
    system('cd ~/src/proem && git checkout master');
    system('phpdoc run --template=proem -d ~/src/proem/lib -t build/api/current');
    system('cd ~/src/proem && git checkout develop');
    system('phpdoc run --template=proem -d ~/src/proem/lib -t build/api/dev');
});

task('default', 'build');
