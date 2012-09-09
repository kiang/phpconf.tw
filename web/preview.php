<?php

require __DIR__.'/generate.php';

// use php build-in server at http://127.0.0.1:10000
if (strnatcmp(phpversion(),'5.4') >= 0) {
    echo 'starting a local web server at http://127.0.0.1:10000', PHP_EOL;
    echo `ruby run.rb`;
}
