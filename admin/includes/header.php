<?php 
// handling buffering the request in the headers of the scripts, when a script is done it will send everything at the same time. instead of the normal 1 by 1
ob_start();
session_start();
include "../includes/db.php"; 
include "./functions/functions.php";

// check is the userrole from the session is admin if it is it goes to admin.php else it will not be able to login as it is
 if(isset($_SESSION['userrole'])) {

     if($_SESSION['userrole'] !== 'admin'){
        header("Location: ../index.php");
   }

 } 





?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MEMELORD - best of laughs</title>

     <!-------------------------- Bootstrap Core CSS ----------------------->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!--------------------------- Custom CSS ------------------------------->
    <link type="text/css" rel="stylesheet" href="css/admin.css" >

    <!-------------------------- Tittillium google font ----------------------->

    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,600,700&display=swap" rel="stylesheet">

    <!--------------------------- Custom Font font-awesome ------------------------------>
    <script src="https://kit.fontawesome.com/45088db5a6.js" crossorigin="anonymous"></script>
   



</head>

<body style="background-color: darkslategray">