<!-------------- Navigation ------------------->
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
                    $cat_title = $row['cat_title'];
                 // get the cat_id from the database 
                    $catId = $row['cat_id'];
                 // echo all the categories out as links in the navigation.
                    echo "<li><a href='category.php?category=$catId'>{$cat_title}</a></li>";

                 }
                 
            ?>   

                     <li>
                        <a href="admin">Admin</a>
                    </li>

                </ul>
            </div>
          
        </div>
       
    </nav>