#!/usr/bin/env bash

/Applications/MAMP/bin/php/php7.3.3/bin/php "`dirname \"$0\"`"/phpstan-config-generator.php
composer dump-autoload
/Applications/MAMP/bin/php/php7.3.3/bin/php ../../../vendor/bin/phpstan analyze --configuration ../../../phpstan.neon --autoload-file=../../../vendor/autoload.php src
