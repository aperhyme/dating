<?php
//<!--/**-->
//<!--* Alex Grigorenko-->
//<!--* 1/26/20-->
//<!--* /328/dating/views/validation.php-->
//<!--* php validation-->
//<!--*/-->

function validPersonal()
{
    global $f3;
    $isValid = true;

    if (!validFirst($f3->get('firstName'))) {

        $isValid = false;
        $f3->set("errors['firstName']", "Please enter first name");
    }

    if (!validLast($f3->get('lastName'))) {

        $isValid = false;
        $f3->set("errors['lastName']", "Please enter last name");
    }

    if (!validAge($f3->get('age'))) {

        $isValid = false;
        $f3->set("errors['age']", "Please enter a valid age");
    }

    if (!validPhone($f3->get('phone'))) {

        $isValid = false;
        $f3->set("errors['phone']", "Please enter a valid phone number");
    }

    return $isValid;

}


//validate name
function validFirst($firstName)
{

    return !empty($firstName) && ctype_alpha($firstName);
}

function validLast($lastName)
{

    return !empty($lastName) && ctype_alpha($lastName);
}

// validate age
function validAge($age)
{

    return !empty($age) && ctype_digit($age) && $age >= 18
        && $age <= 118;
}

// validate phone number
function validPhone($phone)
{

    return !empty($phone) && ctype_digit($phone);
}


// page 2 validation
function validProfile()
{
    global $f3;
    $isValid = true;

    if(!validEmail($f3->get('email'))){
        $isValid = false;
        $f3->set("errors['email']", "Please enter a valid email");
    }

    return $isValid;
}


// validate email
function validEmail($email)
{

    return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
}


// validate indoor
function  indoorInterests($selectedIndoor){
    $indoor = array('tv', 'puzzles', 'movies', 'video games', 'board games', 'playing cards', 'cooking', 'reading');
    global $f3;
    $isValid = true;
    return $isValid;
}

// validate outdoor
function outdoorInterests( $selectedOutdoor){
    $outdoor = array ('collecting', 'climbing', 'swimming', 'biking', 'walking', 'hiking');
    global $f3;
    $isValid = true;

    return $isValid;

    // checks if interests are valid
    function validInterest($selectedIndoor, $selectedOutdoor) {
        global $f3;
        $isValid = true;
        if(!indoorInterests($selectedIndoor)){
            $isValid = false;
        }
        if(!outdoorInterests($selectedOutdoor)){
            $isValid = false;
        }
        return $isValid;
    }
}
