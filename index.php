<?php
/**
 * Alex Grigorenko
 * 1/16/20
 * /328/dating/index.php
 */


// Turn on error reporting -- this is critical!
ini_set('display_errors',1);
error_reporting(E_ALL);

//Require autoload file
require("vendor/autoload.php");
require("model/validation.php");

//Start a session
session_start();

//Instantiate F3
$f3 = Base::Instance();

$f3->set('DEBUG', 3);
$controller = new memberController($f3);

//Define arrays
$f3->set('state', array('AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'FL', 'GA', 'HI', 'ID', 'IL', 'IN', 'IA',
    'KS', 'KY', 'LA', 'ME', 'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH',
    'NJ', 'NM', 'NY', 'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN', 'TX',
    'UT', 'VT', 'VA', 'WA', 'WV', 'WI', 'WY'));

$indoor = array('tv', 'movies', 'cooking', 'board games', 'puzzles', 'reading',
    'playing cards', 'video games');

$f3->set('indoor', $indoor);

$outdoor = array('hiking', 'biking', 'swimming', 'collecting', 'walking', 'climbing');

$f3->set('outdoor', $outdoor);


//Define a default route
$f3->route("GET /", function (){
    $GLOBALS['controller']->home();
});

//Define a personal route
$f3->route("GET|POST /page", function ($f3) {

    $GLOBALS['controller']->personal();

//    //If form has been submitted, validate
//    if($_SERVER['REQUEST_METHOD'] == 'POST') {
//
//        //Get data from form
//        $firstName = $_POST['firstName'];
//        $lastName = $_POST['lastName'];
//        $age = $_POST['age'];
//        $phone = $_POST['phone'];
//        $gender = $_POST['gender'];
//
//        //Add data to hive
//        $f3->set('firstName', $firstName);
//        $f3->set('lastName', $lastName);
//        $f3->set('age', $age);
//        $f3->set('phone', $phone);
//        $f3->set('gender', $gender);
//
//
//        //If data is valid
//        if (validPersonal()) {
//
//            //Write data to Session
//            $_SESSION['firstName'] = $firstName;
//            $_SESSION['lastName'] = $lastName;
//            $_SESSION['age'] = $age;
//            $_SESSION['phone'] = $phone;
//            $_SESSION['gender'] = $gender;
//
//            //Redirect to profile page
//            $f3->reroute('/page2');
//        }
//    }
//
//    $view = new Template();
//    echo $view->render("views/personal.html");

});

//Define a profile route
$f3->route("GET|POST /page2", function ($f3) {
    //var_dump($_POST);


    $GLOBALS['controller']->profile();


    //If form has been submitted, validate
//    if($_SERVER['REQUEST_METHOD'] == 'POST') {
//
//        //Get data from form
//        $email = $_POST['email'];
//        $state = $_POST['state'];
//        $seeking = $_POST['seeking'];
//        $bio = $_POST['bio'];
//
//
//        //Add data to hive
//        $f3->set('email', $email);
//        $f3->set('state', $state);
//        $f3->set('seeking', $seeking);
//        $f3->set('bio', $bio);
//
//
//        //If data is valid
//        if (validProfile()) {
//
//            //Write data to Session
//            $_SESSION['email'] = $email;
//            $_SESSION['state'] = $state;
//            $_SESSION['seeking'] = $seeking;
//            $_SESSION['bio'] = $bio;
//
//            //Redirect to profile page
//            $f3->reroute('/page3');
//        }
//    }
//
////    $_SESSION['firstName'] = $_POST['firstName'];
////    $_SESSION['lastName'] = $_POST['lastName'];
////    $_SESSION['age'] = $_POST['age'];
////    $_SESSION['gender'] = $_POST['gender'];
////    $_SESSION['phone'] = $_POST['phone'];
//
//    $view = new Template();
//    echo $view->render("views/profile.html");
});

//Define a interests route
$f3->route("GET|POST /page3", function () {
    //var_dump($_POST);

    $GLOBALS['controller']->interests();

//    $_SESSION['email'] = $_POST['email'];
//   $_SESSION['state'] = $_POST['state'];
//    $_SESSION['seeking'] = $_POST['seeking'];
//    $_SESSION['bio'] = $_POST['bio'];

//    $view = new Template();
//    echo $view->render("views/interests.html");
});

//Define a summary route
$f3->route("GET|POST /results", function () {

    $GLOBALS['controller']->summary();
//
//    $_SESSION['roles'] = $_POST['roles'];
//
//    $view = new Template();
//    echo $view->render("views/summary.html");

//    session_destroy();
//    $_SESSION = array();

});



//Run f3
$f3->run();