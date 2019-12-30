<?php  
include "includes/db.php"; 
include "includes/header.php"; 
include "includes/navigation.php";

if(isset($_POST['register'])) {

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if(!empty($username) && !empty($email) && !empty($password)) {

// escaping sql injection
    $username = mysqli_real_escape_string($connection, $username );
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
// checking after the default value is there from the database
    $query = "SELECT salt FROM users";
    $selectSaltQuery = mysqli_query($connection, $query);

    if(!$selectSaltQuery) {

    die("QUERY FAILED" . mysqli_error($connection));


    }
// find the first result of salt and put it in a variable
    $row = mysqli_fetch_array($selectSaltQuery);

    $salt = $row['salt'];
// encrypting password     
    $password = crypt($password, $salt);

    $query = "INSERT INTO users (user_username, user_email, user_password, user_role, user_image) VALUES ('{$username}', '{$email}', '{$password}', 'user', 'imgUser.png')";
    $registerUserQuery = mysqli_query($connection, $query);
    if(!$registerUserQuery) {
        die("query failed" . mysqli_error($connection) . ' ' . mysqli_errno($connection));

    }

    $message = "your user as been created";






} else {
    $message = "error fields can't be empty";
}


} else {

    $message= "";
}



?>
    
 
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="email">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="password">
                        </div>
                
                        <input type="submit" name="register"  class="btn btn-primary" value="Register">
                    </form>
                 
                </div>
            </div> 
        </div> 
    </div> 
</section>


        <hr>



<?php include "includes/footer.php";?>
