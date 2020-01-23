<?php
/**
 * Alex Grigorenko
 * 1/16/20
 * /328/dating/index.php
 */

//Start a session
session_start();

// Turn on error reporting -- this is critical!
ini_set('display_errors',1);
error_reporting(E_ALL);

//Require autoload file
require("vendor/autoload.php");

//Instantiate F3
$f3 = Base::Instance();

//Define a default route
$f3->route("GET /", function (){
    $view = new Template();
    echo $view->render("views/home.html");
});

//Define a default route
$f3->route("GET /page", function () {
    $view = new Template();
    echo $view->render("views/personal.html");
});

//Define a default route
$f3->route("POST /page2", function () {
    //var_dump($_POST);
    //$_SESSION['food'] = $_POST['food'];

    $view = new Template();
    echo $view->render("views/profile.html");
});

//Define a default route
$f3->route("POST /page3", function () {
    //var_dump($_POST);
    //$_SESSION['meal'] = $_POST['meal'];

    $view = new Template();
    echo $view->render("views/interests.html");
});

//Define a default route
$f3->route("POST /results", function () {
    //var_dump($_POST);
    //$_SESSION['drink'] = $_POST['drink'];
    //$_SESSION['size'] = $_POST['size'];

    $view = new Template();
    echo $view->render("views/summary.html");
});



//Run f3
$f3->run();