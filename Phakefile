<?php

desc('Build the site');
task('build', function($args) {
    system('phr up . htdocs');
    system('rm -fr htdocs/downloads');
    system('cp -r .phrozn/downloads htdocs/');
});

task('default', 'build');
