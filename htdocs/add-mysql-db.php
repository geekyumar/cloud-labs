<?php

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';

if(session::isAuthenticated()){
    session::renderPage();
}
else{
    session::destroy();
    header('Location: /users/login.php');
}