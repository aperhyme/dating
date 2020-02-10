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

//Define arrays
$f3->set('state', array('AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'FL', 'GA', 'HI', 'ID', 'IL', 'IN', 'IA',
    'KS', 'KY', 'LA', 'ME', 'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH',
    'NJ', 'NM', 'NY', 'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN', 'TX',
    'UT', 'VT', 'VA', 'WA', 'WV', 'WI', 'WY'));


//Define a default route
$f3->route("GET /", function (){
    $view = new Template();
    echo $view->render("views/home.html");
});

//Define a personal route
$f3->route("GET|POST /page", function ($f3) {

    //If form has been submitted, validate
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        //Get data from form
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];

        //Add data to hive
        $f3->set('firstName', $firstName);
        $f3->set('lastName', $lastName);
        $f3->set('age', $age);
        $f3->set('phone', $phone);

        //If data is valid
        if (validPersonal()) {

            //Write data to Session
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['age'] = $age;
            $_SESSION['phone'] = $phone;

            //Redirect to profile page
            $f3->reroute('/profile');
        }
    }

    $view = new Template();
    echo $view->render("views/personal.html");
});

//Define a profile route
$f3->route("GET|POST /page2", function ($f3) {
    //var_dump($_POST);

    //If form has been submitted, validate
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        //Get data from form
        $email = $_POST['email'];
        $state = $_POST['state'];

        //Add data to hive
        $f3->set('email', $email);
        $f3->set('state', $state);

        //If data is valid
        if (validProfile()) {

            //Write data to Session
            $_SESSION['email'] = $email;
            $_SESSION['state'] = $state;

            //Redirect to profile page
            $f3->reroute('/interests');
        }
    }

//    $_SESSION['firstName'] = $_POST['firstName'];
//    $_SESSION['lastName'] = $_POST['lastName'];
//    $_SESSION['age'] = $_POST['age'];
//    $_SESSION['gender'] = $_POST['gender'];
//    $_SESSION['phone'] = $_POST['phone'];

    $view = new Template();
    echo $view->render("views/profile.html");
});

//Define a interests route
$f3->route("GET|POST /page3", function () {
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
    $roles = $_POST['roles'];
    $string = implode(" ",$roles);
    $_SESSION['roles'] = $string;

    $view = new Template();
    echo $view->render("views/summary.html");
});



//Run f3
$f3->run();