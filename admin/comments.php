<?php 
include "includes/header.php";
// checks if the token is set from the admin login else don't give access to the page.
if (!isset($_SESSION['token']))
  { echo "login as admin";
    exit;

  }

?>


    <div id="wrapper" style="background-color: darkslategray !important;">

    <?php  
        include "includes/navigation.php";

    ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-12">

<!-------------- Page Heading ----------------->                        

                            <h1 class="page-header">
                                See all comments
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
                                    // if source is equal to different cases to display different things
                                        switch($source) {

                                   

                                    // set the defualt to show all the comments
                                        default:
                                        include "includes/view-all-comments.php";
                                        break;

                                                        }

                                ?>
                      
                    </div>

                </div>
              
            </div>
           
        </div>
       

   
<?php 
include "includes/footer.php";

?>