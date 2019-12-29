<?php 
// starting session to be able to send user info between pages.
    session_start();
    session_destroy();
    header("Location: ../index.php");
    
   

?>


