<?php

if (file_exists(__DIR__ . '/config.php')) {
    $conf = (array) include __DIR__ . '/config.php';
}

desc('Build website');
task('build', function($args) use ($conf) {
    $dest = __DIR__ . '/build';
    if (isset($conf['dest'])) {
        $dest = $conf['dest'];
    }
    if (isset($args['dest'])) {
        $dest = $args['dest'];
    }

    require realpath(__DIR__) . '/vendor/autoload.php';

    $gen = new Gen\Builder(new Gen\Config, new Gen\Util(isset($args['verbose'])));
    $gen->build(realpath(__DIR__), $dest);
});

desc('Serve website locally on 127.0.0.1:<8080>');
task('serve', 'build', 'api', function($args) use ($conf) {
    $port = '8080';
    if (isset($conf['server']['port'])) {
        $port = $conf['server']['port'];
    }
    if (isset($args['port'])) {
        $port = $args['port'];
    }

    $host = '127.0.0.1';
    if (isset($conf['server']['host'])) {
        $host = $conf['server']['host'];
    }
    if (isset($args['host'])) {
        $host = $args['host'];
    }

    $dest = __DIR__ . '/build';
    if (isset($conf['dest'])) {
        $dest = $conf['dest'];
    }
    if (isset($args['dest'])) {
        $dest = $args['dest'];
    }

    if (is_dir($dest)) {
        echo "\nhttp://{$host}:{$port}\n";
        chdir($dest);
        system('php -S ' . $host . ':' . $port);
    }
});

desc('Build api docs');
task('api', 'build', function($args) use ($conf) {
    $dest = __DIR__ . '/build';
    if (isset($conf['dest'])) {
        $dest = $conf['dest'];
    }
    if (isset($args['dest'])) {
        $dest = $args['dest'];
    }

    $src = '~/src/proem';
    if (isset($conf['src'])) {
        $src = $conf['src'];
    }
    if (isset($args['src'])) {
        $src = $args['src'];
    }

    $phpdoc = '/usr/local/bin/phpdoc';
    if (isset($conf['phpdoc'])) {
        $phpdoc = $conf['phpdoc'];
    }
    if (isset($args['phpdoc'])) {
        $phpdoc = $args['phpdoc'];
    }

    system('mkdir -p ' . $dest . '/api/{current,dev}');
    system('cd ' . $src . ' && git checkout master');
    system($phpdoc . ' run --template=proem -d ' . $src . '/lib -t ' . $dest . '/api/current');
    system('cd ' . $src . ' && git checkout develop');
    system($phpdoc . ' run --template=proem -d ' . $src . '/lib -t ' . $dest . '/api/dev');
});

task('default', 'build');
