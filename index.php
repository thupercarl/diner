<?php

//this is my controller for the diner project
ini_set('display_errors',1);
error_reporting(E_ALL);

//require autoload file
require_once('vendor/autoload.php');

//instantiate fat-free
$f3 = Base::instance();

//define default route
$f3->route('GET /', function(){
    //display the home page
    $view = new Template();
    echo $view->render('views/home.html');
});
/*
$f3->route('GET /breakfast', function(){
    echo "<h2>What's for breakfast?</h2>";
});
*/

//run fat-free
$f3->run();