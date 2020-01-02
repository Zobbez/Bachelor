<?php 


//////////////////////////////////// CREATE POST /////////////////////////////////

function createPost() {

// makes the connection variable global
    global $connection;

    if(isset($_POST['create-post'])) {
// assigning the values from the forms to variables.
    $postTitle = $_POST['title'];
    $postAuthor = $_POST['author'];
    $postCategoryId = $_POST['post-category'];
    $postStatus = $_POST['post-status'];
// super global FILES with image from form and a tempary location. needs to be told where to go.
    $postImage = $_FILES['image']['name'];
    $postImageTemp = $_FILES['image']['tmp_name'];
    

    $postTags = $_POST['post-tags'];
    $postContent = $_POST['post-content'];
    $postDate = date('d-m-y');
    $postCommentCount = 0;



// takes two parameters and moves the image from the temp location to the location that is specified
    move_uploaded_file($postImageTemp, "../images/$postImage");
// insert the post data into the posts table in the following columns
    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status)";
// concatenate the rest of the query with the value to put into the database.
// the now function is gonna format the date to the current date and make it look good in the database
    $query .= "VALUES ( {$postCategoryId}, '{$postTitle}', '{$postAuthor}', now(), '{$postImage}', '{$postContent}', '{$postTags}', '{$postCommentCount}', '{$postStatus}')";

    $createPostQuery = mysqli_query($connection, $query);

    
    confirmQuery($createPostQuery);

// refresh the page so that post is added and it goes back to view all posts.
    header("Location: posts.php");

    }

}

//////////////////////////////////// READ POST /////////////////////////////////

function readPosts() {

// makes the connection variable global
    global $connection;

// query to select all from the posts 
    $query = "SELECT * FROM posts";
// pass the db connection and the query.
    $selectPosts = mysqli_query($connection, $query);

// to display the posts, a while loop is used. fecth the result of the query.
    while($row = mysqli_fetch_assoc($selectPosts)) {
// the data comes in an assosiative array and the row from the database , and it can be run through a while loop and put into a tr into the table.    
    $postsId = $row['post_id'];
    $postsAuthor = $row['post_author'];
    $postsTitle = $row['post_title'];
    $postsCategoryId = $row['post_category_id'];
    $postsStatus = $row['post_status'];
    $postsImage = $row['post_image'];
    $postsTags = $row['post_tags'];
    $postsCommentCount = $row['post_comment_count'];
    $postsDate = $row['post_date'];

    echo "<tr>";
    echo "<td>{$postsId}</td>";
    echo "<td>{$postsAuthor}</td>";
    echo "<td><a href='../post.php?p_id=$postsId'>{$postsTitle}</a></td>";

// query to select all from the categories where the cat_id is the id of the post_category_id, so it can be related from the database
    $query = "SELECT * FROM categories WHERE cat_id = {$postsCategoryId}";
// pass the db connection and the query.
    $editCategories = mysqli_query($connection, $query);

// to get all the categories, a while loop is used. fecth the result of the query.
    while($row = mysqli_fetch_assoc($editCategories)) {
// catTitle comes in an assosiative array and the row from the database , and it can be echoed in a td in a tr into the table to display the name of the category instead of the number.    
    $catTitle = $row['cat_title'];
// now the title can be echoed 
    echo "<td>{$catTitle}</td>";
    }

    echo "<td>{$postsStatus}</td>";
    echo "<td><img width='200' src='../images/$postsImage'></img></td>";
    echo "<td>{$postsTags}</td>";
    echo "<td>{$postsCommentCount}</td>";
    echo "<td>{$postsDate}</td>";
    echo "<td><a href='posts.php?source=edit-post&p_id=$postsId'>edit</a></td>";
    echo "<td><a href='posts.php?delete=$postsId'>X</a></td>";
    echo "</tr>";


    }



}




//////////////////////////////////// DELETE POST /////////////////////////////////

function deletePost() {

// makes the connection variable global
    global $connection;
// check if a get request is send and check for the delete key
    if(isset($_GET['delete'])) {
// if it is found save the value of the key into variable
    $deletePostId = $_GET['delete'];
// make the query that deletes the selected category from the categories table    
    $query = "DELETE FROM posts WHERE post_id = $deletePostId"; 
// send the query to the database    
    $deleteQuery = mysqli_query($connection, $query); 
// refresh the page so that category is deleted instantly.
    header("Location: posts.php");
    
    
    }    



    }





//////////////////////////////////// FUNCTION USED TO CONTROL QUERY ERROR /////////////////////////////////

function confirmQuery($result) {

// makes the connection variable global
    global $connection;

//  the create query was successful if not kil the script
    if(!$result) {

    die("Query Failed" . mysqli_error($connection));

}

  

}


/////////////////////////////// CREATE CATEGORY //////////////////////////////

function addCategory() {

// makes the connection variable global
    global $connection;

// check the post on submit
    if(isset($_POST['submit'])) {

// variable holding the categoryTitle from the form
    $catTitle =  $_POST['categoryTitle'];
                                    
// validation for title check it is an empty string or if it is empty
    if($catTitle == "" || empty($catTitle)) {
// if empty echo put in a title
    echo "Put in a title";
        
    } else {
// if there is a title, insert the title to the categories table in the coloumn cat_title
    $query = "INSERT INTO categories(cat_title)";
// concatenate the rest of the query with the value to put into the database.
    $query .= "VALUE('{$catTitle}')";
        
// send the query to the database
    $createCategoryQuery = mysqli_query($connection, $query);
        
// If the create query was successful
    if(!$createCategoryQuery) {
//  if not kil the script
    die('QUERY FAILED' .mysqli_error($connection));
        
        }
        
      }
        
    }
    
}


/////////////////////////////// READ CATEGORY QUERY //////////////////////////////

function readCategories() {

// makes the connection variable global
    global $connection;
// query to select all from the categories 
    $query = "SELECT * FROM categories";
// pass the db connection and the query.
    $selectCategories = mysqli_query($connection, $query);
            
// to display the categories, a while loop is used. fecth the result of the query.
    while($row = mysqli_fetch_assoc($selectCategories)) {
// catId and catTitle comes in an assosiative array and the row from the database , and it can be echoed in a td in a tr into the table.    
    $catId = $row['cat_id'];
    $catTitle = $row['cat_title'];
    echo "<tr>";
    echo "<td>{$catId}</td>";
    echo "<td>{$catTitle}</td>";
// make sure it's on the same page, click on the link to pass parameter catId and ?delete makes key in the array to delete the oncoming value
    echo "<td><a href='categories.php?delete={$catId}'>X</a></td>";
// make sure it's on the same page, click on the link to pass parameter catId and ?edit makes key in the array to edit the oncoming value
    echo "<td><a href='categories.php?edit={$catId}'>Edit</a></td>";
    echo "</tr>";
        
                         } 

}     

/////////////////////////////// DELETE CATEGORY QUERY //////////////////////////////
    
function deleteCategory() {

// makes the connection variable global
    global $connection;

// check if a get request is send and check for the delete key
    if(isset($_GET['delete'])){
// if it is found save the value of the key into variable
    $deleteCatId = $_GET['delete'];
// make the query that deletes the selected cateagory from the categories table
    $query = "DELETE FROM categories WHERE cat_id = {$deleteCatId}";
// send the query to the database
    $deleteQuery = mysqli_query($connection, $query);
// refresh the page so that category is deleted instantly.
    header("Location: categories.php");
    
                                        }


}


//////////////////////////////////// READ COMMENTS /////////////////////////////////

function readComments() {

// makes the connection variable global
    global $connection;
    
// query to select all from the comments
    $query = "SELECT * FROM comments";
// pass the db connection and the query.
    $selectComments = mysqli_query($connection, $query);
    
// to display the posts, a while loop is used. fecth the result of the query.
    while($row = mysqli_fetch_assoc($selectComments)) {
// the data comes in an assosiative array and the row from the database , and it can be run through a while loop and put into a tr into the table.    
    $commentId = $row['comment_id'];
    $commentPostId = $row['comment_post_id'];
    $commentAuthor = $row['comment_author'];
    $commentContent = $row['comment_content'];
    $commentStatus = $row['comment_status'];
    $commentDate = $row['comment_date'];
    

    echo "<tr>";
    echo "<td>{$commentId}</td>";
    echo "<td>{$commentAuthor}</td>";
    echo "<td>{$commentContent}</td>";
    echo "<td>{$commentStatus}</td>";
//  query to select all from the posts where the post_id column matches the id of the comment_post_id, so it can be related from the database
    $query = "SELECT * FROM posts WHERE post_id = $commentPostId";
    $selectPostIdQuery = mysqli_query($connection, $query); 
// to get all the posts, a while loop is used. fecth the result of the query.
    while($row = mysqli_fetch_assoc($selectPostIdQuery)) {
// catTitle comes in an assosiative array and the row from the database , and it can be echoed in a td in a tr into the table to display the name of the category instead of the number.    
    $postId = $row['post_id'];
    $postTitle = $row['post_title'];
// now the title can be echoed and linked to the postId in a GET request so it goes to the post that the comment belongs to
    echo "<td><a href='../post.php?p_id=$postId'>{$postTitle}</a></td>";
    } 

// the comment id is used to target the selecteded comment
    echo "<td>{$commentDate}</td>";
    echo "<td><a href='comments.php?approve=$commentId'>approve</a></td>";
    echo "<td><a href='comments.php?unapprove=$commentId'>unapprove</a></td>";
    echo "<td><a href='comments.php?delete=$commentId'>X</a></td>";
    echo "</tr>";


    }

    
    
    }

//////////////////////////////////// DELETE COMMENTS /////////////////////////////////

function deleteComments() {

// makes the connection variable global
    global $connection;
// check if a get request is send and check for the delete key
    if(isset($_GET['delete'])) {
// if it is found save the value of the key into variable
    $deleteCommentId = $_GET['delete'];
// make the query that deletes the selected comments from the comments table    
    $query = "DELETE FROM comments WHERE comment_id  = $deleteCommentId"; 
// send the query to the database    
    $deleteQuery = mysqli_query($connection, $query); 
// refresh the page so that comment is deleted instantly.
    header("Location: comments.php");
            
            
            }    
        
        
        
            }

 //////////////////////////////////// APPROVE COMMENTS /////////////////////////////////

function approveComments() {

    // makes the connection variable global
        global $connection;
    // check if a get request is send and check for the delete key
        if(isset($_GET['approve'])) {
    // if it is found save the value of the key into variable
        $approveCommentId = $_GET['approve'];
    // make the query that unapproves the selected comment from the comments table    
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $approveCommentId "; 
    // send the query to the database    
        $approveCommentQuery = mysqli_query($connection, $query); 
    // refresh the page so that comment is deleted instantly.
        header("Location: comments.php");
        
        
        }    
    
    
    
        }            
    
 //////////////////////////////////// UNAPPROVE COMMENTS /////////////////////////////////

function unapproveComments() {

    // makes the connection variable global
        global $connection;
    // check if a get request is send and check for the delete key
        if(isset($_GET['unapprove'])) {
    // if it is found save the value of the key into variable
        $unapproveCommentId = $_GET['unapprove'];
    // make the query that unapproves the selected comment from the comments table    
        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $unapproveCommentId "; 
    // send the query to the database    
        $unapproveCommentQuery = mysqli_query($connection, $query); 
    // refresh the page so that comment is deleted instantly.
        header("Location: comments.php");
        
        
        }    
    
    
    
        }            
    
//////////////////////////////////// READ USERS /////////////////////////////////

function readUsers() {

    // makes the connection variable global
        global $connection;
        
    // query to select all from the users
        $query = "SELECT * FROM users";
    // pass the db connection and the query.
        $selectUsers = mysqli_query($connection, $query);
        
    // to display the users, a while loop is used. fecth the result of the query.
        while($row = mysqli_fetch_assoc($selectUsers)) {
    // the data comes in an assosiative array and the row from the database , and it can be run through a while loop and put into a tr into the table.    
        $userId = $row['user_id'];
        $userUsername = $row['user_username'];
        $userPassword = $row['user_password'];
        $userFirstname = $row['user_firstname'];
        $userLastname = $row['user_lastname'];
        $userEmail = $row['user_email'];
        $userImage = $row['user_image'];
        $userRole = $row['user_role'];
       
        
    
        echo "<tr>";
        echo "<td>{$userId}</td>";
        echo "<td>{$userUsername}</td>";
        echo "<td>{$userFirstname}</td>";
        echo "<td>{$userLastname}</td>";
        echo "<td>{$userEmail}</td>";
        echo "<td>{$userRole}</td>";
        
    /* //  query to select all from the posts where the post_id column matches the id of the comment_post_id, so it can be related from the database
        $query = "SELECT * FROM posts WHERE post_id = $commentPostId";
        $selectPostIdQuery = mysqli_query($connection, $query); 
    // to get all the posts, a while loop is used. fecth the result of the query.
        while($row = mysqli_fetch_assoc($selectPostIdQuery)) {
    // catTitle comes in an assosiative array and the row from the database , and it can be echoed in a td in a tr into the table to display the name of the category instead of the number.    
        $postId = $row['post_id'];
        $postTitle = $row['post_title'];
    // now the title can be echoed and linked to the postId in a GET request so it goes to the post that the comment belongs to
        echo "<td><a href='../post.php?p_id=$postId'>{$postTitle}</a></td>";
        }  */
    
    // the user id is used to target the selecteded user
        echo "<td><a href='users.php?change-to-admin=$userId'>Make admin</a></td>";
        echo "<td><a href='users.php?change-to-user=$userId'>Make user</a></td>";
    // sending the source parameter, i use switch statement in users.php like in posts.php
        echo "<td><a href='users.php?source=edit-user&edit-user=$userId'>edit</a></td>";
        echo "<td><a href='users.php?delete=$userId'>X</a></td>";
        echo "</tr>";
    
    
        }
    
        
        
        }

//////////////////////////////////// CREATE USER /////////////////////////////////

function createUser() {

    // makes the connection variable global
        global $connection;
    
        if(isset($_POST['create-user'])) {
    // assigning the values from the forms to variables.
        $userId = 0;
        $userFirstName = $_POST['first-name'];
        $userLastName = $_POST['last-name'];
        $userRole = $_POST['user-role'];

    // super global FILES with image from form and a tempary location. needs to be told where to go.
        $userImage = $_FILES['image']['name'];
        $userImageTemp = $_FILES['image']['tmp_name'];
          
        $userName = $_POST['username'];
        $userEmail = $_POST['email'];
        $userPassword = $_POST['password'];

        $password = password_hash($userPassword , PASSWORD_DEFAULT, array('cost' => 5));
       
    
    // takes two parameters and moves the image from the temp location to the location that is specified
        move_uploaded_file($userImageTemp, "../images/$userImage");


    // insert the post data into the posts table in the following columns
        $query = "INSERT INTO users( user_id, user_firstname, user_lastname, user_role, user_image, user_username, user_email, user_password)";
    // concatenate the rest of the query with the value to put into the database.
    // the now function is gonna format the date to the current date and make it look good in the database
        $query .= "VALUES ($userId, '{$userFirstName}', '{$userLastName}', '{$userRole}', '{$userImage}', '{$userName}', '{$userEmail}', '{$password}')";
    
        $createUserQuery = mysqli_query($connection, $query);
    
        
        confirmQuery($createUserQuery);
    
    // refresh the page so that post is added and it goes back to view all posts.
        header("Location: users.php");
    
        }
    
    }   
    
    

//////////////////////////////////// DELETE USER /////////////////////////////////

function deleteUser() {

    

    // makes the connection variable global
        global $connection;
    // check if a get request is send and check for the delete key
        if(isset($_GET['delete'])) {

    if(isset($_SESSION['userrole'])) {

        if($_SESSION['userrole'] == 'admin') {

    // if it is found save the value of the key into variable
        $deleteUserId = mysqli_real_escape_string($connection, $_GET['delete']);
    // make the query that deletes the selected user from the users table    
        $query = "DELETE FROM users WHERE user_id  = $deleteUserId"; 
    // send the query to the database    
        $deleteQuery = mysqli_query($connection, $query); 
    // refresh the page so that user is deleted instantly.
        header("Location: users.php");
                        }   
                
                    }  
                }    
            
          }   





                
                

 //////////////////////////////////// MAKE USER ADMIN /////////////////////////////////

 function makeUserAdmin() {

    // makes the connection variable global
        global $connection;
    // check if a get request is send and check for the delete key
        if(isset($_GET['change-to-admin'])) {
    // if it is found save the value of the key into variable
        $makeUserAdmin = $_GET['change-to-admin'];
    // make the query that unapproves the selected comment from the comments table    
        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $makeUserAdmin "; 
    // send the query to the database    
        $makeUserAdminQuery = mysqli_query($connection, $query); 
    // refresh the page so that comment is deleted instantly.
        header("Location: users.php");
        
        
        }    
    
    
    
        }   
        
        
 //////////////////////////////////// MAKE USER USER /////////////////////////////////

 function makeUserUser() {

    // makes the connection variable global
        global $connection;
    // check if a get request is send and check for the delete key
        if(isset($_GET['change-to-user'])) {
    // if it is found save the value of the key into variable
        $makeUserUser = $_GET['change-to-user'];
    // make the query that unapproves the selected comment from the comments table    
        $query = "UPDATE users SET user_role = 'user' WHERE user_id = $makeUserUser "; 
    // send the query to the database    
        $makeUserAdminQuery = mysqli_query($connection, $query); 
    // refresh the page so that comment is deleted instantly.
        header("Location: users.php");
        
        
        }    
    
    
    
        } 
        
    



?>