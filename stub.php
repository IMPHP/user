<?php

if (!defined('\im\IMPHP_BASE')) {
    echo "Could not find imphp/base"; exit(1);

} else if (!defined('\im\IMPHP_SESSION')) {
    echo "Could not find imphp/session"; exit(1);
}

require "static.php";

$loader = \im\ImClassLoader::load();
$loader->addBasePath(__DIR__);
