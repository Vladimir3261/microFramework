<?php
/*
 * Автозагрузка классов, при вызове несуществующего класса функция __autoload 
 * ищет в директории vendor имя файла (название файла должно совпвдвть с названием класса)
 * и если находит, подключает файл, тем самым объявив несуществующий класс
 * 
 */
    /*
     * Автозагрузка классов из директории vendor
     */ 
function autoloadVendor($class) {
        $file = '../vendor/' . str_replace('\\', '/', $class) . '.php';

        if (file_exists($file) == false) {
                return false;
        }
        
        include ($file);
}

    /*
     * Автозагрузка контроллеров
     */
function autoloadController($class) {
        $file = '../controllers/' . str_replace('\\', '/', $class) . '.php';

        if (file_exists($file) == false) {
            return false;
        }


        include ($file);
}
/*
 * Автозагрузка моделей
 */
function autoloadModel($class) {
        $file = '../models/' . str_replace('\\', '/', $class) . '.php';

        if (file_exists($file) == false) {
            return false;
        }
        include ($file);
}
function autoloadZend($class){
    if(preg_match("/Zend/", $class)){
        include ('../vendor/Zend/InputFilter/vendor/autoload.php');
    }
}
    /*
     * Запускаем автозагрузчики с использование стандартной библиотеки SPL
     */
spl_autoload_register('autoloadZend');
spl_autoload_register('autoloadVendor');
spl_autoload_register('autoloadController');
spl_autoload_register('autoloadModel');