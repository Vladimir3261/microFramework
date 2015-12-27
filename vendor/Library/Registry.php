<?php
/**
 * Класс Registry содержит в себе глобальные переменные и реализует паттерн Singleton
 */
namespace Library;

class Registry {
    public static $var;
    public static $template;
 // Статичесикй метод  добавляет в массив var новые элементы ключ-значение  
    static function setvar($key, $var) {

        if (isset(self::$var[$key]) == true) {

                throw new Exception('Unable to set var `' . $key . '`. Already set.');

        }


        self::$var[$key] = $var;

        return true;

}
// Статический метод getvar() возвращает значения из массива var по ключу key
static function getvar($key) {

        if (isset(self::$var[$key]) == false) {
                return null;
        }
        return self::$var[$key];
}
// Метод setTemplate принимает и сохраняет путь к скриптам вида
static function setTemplate($template) {

self::$template = $template;

        return self::$template;

}
//Метод getTemplate возвращает путь к скриптам вида
static function getTemplate() {

        return self::$template;

}
    /**
     * Статическая переменная, в которой мы
     * будем хранить экземпляр класса
     *
     * @var SingletonTest
     */
    protected static $_instance;
 
    /**
     * Закрываем доступ к функции вне класса.
     * Паттерн Singleton не допускает вызов
     * этой функции вне класса
     *
     */
    private function __construct(){
        /**
         * При этом в функцию можно вписать
         * свой код инициализации. Также можно
         * использовать деструктор класса.
         * Эти функции работают по прежднему,
         * только не доступны вне класса
         */
    }
 
    /**
     * Закрываем доступ к функции вне класса.
     * Паттерн Singleton не допускает вызов
     * этой функции вне класса
     *
     */
    private function __clone(){
    }
    /**
     * Статическая функция, которая возвращает
     * экземпляр класса или создает новый при
     * необходимости
     *
     * @return SingletonTest
     */
    public static function getInstance() {
        // проверяем актуальность экземпляра
        if (null === self::$_instance) {
            // создаем новый экземпляр
            self::$_instance = new self();
        }
        // возвращаем созданный или существующий экземпляр
        return self::$_instance;
    }
}