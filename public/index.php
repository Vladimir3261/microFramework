<?php
/*
 * Индексный файл точка входа в приложение  все запросы .htaccess
 * направляет в этот файл
 */
include ('../config/config.php');

// Подключаем автозагрузчик

include(site_path.'../includes/startup.php');

// Инициализация роутера

$router = new Library\Router();

$router->run();







