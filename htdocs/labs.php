<?php

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';

global $instance_id;
$instance_id = labs::getInstanceId(session::getUsername());

session::renderPage();