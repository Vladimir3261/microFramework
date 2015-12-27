<?php
/*
 * Конфигурационный файл приложения определяет константы для всего приложения
 */
error_reporting (E_ALL);

if (version_compare(phpversion(), '5.4.0', '<') == true) { die ('PHP5.4 Only'); }


// Константы:
// Cлеш windows/linux
define ('DIRSEP', DIRECTORY_SEPARATOR);

// Узнаём путь до файлов сайта

$site_path = realpath(dirname(__FILE__) . DIRSEP . '' . DIRSEP) . DIRSEP;

define ('site_path', $site_path);
/*
 * Подключение к БД
 */
define ('HOST', 'localhost');
define ('DBNAME', 'test');
define ('USERNAME', 'username');
define ('PASSWORD', 'password');
