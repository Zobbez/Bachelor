 <!------------------ Search and category sidebar ------------------->
 <div class="col-md-4">


<!----------------------------- Search block ----------------------->
<div class="well">
    <h4>Search</h4>
    <form action="search.php" method="post">
    <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
            <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>
</div>


<!----------------------------- Login block ----------------------->

<div class="well">
    <h4>Login</h4>
    <form action="includes/login.php" method="post">
    <div class="form-group">
        <input name="username" type="text" class="form-control" placeholder="username">
    </div>

    <div class="input-group">
        <input name="password" type="password" class="form-control" placeholder="password">
        <span class="input-group-btn"> 
            <button class="btn btn-primary" name="login" type="submit">Login</button> 
        </span>
    </div>
    </form>
</div>



<!------------------------- Categories navigation query and sidebar ------------------------->
<div class="well">

<?php        

// query to select all from the categories 
    $query = "SELECT * FROM categories";
// pass the db connection and the query.
    $selectCategoriesSidebarQuery = mysqli_query($connection, $query);
    
    
?>


    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">

            <?php 
            
            // to display the categories, a while loop is used. fecth the result of the query.
                while($row = mysqli_fetch_assoc($selectCategoriesSidebarQuery)) {
            // cat_title comes in an assosiative array and the row from the database , and it can be echoed as a li.    
                $catTitle = $row['cat_title'];
            // get the cat_id from the database 
                $catId = $row['cat_id'];
        
                echo "<li><a href='category.php?category=$catId'>{$catTitle}</a></li>";
        
                         } 
            
            ?>

            </ul>
        </div>
    </div>
</div>


<!---------------------------- Extra side box -------------------------->
<?php include "widget.php";    ?>

</div>