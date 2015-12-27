<?php

namespace Controller;
use Library\Controller_base;
use Library\ViewBase;

/**
 * @author vladimir
 */
class RegisterController extends Controller_Base {
    function indexAction(){
        //setcookie('language', 'ru');
        return new ViewBase();
    }
}