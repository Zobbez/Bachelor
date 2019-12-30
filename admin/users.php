    <?php 
    include "includes/header.php";

    ?>


<div id="wrapper">

    <?php  
    include "includes/navigation.php";

    ?>

    <div id="page-wrapper">

        <div class="container-fluid">

<!------------ Page Heading -------------->
            <div class="row">
                
                <div class="col-lg-12">

                <h1 class="page-header">
                    User settings
                    <small><?php echo $_SESSION['username']; ?></small>
                </h1>

        
        
        <?php 

            //check if the GET request source is available 
                if(isset($_GET['source'])){
            // if it is set it is a variable called source
                $source = $_GET['source']; 

            } else {

                $source = '';

            }
            // if source is equal to different source cases from get GET request then display different things
                switch($source) {

                case 'add-user';
                include "includes/add-user.php";
                break;

                case 'edit-user';
                include "includes/edit-user.php";
                break;

            // set the defualt to show all the users if no source criteria fits. 
                default:
                include "includes/view-all-users.php";
                break;





            }








?>




                      
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