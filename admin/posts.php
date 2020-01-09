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

<!-- Page Heading -->
                    <div class="row">
                        
                        <div class="col-lg-12">

                            <h1 class="page-header">
                               Posts settings
                                <small><?php echo $_SESSION['username']; ?></small>
                            </h1>



        <?php 

            //check if the GET request source is available 
                if(isset($_GET['source'])){
            // if it is set it is a variable called source
                $source = $_GET['source']; 

            }   else {

                $source = '';

            }
            //if source GET request send from the navigation is equal to the different cases then display different things
                switch($source) {

                case 'add-post';
                include "includes/add-post.php";
                break;

                case 'edit-post';
                include "includes/edit-post.php";
                break;

            // set the defualt to show all the posts if no other criteria is met.
                default:
                include "includes/view-all-posts.php";
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