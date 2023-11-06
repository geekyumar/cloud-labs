<pre>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';

$sesstok = $_SESSION['session_token'];

$sess = new usersession($sesstok);

