<?php 

    if(isset($_POST['create-post'])) {
        // assigning the values from the forms to variables.
        $postTitle = $_POST['title'];
        $postAuthor = $_POST['author'];
        $postCategoryId = $_POST['post-category-id'];
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

        
        confirm($createPostQuery);

    }


?>





<!-- to upload image the attribute enctype is needed on the form, it's sending different form data. -->
<form action=""  method="post" enctype="multipart/form-data">


<div class="form-group">
    <label for="title">Post title</label>
    <input type="text" class="form-control" name="title"> 
</div>

<div class="form-group">
    <label for="post-category">Post category id </label>
    <input type="text" class="form-control" name="post-category-id"> 
</div>

<div class="form-group">
    <label for="title">Post author</label>
    <input type="text" class="form-control" name="author"> 
</div>

<div class="form-group">
    <label for="post-status">Post status</label>
    <input type="text" class="form-control" name="post-status"> 
</div>

<div class="form-group">
    <label for="post-image">Post image</label>
    <input type="file" name="image"> 
</div>

<div class="form-group">
    <label for="post-tags">Post tags</label>
    <input type="text" class="form-control" name="post-tags"> 
</div>

<div class="form-group">
    <label for="post-content">Post content</label>
    <textarea class="form-control" name="post-content" id="" cols="30" rows="10"> </textarea>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="create-post" value="Publish post"> 
</div>


</form>