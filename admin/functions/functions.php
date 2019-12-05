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
    $postCommentCount = 4;



// takes two parameters and moves the image from the temp location to the location that is specified
    move_uploaded_file($postImageTemp, "../images/$postImage");
// insert the post data into the posts table in the following columns
    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status)";
// concatenate the rest of the query with the value to put into the database.
// the now function is gonna format the date to the current date and make it look good in the database
    $query .= "VALUES ( {$postCategoryId}, '{$postTitle}', '{$postAuthor}', now(), '{$postImage}', '{$postContent}', '{$postTags}', '{$postCommentCount}', '{$postStatus}')";

    $createPostQuery = mysqli_query($connection, $query);

    
    confirmQuery($createPostQuery);

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
    echo "<td>{$postsTitle}</td>";

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
// make the query that deletes the selected catagory from the categories table    
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

    die("Quert Failed" . mysqli_error($connection));

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
// make the query that deletes the selected catagory from the categories table
    $query = "DELETE FROM categories WHERE cat_id = {$deleteCatId}";
// send the query to the database
    $deleteQuery = mysqli_query($connection, $query);
// refresh the page so that category is deleted instantly.
    header("Location: categories.php");
    
                                        }


}

?>