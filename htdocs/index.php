<?php

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';

if(session::isAuthenticated()){
    session::renderPage();
}
else{
    sssion::destroy();
    header('Location: /users/signup.php');
}