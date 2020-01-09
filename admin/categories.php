<?php 
include "includes/header.php";
// checks if the token is set from the admin login else don't give access to the page.
if (!isset($_SESSION['token']))
  { echo "CSRF detected";
    exit;

  }

?>


<div id="wrapper" style="background-color: darkslategray !important;">

<?php  
include "includes/navigation.php";

?>

        <div id="page-wrapper">

            <div class="container-fluid">

<!--------------------------- Page Heading on categories admin ------------------->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                           See all categories
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>

                        <div class="col-xs-6">

                        
                        <?php 

                        /////////////////////////////// ADD CATEGORIES and the form //////////////////////////////
                        addCategory(); ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="categoryTitle">Add category</label>
                                    <input class="form-control" type="text" name="categoryTitle">
                                </div>
                                <div class="form-group">
                                    <input class="btn orangebtn" type="submit" name="submit" value="Add category">
                                </div>
                            </form>


                            
                           
                        <?php 

                        // check if the get request of edit is set, and include of edit categories query
                            if(isset($_GET['edit'])) {

                                $catId = $_GET['edit'];

                                include "includes/edit-categories.php";

                            }
                            
                            
                        ?>


                        </div>


                        <div class="col-xs-6">
                        
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>category title</th>
                                    <th>delete</th>
                                    <th>edit</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 

                            /////////////////////////////// READ CATEGORIES //////////////////////////////

                                readCategories();
                          
                             /////////////////////////////// DELETE CATEGORY //////////////////////////////

                                deleteCategory();
                            
                            ?>


                            </tbody>

                        </table>
                        
                        
                        </div>
                      
                    </div>

                </div>

            </div>
           
        </div>


   
<?php 
include "includes/footer.php";

?>