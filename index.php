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
require("model/validation.php");


//Instantiate F3
$f3 = Base::Instance();

//Define a default route
$f3->route("GET /", function (){
    $view = new Template();
    echo $view->render("views/home.html");
});

//Define a personal route
$f3->route("GET /page", function () {
    $view = new Template();
    echo $view->render("views/personal.html");
});

//Define a profile route
$f3->route("POST /page2", function ($f3) {
    //var_dump($_POST);

    $_SESSION = array();
    if(isset($_POST['firstName']) && isset($_POST['lastName'])) {
        $name = $_POST['firstName, lastName'];
        if (validName($name)) {
            $_SESSION['firstName, lastName'] = $name;
            $f3->reroute('/page2');
        } else {
            $f3->set("errors['name']", "Please enter First and Last name");
        }
    }

    $_SESSION['firstName'] = $_POST['firstName'];
    $_SESSION['lastName'] = $_POST['lastName'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['phone'] = $_POST['phone'];

    $view = new Template();
    echo $view->render("views/profile.html");
});

//Define a interests route
$f3->route("POST /page3", function () {
    //var_dump($_POST);
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['seeking'] = $_POST['seeking'];
    $_SESSION['bio'] = $_POST['bio'];

    $view = new Template();
    echo $view->render("views/interests.html");
});

//Define a summary route
$f3->route("POST /results", function () {
    //var_dump($_POST);
    $roles = $_POST['roles'];
    $string = implode(" ",$roles);
    $_SESSION['roles'] = $string;

    $view = new Template();
    echo $view->render("views/summary.html");
});



//Run f3
$f3->run();