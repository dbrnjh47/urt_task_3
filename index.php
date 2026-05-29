<?php
// Автозагрузка классов (простая версия)
// PHP-8.3-FCGI

use App\Http\Controllers\DeliveryController;

define('ROOT_PATH', __DIR__);

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = ROOT_PATH . '/app/';
    
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});

// Простая маршрутизация
$controller = new DeliveryController();
$controller->show();