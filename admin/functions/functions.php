<?php 

/////////////////////////////// CREATE  //////////////////////////////
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


/////////////////////////////// READ QUERY //////////////////////////////
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

/////////////////////////////// DELETE QUERY //////////////////////////////
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