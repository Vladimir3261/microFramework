<?php
namespace Controller;
use Library\Controller_base;
use Library\ViewBase;

/**
 * @author vladimir
 */

class AuthController extends Controller_Base {
    function indexAction(){
        $email = $_POST['email'];
        $password = $_POST['password'];
        return new ViewBase();
    }
}
