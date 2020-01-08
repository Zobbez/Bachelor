<?php  

// determination of what page is active
$pageName = basename($_SERVER['PHP_SELF']);

$categories = 'categories.php';
$comments = 'comments.php';
$commentsClass = '';
$categoryClass = '';

                    
if($pageName === $categories) {
     
 $categoryClass = 'active';

 } else if($pageName === $comments) {

 $commentsClass = 'active';
    
 } else {
$commentsClass = '';
$categoryClass = '';

 }




?>



<!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top"   role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="../index.php">
                <img alt="logo" src="../images/logo.png" width="150" height="30" style="padding-left: 50px; position: relative; transform: translateY(10px);">
                </a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li><a href="../index.php">Home</a></li>
          


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                       
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <!-- <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li> -->
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#postsDropdown"><i class="fas fa-envelope"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="postsDropdown" class="collapse">
                            <li>
                                <a href="./posts.php"><i class="fas fa-envelope-open"></i> View all posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add-post"><i class="fas fa-paper-plane"></i> Add post</a>
                            </li>
                        </ul>
                    </li>

                    <li class='<?php  echo  $categoryClass;  ?>'>
                        <a href="./categories.php"><i class="fas fa-paperclip"></i> Categories </a>
                    </li>
              
                    <li class='<?php  echo $commentsClass;  ?>'>
                        <a href="./comments.php"><i class="fas fa-comments"></i>Comments</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#usersDropdown"><i class="fas fa-user-cog"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="usersDropdown" class="collapse">
                            <li>
                                <a href="users.php"><i class="fas fa-users"></i> All users</a>
                            </li>
                            <li>
                                <a href="users.php?source=add-user"><i class="fas fa-user-plus"></i> Add user</a>
                            </li>
                        </ul>
                    </li>

                    <!-- <li>
                        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> Profile </a>
                    </li> -->

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>