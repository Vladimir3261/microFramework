<?php
namespace Library;
/*
 * Базоввый Класс Модели приложения, который наследуют другие модели принимает
 * в конструктор объект PDO для подключения к БД
 */
class ModelBase {
    
    protected $Adapter;
    
    function __construct() {
       $this->Adapter = new
               \PDO('mysql:host=' . HOST . ';dbname=' . DBNAME .'', USERNAME, PASSWORD);
       $this->Adapter->exec("set names utf8");
    }
}