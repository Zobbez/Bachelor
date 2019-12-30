<?php include "db.php"; 
// starting session to be able to send user info between pages.
    session_start();

    if(isset($_POST['login'])) {

// getting the user info from the form
    $username = $_POST['username'];
    $password = $_POST['password']; 
   
// avoding sql injection in the form.    
    $usernameClean = mysqli_real_escape_string($connection, $username);
    $passwordClean = mysqli_real_escape_string($connection, $password);

// select the user that matches the sql clean username 
    $query = "SELECT * FROM users WHERE user_username = '{$usernameClean}' ";
    $selectUserQuery = mysqli_query($connection, $query);

    if(!$selectUserQuery) {

    die("QUERY FAILED" .mysqli_error($connection));

    }
// using while loop to pull all the user information out of the query and assign tjhem to variables.
    while($row = mysqli_fetch_array($selectUserQuery)) {

    $dbUserId = $row['user_id'];
    $dbUserUsername = $row['user_username'];
    $dbUserImage = $row['user_image'];
    $dbUserPassword = $row['user_password'];
    $dbUserFirstname = $row['user_firstname'];
    $dbUserLastname = $row['user_lastname'];
    $dbUserRole = $row['user_role'];


    }

// reversing the salt to be able to login with the created password and not the encrypted one.    
    $password = crypt($passwordClean, $dbUserPassword);

// check if the username and password from the form matches the ones in the database if it does assign sessions with the variables created from the database values 
    if($usernameClean === $dbUserUsername && $password === $dbUserPassword) {

        $_SESSION['username'] =  $dbUserUsername;
        $_SESSION['firstname'] =  $dbUserFirstname;
        $_SESSION['lastname'] =  $dbUserLastname;
        $_SESSION['userrole'] =  $dbUserRole;
        $_SESSION['userimage'] =  $dbUserImage;


        header("Location: ../admin");
        
// else just redirect to index.
    } else { 

        header("Location: ../index.php");
    }


}





?>


