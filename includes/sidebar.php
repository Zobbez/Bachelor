 <!------------------ Search and category sidebar ------------------->
 <div class="col-md-4">


<!----------------------------- Search block ----------------------->

   
    <h5 class="searchtext">SEARCH</h5>
    <form action="search.php" method="post">
    <div class="input">
        <input class="search" name="search" type="text" class="form-control">
        <span class="input-group-btn">
            <button name="submit" class="hidden"  type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>



<!----------------------------- Login block ----------------------->



    <?php  
    
    if(isset($_SESSION['userrole'])): ?>

    <?php else:  ?>
    
    <div class="well loginform">

    <h4>Login</h4>
    <form action="includes/login.php" method="post">
    <div class="form-group">
        <input name="username" type="text" class="form-control" placeholder="username">
    </div>

    <div class="input-group">
        <input name="password" type="password" class="form-control" placeholder="password">
        <span class="input-group-btn"> 
            <button class="btn orangebtn" name="login" type="submit" style="height: 34px;">Login</button> 
        </span>
    </div>
    </form>

        <a class="btn btn-success" href="registration.php" style="margin-top: 8px;">register</a>

    <?php  endif; ?>    
   
</div>



</div>