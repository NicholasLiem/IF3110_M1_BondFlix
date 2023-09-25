<?php

define("BASE_PATH", __DIR__);

require_once BASE_PATH . '/Bootstrap/Autoloader.php';
require_once BASE_PATH . '/services.php';
require_once BASE_PATH . '/routes.php';

function redirect($path) {
    require_once BASE_PATH . '/public/view/' . $path . '.php';
}