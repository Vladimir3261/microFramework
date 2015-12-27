<?php
/*
 * Абстрактный класс, который наследуют все контроллеры в системе
 */
namespace Library;

Abstract Class Controller_Base {

        protected $params;

/*
 * Конструктор класса принимает параметры переданные при создании
 * экземпляра класса и возвращает массив параметров для дальнейшей работы с ними 
 * в контроллере
 */
        function __construct($arr) {
            $this->params = $arr;
        }
/*
 * Метод redirect: перенаправление на указанную страницу
 */
        function redirect($url){
            header("Location: $url");
        }
/*
 * метод indexAction должен быть объязательно объявлен
 */
        abstract function indexAction();

}

