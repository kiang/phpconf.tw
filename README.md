##Installation

    mkdir phpconf.tw
    cd phpconf.tw
    git clone git@github.com:gourrymk2/phpconf.tw.git
    php -r "eval(\'?>\'.file_get_contents(\'https://getcomposer.org/installer\'));"
    php composer.phar install

##Generate Static Files

    cd phpconf.tw/web
    php generate.php

##Preview Pages With PHP Built-in Web Server

    cd phpconf.tw/web
    php preview.php

View the web site at <http://127.0.0.1:10000>  
This feature require PHP 5.4+.

##Delopy pages (didn't implement Git operation yet)

    cd phpconf.tw/web
    php deploy.php

After deployment, use git or rsync to upload the static files.
