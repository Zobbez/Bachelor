<?php 

//////////////////////////////////// CREATE POST /////////////////////////////////
    createPost();

?>


<!-- to upload image the attribute enctype is needed on the form, it's sending different form data. -->
<form action=""  method="post" enctype="multipart/form-data">


<div class="form-group">
    <label for="title">Post title</label>
    <input type="text" class="form-control" name="title"> 
</div>

<div class="form-group">
<label for="post-category">Post category</label>
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


<!--------------------------- Add post form ------------------------->

<div class="form-group">
    <label for="title">Post author</label>
    <input type="text" value="<?php echo $_SESSION['username']; ?>" class="form-control" name="author" readonly> 
</div>

<div class="form-group">
    <label for="post-status">Post status</label>
    <select name="post-status" id="">
      <option value="draft">draft</option>
      <option value="published">published</option>
    </select>
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