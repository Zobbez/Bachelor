<?php 

if(isset($_GET['edit-user'])) {

    $userId = $_GET['edit-user'];

// query to select all from the users
    $query = "SELECT * FROM users WHERE user_id = $userId";
// pass the db connection and the query.
    $selectUsersQuery = mysqli_query($connection, $query);
             
// to grab the users, a while loop is used. fecth the result of the query.
    while($row = mysqli_fetch_assoc($selectUsersQuery)) {
// the data comes in an assosiative array and the row from the database , and it can be run through a while loop and put into a tr into the table.    
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
    $userFirstName = $_POST['first-name'];
    $userLastName = $_POST['last-name'];
    $userRole = $_POST['user-role'];

// super global FILES with image from form and a tempary location. needs to be told where to go.
    $userImage = $_FILES['image']['name'];
    $userImageTemp = $_FILES['image']['tmp_name'];
        
    $userName = $_POST['username'];
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];
    
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

    if(!empty($userPassword)) {

        $queryPassword = "SELECT user_password FROM users WHERE user_id = $userId";
        $getUserQuery =  mysqli_query($connection, $query);
        confirmQuery($getUserQuery);

        $row = mysqli_fetch_array($getUserQuery);
        $dbUserPassword = $row['user_password'];
        if($dbUserPassword != $userPassword) {

            $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT, array('cost' => 5));
    
        }

        $query = "UPDATE users SET user_firstname = '{$userFirstName}', user_lastname = '{$userLastName}', user_role = '{$userRole}', user_username = '{$userName}', user_email = '{$userEmail}', user_password = '{$hashedPassword}', user_image = '{$userImage}' WHERE user_id = {$userId} ";    

        $updateUserQuery = mysqli_query($connection, $query);
    
        confirmQuery($updateUserQuery);
    
    // refresh the page so that post is added and it goes back to view all posts.
        header("Location: users.php");  

    }

   

 
   


 


        }
    
       

?>




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
    <label for="user-role">User type </label>
    <select name="user-role" id="user-role">
    <option value="user"><?php echo $userRole; ?></option>  

    <?php  if($userRole == 'admin') {
    echo "<option value='user'>user</option>";

    }  else { echo "<option value='admin'>admin</option>"; }        ?>
             
                     
    </select>
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
    <input class="btn btn-primary" type="submit" name="edit-user" value="Edit user"> 
</div>


</form>