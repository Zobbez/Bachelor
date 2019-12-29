<?php 
include "includes/header.php";

?>


<div id="wrapper" style="background-color: darkslategray !important;">

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
