##Installation

    mkdir phpconf.tw
    cd phpconf.tw
    git clone git@github.com:gourrymk2/phpconf.tw.git
    php -r "eval(\'?>\'.file_get_contents(\'https://getcomposer.org/installer\'));"
    php composer.phar install

##Generate Static Files

    php web/generate.php

##Preview Pages With PHP Built-in Web Server

    php web/preview.php

View the web site at <http://127.0.0.1:10000>  
This feature require PHP 5.4+.

##Delopy pages (didn't implement Git operation yet)

    php web/deploy.php

After deployment, use git or rsync to upload the static files.
