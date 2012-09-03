<?php

// Use this script to move all static files into .deploy directory

$moveFrom = realpath(__DIR__.'/public');
$moveTo   = __DIR__.'/.deploy';

if (false === realpath($moveTo)) {
    mkdir($moveTo, 0777, true);
}
$moveTo = realpath($moveTo);

// clean .deploy directory first
foreach (getFilesRecursively($moveTo, true) as $file) {
    if (preg_match('/\.git/', $file)) continue;

    echo 'delete "' , $file , '"', PHP_EOL;
    unlink($file);
}

echo sprintf('
move deploy files from: %s
                    to: %s
moving files...

', $moveFrom, $moveTo);

foreach (getFilesRecursively($moveFrom, true) as $file) {
    $toFile = str_replace($moveFrom, $moveTo, $file);

    echo $file, ' => ', $toFile, PHP_EOL;

    $dir = dirname($toFile);
    if (! file_exists($dir)) {
        mkdir($dir, 0777, true);
    }

    file_put_contents($toFile, file_get_contents($file));
}

/**
 * Get all file paths in a root directory
 *
 * @param string    $rootPath   root directory path
 * @param bool      $fullPath   set true to retrieve absolute paths
 * @return array
 */
function getFilesRecursively($rootPath, $fullPath = false) {
    if (! is_dir($rootPath)) {
        return array();
    }

    $dirs = scandir($rootPath);
    if (false === $dirs) {
        return array();
    }

    $return = array();

    $temps = array();
    foreach ($dirs as $dir) {
        if ($dir == '.' || $dir == '..') continue;
        $temps[] = realpath($rootPath .'/'. $dir);
    }
    $dirs = $temps;

    do {
        $new_dirs = array();

        foreach ($dirs as $dir) {
            if (is_dir($dir)) {
                $temps = scandir($dir);

                if (false !== $temps) {
                    foreach ($temps as $temp) {
                        if ('.' == $temp || '..' == $temp) continue;

                        $new_dirs[] = $dir .'/'. $temp;
                    }
                }
            }

            if (is_file($dir)) {
                $return[] = realpath($dir);
            }
        }

        $dirs = $new_dirs;

    } while (count($dirs) > 0);

    if (false === $fullPath) {
        foreach ($return as $index => $path) {
            $return[$index] = basename($path);
        }
    }

    return $return;
}
