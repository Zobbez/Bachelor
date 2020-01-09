    <?php 
    include "includes/header.php";
    include "includes/navigation.php";

    if(isset($_SESSION['username'])) {
    // variable containing the username from the session
        $username = $_SESSION['username'];
    // query to select all from the users where the user_username matches the username in the session
        $query = "SELECT * FROM users WHERE user_username = '{$username }' ";
    // pass the db connection and the query.
        $selectUserProfile = mysqli_query($connection, $query);
    // to grab the users, a while loop is used. fecth the result of the query.
        while ($row = mysqli_fetch_array($selectUserProfile)) {
    // the data comes in an assosiative array and the row from the database.
            $userId = $row['user_id'];
            $userUsername = $row['user_username'];
            $userPassword = $row['user_password'];
            $userFirstname = $row['user_firstname'];
            $userLastname = $row['user_lastname'];
            $userEmail = $row['user_email'];
            $userImage = $row['user_image'];
            $userRole = $row['user_role'];

        }

    }


    if(isset($_GET['edit-user'])) {

        $userId = $_GET['edit-user'];
    
    // query to select all from the users
        $query = "SELECT * FROM users WHERE user_id = $userId";
    // pass the db connection and the query.
        $selectUsersQuery = mysqli_query($connection, $query);
                 
    // to grab the users, a while loop is used. fecth the result of the query.
        while($row = mysqli_fetch_assoc($selectUsersQuery)) {
    // the data comes in an assosiative array and the row from the database.   
        $userId = $row['user_id'];
        $userUsername = $row['user_username'];
        $userPassword = $row['user_password'];
        $userFirstname = $row['user_firstname'];
        $userLastname = $row['user_lastname'];
        $userEmail = $row['user_email'];
        $userImage = $row['user_image'];
        $userRole = $row['user_role'];
                
                 }     
    
    
        }
    
    
        
        if(isset($_POST['edit-user'])) {
    // assigning the values from the forms to variables.
        $userId = $_GET['edit-user'];
        $userFirstName = mysqli_real_escape_string($connection, $_POST['first-name']);
        $userLastName = mysqli_real_escape_string($connection, $_POST['last-name']);
        $userRole = mysqli_real_escape_string($connection,$_POST['user-role']);
    
    // super global FILES with image from form and a tempary location. needs to be told where to go.
        $userImage = $_FILES['image']['name'];
        $userImageTemp = $_FILES['image']['tmp_name'];
            
        $userName = mysqli_real_escape_string($connection, $_POST['username']);
        $userEmail = mysqli_real_escape_string($connection, $_POST['email']);
        $userPassword = mysqli_real_escape_string($connection, $_POST['password']);
        
    //  $userCreatedDate = date('d-m-y');
        
    
    // takes two parameters and moves the image from the temp location to the location that is specified
        move_uploaded_file($userImageTemp, "../images/$userImage");
    
    
        if(empty($userImage)) {
    
            $query = "SELECT * FROM users WHERE user_id = $userId";
            $selectImage = mysqli_query ($connection, $query);
        // loop through the query 
            while($row = mysqli_fetch_array($selectImage)) {
        // pull out image and set as the variable
            $userImage = $row['user_image'];
        
                }
        
            }

        

    
    
        $query = "UPDATE users SET user_firstname = '{$userFirstName}', user_lastname = '{$userLastName}', user_role = '{$userRole}', user_username = '{$userName}', user_email = '{$userEmail}', user_password = '{$userPassword}', user_image = '{$userImage}' WHERE user_username = '{$username}' ";    
    
        $updateUserQuery = mysqli_query($connection, $query);
    
        confirmQuery($updateUserQuery);
    
    // refresh the page so that post is added and it goes back to profile.
        header("Location: profile.php");
    
    
            }


    


    
    ?>


<div id="wrapper">

   

    <div id="page-wrapper">

        <div class="container-fluid">

<!------------ Page Heading -------------->
            <div class="row">
                
                <div class="col-lg-12">

                <h1 class="page-header">
                   Edit profile
                    <small><?php echo $_SESSION['username']; ?></small>
                </h1>

                <!-- to upload image the attribute enctype is needed on the form, it's sending different form data. -->
<form action=""  method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">First name</label>
    <input type="text" value="<?php echo $userFirstname;  ?>" class="form-control" name="first-name"> 
</div>

<div class="form-group">
    <label for="post-status">Last name</label>
    <input type="text" value="<?php echo $userLastname;  ?>" class="form-control" name="last-name"> 
</div>




 <div class="form-group">
    <label for="user-image">User image</label>
    <img width="300" src="../images/<?php echo $userImage; ?>" alt="">
    <input type="file" name="image"> 
</div> 

<div class="form-group">
    <label for="post-tags">Username</label>
    <input type="text" value="<?php echo $userUsername;  ?>" class="form-control" name="username"> 
</div>

<div class="form-group">
    <label for="post-content">Email</label>
    <input type="email" value="<?php echo $userEmail;  ?>" class="form-control" name="email"> 
</div>


<div class="form-group">
    <label for="post-content">Password</label>
    <input autocomplete="off" type="password" class="form-control" name="password"> 
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit-user" value="Update profile"> 
</div>


</form>
                

        

                      
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   
<?php 
include "includes/footer.php";

?>