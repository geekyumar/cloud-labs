<?php

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';

if(isset($_GET['signout'])) {
    session::destroy();
    header('Location: /users/login');
 }

if(session::isAuthenticated()){
    session::renderPage();
}
else{
    session::loadTemplate('home');
}