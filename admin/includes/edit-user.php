<?php 

if(isset($_GET['p_id'])) {

$postId = $_GET['p_id'];



}

// query to select all from the posts 
    $query = "SELECT * FROM posts WHERE post_id = $postId";
// pass the db connection and the query.
    $selectPostsById = mysqli_query($connection, $query);

// to display the posts, a while loop is used. fecth the result of the query.
    while($row = mysqli_fetch_assoc($selectPostsById)) {
// the data comes in an assosiative array and the row from the database , and it can be run through a while loop and put the values into the input fields    
    $postsId = $row['post_id'];
    $postsAuthor = $row['post_author'];
    $postsTitle = $row['post_title'];
    $postsCategoryId = $row['post_category_id'];
    $postsStatus = $row['post_status'];
    $postsImage = $row['post_image'];
    $postsContent = $row['post_content'];
    $postsTags = $row['post_tags'];
    $postsCommentCount = $row['post_comment_count'];
    $postsDate = $row['post_date'];

    }


    if(isset($_POST['update-post'])) {
// these are used in the query to send to the database
    $postsTitle = $_POST['title'];
    $postsAuthor = $_POST['author'];
    $postsCategoryId = $_POST['post-category'];
    $postsStatus = $_POST['post-status'];
// super global FILES with image from form and a tempary location. needs to be told where to go.
    $postsImage = $_FILES['image']['name'];
    $postsImageTemp = $_FILES['image']['tmp_name'];
    $postsContent = $_POST['post-content'];
    $postsTags = $_POST['post-tags'];

// takes two parameters and moves the image from the temp location to the location that is specified
    move_uploaded_file($postsImageTemp, "../images/$postsImage");
// check if the image variable is empty
    if(empty($postsImage)) {

    $query = "SELECT * FROM posts WHERE post_id = $postId";
    $selectImage = mysqli_query ($connection, $query);
// loop through the query 
    while($row = mysqli_fetch_array($selectImage)) {
// pull out image and set as the variable
    $postsImage = $row['post_image'];

        }

    }


    $query = "UPDATE posts SET post_title = '{$postsTitle}', post_category_id = '{$postsCategoryId}', post_date = now(), post_author = '{$postsAuthor}', post_status = '{$postsStatus}', post_tags = '{$postsTags}', post_content = '{$postsContent}', post_image = '{$postsImage}' WHERE post_id = $postId ";    

    $updateQuery = mysqli_query($connection, $query);

    confirmQuery($updateQuery);





    }


?>





<form action=""  method="post" enctype="multipart/form-data">


<div class="form-group">
    <label for="title">Post title</label>
    <input value="<?php echo $postsTitle; ?>"  type="text" class="form-control" name="title"> 
</div>

<div class="form-group">

    <select name="post-category" id="post-category">
        <?php

// query to select all from the categories where the cat_id is the selected
    $query = "SELECT * FROM categories";
// pass the db connection and the query.
    $selectCategories = mysqli_query($connection, $query);


    confirmQuery($selectCategories);   

// to display the categories, a while loop is used. fecth the result of the query.
    while($row = mysqli_fetch_assoc($selectCategories)) {
// catId and catTitle comes in an assosiative array and the row from the database , and it can be echoed in a td in a tr into the table.    
    $catId = $row['cat_id'];
    $catTitle = $row['cat_title'];

    echo "<option value='$catId'>$catTitle</option>";





                }

        ?>

                
    </select>
</div>

<div class="form-group">
    <label for="title">Post author</label>
    <input value="<?php echo $postsAuthor; ?>" type="text" class="form-control" name="author"> 
</div>

<div class="form-group">
    <label for="post-status">Post status</label>
    <input value="<?php echo $postsStatus; ?>"  type="text" class="form-control" name="post-status"> 
</div>

<div class="form-group">
    <img width="300" src="../images/<?php echo $postsImage; ?>" alt="">
    <input type="file" name="image"> 
</div>

<div class="form-group">
    <label for="post-tags">Post tags</label>
    <input value="<?php echo $postsTags; ?>"  type="text" class="form-control" name="post-tags"> 
</div>

<div class="form-group">
    <label for="post-content">Post content</label>
    <textarea class="form-control" name="post-content" id="" cols="30" rows="10"> <?php echo $postsContent; ?>  </textarea>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="update-post" value="Update post"> 
</div>


</form>