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

    <?php  
    
    if(isset($_SESSION['userrole'])): ?>

    <h4>Logged in as <?php echo $_SESSION['username'] ?> </h4>

    <a href="includes/logout.php" class="btn btn-primary">Logout</a>
    

    <?php else:  ?>

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

        <a class="btn btn-warning" href="registration.php">register</a>

    <?php  endif; ?>    
   
</div>



</div>