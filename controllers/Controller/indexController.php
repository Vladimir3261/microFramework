<?php
namespace Controller;
use Library\Controller_base;
use Library\ViewBase;

Class indexController Extends Controller_base {
        function indexAction() {
          return new ViewBase();
        }
        function testAction(){
/* This request from C++ program
$iPointOne = 5;
$iPointTwo = 10;
$sResult = exec('/home/vladimir/c++/qwe/Release/qwe '.$iPointOne.' '.$iPointTwo);
var_dump($sResult);
 * 
 */
            
            return new ViewBase(array('testParams'=>$this->params));
        }
}