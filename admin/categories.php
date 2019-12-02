<?php 
include "includes/header.php";

?>


<div id="wrapper">

<?php  
include "includes/navigation.php";

?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                           Welcome to Admin
                            <small>Author name</small>
                        </h1>

                        <div class="col-xs-6">


                            <?php  
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
                            
                            ?>







                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="categoryTitle">Add category</label>
                                    <input class="form-control" type="text" name="categoryTitle">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add category">
                                </div>
                            </form>
                        </div>

                        <div class="col-xs-6">
                        
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Category title</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 

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
                                    echo "</tr>";
        
                         } 
            
                            ?>

                            </tbody>

                        </table>
                        
                        
                        </div>




                      
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
