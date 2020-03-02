<?php

/**
 * Alex Grigorenko
 * 2/22/20
 * /328/dating/controller/controller.php
 * php controller
 */


/**
 * Class MemberController routes to all the pages
 * @attribute $_f3 object
 *
 */
class memberController
{
    private $_f3;


    /**
     * MemberController constructor.
     * @param a fat-free object $f3
     */
    public function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    //Define a default route
    public function home()
    {
        $view = new Template();
        echo $view->render("views/home.html");
    }


    /**
     * function for personal info page
     */
    public function personal()
    {

        //If form has been submitted, validate
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Get data from form
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $age = $_POST['age'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];

            //Add data to hive
            $this->_f3->set('firstName', $firstName);
            $this->_f3->set('lastName', $lastName);
            $this->_f3->set('age', $age);
            $this->_f3->set('phone', $phone);
            $this->_f3->set('gender', $gender);


            //If data is valid
            if (validPersonal()) {

                if(isset($_POST['prem'])){
                    $member = new PremiumMember($firstName, $lastName, $age, $gender, $phone);
                }
                else{
                    $member = new Member($firstName, $lastName, $age, $gender, $phone);
                }

                $_SESSION['member'] = $member;
                //Redirect to profile page
                $this->_f3->reroute('/page2');
            }
        }

        $view = new Template();
        echo $view->render("views/personal.html");

    }

    /**
     * function for profile page
     */
    public function profile()
    {
        //If form has been submitted, validate
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Get data from form
            $email = $_POST['email'];
            $state = $_POST['state'];
            $seeking = $_POST['seeking'];
            $bio = $_POST['bio'];


            //Add data to hive
            $this->_f3->set('email', $email);
            $this->_f3->set('state', $state);
            $this->_f3->set('seeking', $seeking);
            $this->_f3->set('bio', $bio);
            $member = $_SESSION['member'];


            //If data is valid
            if (validProfile($email)) {

                //Write data to Session
                $member->setEmail($_POST['email']);
                $member->setSeeking($_POST['seeking']);
                $member->setBio($_POST['bio']);
                $member->setState($_POST['state']);
                $_SESSION['member'] = $member;

                if($member->memberType() == "member") {
                    $this->_f3->reroute('/results');
                } else {
                    $this->_f3->reroute('/page3');
                }
            }
        }
        $view = new Template();
        echo $view->render("views/profile.html");

    }

    /**
     * function for interests info page
     */
    public function interests()
    {

        $selectedIndoor = array();
        $selectedOutdoor = array();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get data from form

            if(!empty($_POST['indoorInterests'])){
                $selectedIndoor = $_POST['indoorInterests'];
                //Add data to hive
                $this->_f3->set('selectedIndoor', $selectedIndoor);
            };
            if(!empty($_POST['outdoorInterests'])){
                $selectedOutdoor = $_POST['outdoorInterests'];
                $this->_f3->set('selectedOutdoor', $selectedOutdoor);
            };
            $member = $_SESSION['member'];
            //If data is valid
            if (validInterest($selectedIndoor, $selectedOutdoor )) {
                //Write data to Session
                $member->setInDoorInterests($selectedIndoor);
                $member->setOutDoorInterests($selectedOutdoor);

                $this->_f3->reroute('/results');
            }
        }
        $view = new Template();
        echo $view->render('views/interests.html');

    }

    /**
     * function for summary page with all the info page
     */
    public function summary()
    {
        $view = new Template();
        echo $view->render('views/summary.html');

    }

    /**
     * function for admin page with all the members
     */
    public function admin()
    {
        $view = new Template();
        echo $view->render('views/admin.html');
    }



}
