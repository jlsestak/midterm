<?php

//Turn on error reporting -- this is critical!
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');

//Start a session
session_start();
//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

$f3->route('GET /', function() {

    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /survey', function($f3){

    //if it doesnt work with conditional
    $f3->set('midterm', getSurveyQuestions());

    $view = new Template();
    echo $view->render('views/survey.html');
});

$f3->route('POST /summary', function(){
    //add data from form 2 to session array
    if(isset($_POST['name'])){
        $_SESSION['name'] = $_POST['name'];
    }

    if(isset($_POST['midterm'])) {
        $_SESSION['midterm'] = implode(", ", $_POST['midterm']);
    }

    //display a view
    $view = new Template();
    echo $view->render('views/summary.html');
    //var_dump($_POST);
});


//Run fat free
$f3->run();