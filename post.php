

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


if(isset($_GET['p_id'])) {

    $postId = $_GET['p_id'];


}

// query to select all from posts where the post id match the send p if from the GET request
    $query = "SELECT * FROM posts WHERE post_id = $postId";
// pass the db connection and the query.
    $selectAllPostsQuery = mysqli_query($connection, $query);
// to display the categories, a while loop is used. fecth the result of the query.
    while($row = mysqli_fetch_assoc($selectAllPostsQuery)) {
// the data comes in an assosiative array and the row from the database, and it can used to echo out the info.        
    $postTitle = $row['post_title'];
    $postAuthor = $row['post_author'];
    $postDate = $row['post_date'];
    $postImage = $row['post_image'];
    $postContent = $row['post_content'];

?>

    <h1 class="page-header">
            Page Heading
    <small>Secondary Text</small>
    </h1>

<!-- Blog Post -->
    <h2>
        <a href="#"><?php echo $postTitle; ?></a>
    </h2>
    <p class="lead">
        by <a href="index.php"><?php echo $postAuthor; ?></a>
    </p>
    <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>
    <hr>
        <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt="">
    <hr>
    <p> <?php echo $postContent; ?> </p>
    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

    <hr>


<?php } ?>

<!-- Blog Comments -->

<!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
            <form role="form">
                <div class="form-group">
                    <textarea class="form-control" rows="3"></textarea>
                </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>

<hr>

<!-- Posted Comments -->

<!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
            <div class="media-body">
                <h4 class="media-heading">Start Bootstrap
                    <small>August 25, 2014 at 9:30 PM</small>
                </h4>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
    </div>

<!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
            <div class="media-body">
                <h4 class="media-heading">Start Bootstrap
                    <small>August 25, 2014 at 9:30 PM</small>
                </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
<!-- Nested Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                    </div>
<!-- End Nested Comment -->
            </div>
    </div>









</div>

<?php  include "includes/sidebar.php";  ?>

</div>
<!-- /.row -->

<hr>

<?php 

include "includes/footer.php";

?>
