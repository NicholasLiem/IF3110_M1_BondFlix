<?php

define("BASE_PATH", __DIR__);

require_once BASE_PATH . '/Bootstrap/Autoloader.php';
require_once BASE_PATH . '/services.php';
require_once BASE_PATH . '/routes.php';

function redirect($path, $data = []) {
    extract($data);

    ob_start();
    include BASE_PATH . '/public/view/' . $path . '.php';
    $content = ob_get_clean();

    echo $content;
}