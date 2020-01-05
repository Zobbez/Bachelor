<!-------------- Navigation ------------------->
<?php
 session_start();
?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: darkslategray;">
    <div class="container">


<!------------------------- Logo and toggle get grouped for better mobile display ------------------->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">LOGO SKAL IND</a>
            </div>



<!------------------------- Category query for links in the navigation  --------------->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

   

        <ul class="nav navbar-nav">


            <?php 
                 // query to select all from the categories 
                    $query = "SELECT * FROM categories";
                 // pass the db connection and the query.
                    $selectAllCategoriesQuery = mysqli_query($connection, $query);
                 // to display the categories, a while loop is used. fecth the result of the query.
                    while($row = mysqli_fetch_assoc($selectAllCategoriesQuery)) {
                 // cat_title comes in an assosiative array and the row from the database , and it can be echoed as a li.    
                    $catTitle = $row['cat_title'];
                 // get the cat_id from the database 
                    $catId = $row['cat_id'];
                // needs to be filled out with active to show active navigation link
                    $categoryClass = '';
                // determination of what page is active
                    $pageName = basename($_SERVER['PHP_SELF']);
                    
                   if(isset($_GET['category']) && $_GET['category'] == $catId ) {
                        
                    $categoryClass = "active";

                    }


                 // echo all the categories out as links in the navigation.
                    echo "<li class='$categoryClass'><a href='category.php?category=$catId'>{$catTitle}</a></li>";

                 }
                 
         
                 if(isset($_SESSION['userrole'])) {

                 if($_SESSION['userrole'] == 'admin'){

                   echo '<li>
                        <a href="admin/posts.php">Admin</a>
                    </li>';
                 } else {
                     echo "";
                 }
                }
                   ?>      

                </ul>
            </div>
          
        </div>
       
    </nav>