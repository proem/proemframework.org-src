<?php

desc('Build the site');
task('build', function($args) {
    system('phr up . ../stage');
    system('rm -fr ../stage/downloads');
    system('cp -r .phrozn/downloads ../stage/');
});

task('default', 'build');
