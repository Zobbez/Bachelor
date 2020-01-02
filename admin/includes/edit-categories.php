<form action="" method="post">
<div class="form-group">
<label for="categoryTitle">Edit category</label>

<?php 

// check if a get request is send and check for the edit key
    if(isset($_GET['edit']))
{
// if it is found save the value of the key into variable
    $editCatId = $_GET['edit'];


// query to select all from the categories where the cat_id is the selected
    $query = "SELECT * FROM categories WHERE cat_id = $editCatId";
// pass the db connection and the query.
    $editCategories = mysqli_query($connection, $query);

// to display the categories, a while loop is used. fecth the result of the query.
    while($row = mysqli_fetch_assoc($editCategories)) {
// catId and catTitle comes in an assosiative array and the row from the database , and it can be echoed in a td in a tr into the table.    
    $catId = $row['cat_id'];
    $catTitle = $row['cat_title'];

    ?>


<input class="form-control" type="text" name="categoryTitle" value="<?php if(isset($catTitle)){ echo $catTitle; } ?>">
    

<?php  } } ?>

<?php
        /////////////////////////////// UPDATE QUERY //////////////////////////////


// check if a get request is send and check for the delete key
    if(isset($_POST['updateCategory'])){
// if it is found save the value of the key into variable
    $editCatTitle = $_POST['categoryTitle'];
// make the query that edit the selected cateagory title from the categories table
    $query = "UPDATE categories SET cat_title = '{$editCatTitle}' WHERE cat_id = {$catId}";
// send the query to the database
    $editQuery = mysqli_query($connection, $query);
// check if it is set
    if(!$editQuery) {
// if not kil the script
    die('QUERY FAILED' .mysqli_error($connection));

}

// refresh the page so that category is updated and the input field disapear instantly.
    header("Location: ./categories.php");


}




?>




</div>
<div class="form-group">
<input class="btn btn-primary" type="submit" name="updateCategory" value="Edit category">
</div>
</form>