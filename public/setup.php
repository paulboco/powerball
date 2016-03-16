<!-- link to phpunit code coverage report -->
<a href="http://powerball.app/tests/" target="_blank">Tests</a>
<a href="http://powerball.app/api/" target="_blank">API</a>

<?php

ini_set('xdebug.overload_var_dump', 1);

require './../vendor/autoload.php';

function dd() {
    array_map(function($x) {
        echo '<pre>', var_dump($x), '</pre>';
    },func_get_args());
    die();
}
