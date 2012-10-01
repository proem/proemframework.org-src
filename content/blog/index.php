<?php

$out = ['blogs' => []];

$base = realpath(__DIR__);

$dirContents = scandir($base);

foreach ($dirContents as $dir) {
    if (is_dir($base . '/' . $dir) && $dir != '.' && $dir != '..') {
        foreach (scandir($base . '/' . $dir) as $blog) {
            if (is_file($base . '/' . $dir . '/' . $blog)) {
                $out['blogs'][] = [
                    'url'   => str_replace('.twig', '.html', "/blog/$dir/$blog"),
                    'id'    => str_replace('.twig', '', "/blog/$dir/$blog"),
                    'title' => ucwords(str_replace(['-', '.twig'], [' ', ''], $blog)),
                    'date'  => date('D jS M Y', strtotime($dir))
                ];
            }
        }
    }
}

return $out;
