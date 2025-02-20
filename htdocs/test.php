<pre>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';
// echo session_status();

print_r(session::$usersession);

?>

----------------------------------------------------------------

<?php

print_r(session::$user);