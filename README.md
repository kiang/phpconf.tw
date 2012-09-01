##Installation

    mkdir phpconf.tw
    cd phpconf.tw
    git clone git@github.com:gourrymk2/phpconf.tw.git
    php -r "eval(\'?>\'.file_get_contents(\'https://getcomposer.org/installer\'));"
    php composer.phar install

##Generate Static Files

    cd phpconf.tw
    php web/generate.php

##Preview Pages With PHP Built-in Web Server (Require PHP 5.4+)

    cd phpconf.tw
    php web/preview.php

