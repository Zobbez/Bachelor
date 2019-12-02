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
                        // add categories
                        addCategory(); ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="categoryTitle">Add category</label>
                                    <input class="form-control" type="text" name="categoryTitle">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add category">
                                </div>
                            </form>

                           
                            <?php 
                            // edit and include of edit categories query
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
                                    <th>Category title</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
                            // read categories 

                                readCategories();
                          
                            // delete categories 

                                deleteCategory();
                            
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