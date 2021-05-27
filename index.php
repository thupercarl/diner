<?php

//This is my controller for the diner project

//Turn on error-reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require necessary files
require_once ('vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../config.php');//ALLOW CONNECTION TO DATABASE (NAVIGATES TO USER-SPECIFIC SERVER)

//Start a session AFTER the autoload so necessary interpreting files are included (internal server error /0)
session_start();

//Connect to the database
try {
    //Instantiate a PDO database object
    $dbh = new PDO(DB_DSN,
        DB_USERNAME, DB_PASSWORD);
    //echo "Connected to database!";
}
catch(PDOException $e) {
    echo $e->getMessage();//for debugging only
    die("We are running into problems right now. Please call to place an order");
}

//Instantiate classes
$f3 = Base::instance();

//instantiate controller class
$con = new Controller($f3);
$dataLayer = new DataLayer($dbh);

//test my saveOrder method
//$dataLayer->saveOrder(new Order("BLT", "lunch", "mayo"));

//Define default route
$f3->route('GET /', function(){

    $GLOBALS['con']->home();
});

$f3->route('GET /breakfast', function(){

    //Display the breakfast page
    $view = new Template();
    echo $view->render('views/breakfast.html');
});

$f3->route('GET /breakfast/brunch/mothers-day', function(){

    //Display the breakfast page
    $view = new Template();
    echo $view->render('views/mothers-day-brunch.html');
});

$f3->route('GET|POST /order1', function($f3){

    $GLOBALS['con']->order1();
});

$f3->route('GET|POST /order2', function($f3){

    $GLOBALS['con']->order2();
});

$f3->route('GET /summary', function(){

    $GLOBALS['con']->summary();
});

//Run Fat-Free
$f3->run();