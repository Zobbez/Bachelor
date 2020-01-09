<?php 
include "includes/header.php";
// checks if the token is set from the admin login else don't give access to the page.
if (!isset($_SESSION['token']))
  { echo "CSRF detected";
    exit;

  }

?>


<div id="wrapper">

<?php  
include "includes/navigation.php";

?>

<!------------------ Admin index ------------------------>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Welcome to Admin

                
    
                           <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                      
                    </div>

                </div>
             
            </div>
           
        </div>
    
<?php 

include "includes/footer.php";

?>
