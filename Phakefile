<?php

desc('Build website');
task('build', function($args) {
    $verbose = false;
    if (isset($args['verbose'])) {
        $verbose = true;
    }

    require realpath(__DIR__) . '/vendor/trq/gen/lib/Gen.php';
    $gen = new Gen\Gen($verbose);
    $gen->build('.', './build');
});

task('default', 'build');
