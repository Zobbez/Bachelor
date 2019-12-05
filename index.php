

<?php  

// header, navigation and db included
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php";
?>



    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                 // query to select all from posts
                 $query = "SELECT * FROM posts";
                 // pass the db connection and the query.
                 $selectAllPostsQuery = mysqli_query($connection, $query);
                 // to display the categories, a while loop is used. fecth the result of the query.
                 while($row = mysqli_fetch_assoc($selectAllPostsQuery)) {
                 // the data comes in an assosiative array and the row from the database, and it can used to echo out the info.        
                        $postId = $row['post_id'];
                        $postTitle = $row['post_title'];
                        $postAuthor = $row['post_author'];
                        $postDate = $row['post_date'];
                        $postImage = $row['post_image'];
                        // function to limit the content show on the index.
                        $postContent = substr($row['post_content'],0, 30);
                        
                ?>

                        <h1 class="page-header">
                                    Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- Blog Post -->
                        <h2>
                            <a href="post.php?p_id=<?php echo $postId ?>"><?php echo $postTitle; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $postAuthor; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>
                        <hr>
                        <a href="post.php?p_id=<?php echo $postId ?>">  <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt=""> </a>
                        <hr>
                        <p> <?php echo $postContent; ?> </p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>


                <?php } ?>


               


             



            </div>

            <?php  include "includes/sidebar.php";  ?>

        </div>
        <!-- /.row -->

        <hr>

<?php 
       
include "includes/footer.php";

?>
