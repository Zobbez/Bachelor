

<?php  

// header, navigation and db included
    include "includes/db.php";
    include "includes/header.php";
    include "includes/navigation.php";
?>



<!---------------------------- Page Content ----------------------------->
    <div class="container">

    <div class="row">

<!---------------------------- Post Query Column ------------------------>
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

    

<!----------------------------- Post single view  ---------------------------->
        <h1 class="page-header">
        <a href="post.php?p_id=<?php echo $postId ?>"><?php echo $postTitle; ?></a>
        <small>by <?php echo $postAuthor; ?> <span style="font-size: 12px" class="glyphicon glyphicon-time"></span> <span style="font-size: 12px"><?php echo $postDate; ?></span> </small>
        </h1>
        <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt="">
    <hr>
    <p> <?php echo $postContent; ?> </p>
    

    


<?php } ?>

<!----------------------------- Create Comment QUERY ---------------------------->

<?php 

// checking if the variable is set, if it is create the comment
    if(isset($_POST['create-comment'])) {

// get the get request of p_id from the url 
    $postId = $_GET['p_id'];
// get the data that was typed in the form
    $commentAuthor = $_POST['comment-author'];
    $commentEmail = $_POST['comment-email'];
    $commentContent = $_POST['comment-content'];


    if(!empty($commentAuthor) && !empty($commentEmail) && !empty($commentContent) ) {

// insert into comments all the needed fields from the database. 
    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($postId, '{$commentAuthor}', '{$commentEmail}', '{$commentContent}', 'unapproved', now() ) ";
// send the query to the database  
    $addCommentQuery = mysqli_query($connection, $query);
//  the add comment query was successful if not kil the script           
    if(!$addCommentQuery) {
    die('QUERY ERROR' . mysqli_error($connection));
                          }

// increase the post comment count by 1 every time a comment is added on the selected post by the id
    $query2 = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $postId";
// send the query to the database
    $updateCommentCountQuery = mysqli_query($connection, $query2);



    } else { 

        echo "<script> alert('fill out comment fields') </script>";


    }  


}



?>

<!--------------------------------- Add Comments Form ------------------------------------->

    <div class="well">
        <h4>add a Comment:</h4>
            <form action="" method="post" role="form">
                
                <div class="form-group">
                    <label for="Author">Author</label>
                    <input type="text" class="form-control" name="comment-author">
                </div>  

                <div class="form-group">
                    <label for="Author">Email</label>
                    <input type="email" class="form-control"  name="comment-email">
                </div>    

                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea name="comment-content" class="form-control" rows="3"></textarea>
                </div>
                    <button type="submit" name="create-comment" class="btn btn-primary">Submit</button>
            </form>
    </div>

<hr>

<!---------------------- Show Exsisting Comments Query ----------------------->

<?php 

// query that takes all the comments that belongs to that post id and the where the comment_status is aprroved and then order them by comment_id in descending order
        $query = "SELECT * FROM comments WHERE comment_post_id = {$postId} AND comment_status = 'approved' ORDER BY comment_id DESC ";
// send the query to the database 
        $showApprovedCommentsQuery = mysqli_query($connection, $query);
// the create query was successful if not kil the script
        if(!$showApprovedCommentsQuery) {
            die('QUERY ERROR ' . mysqli_error($connection));
        }

// loop that does that
        while($row = mysqli_fetch_array($showApprovedCommentsQuery)) {

            $commentDate = $row['comment_date'];
            $commentContent = $row['comment_content'];
            $commentAuthor = $row['comment_author']; 

            ?>

<!-------------------- the Comments on the Post --------------------------------->
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo  $commentAuthor; ?>
                    <small><?php echo $commentDate; ?></small>
                </h4>
                <?php echo $commentContent; ?>
            </div>
    </div>



   <?php      }?>



</div>

<?php  include "includes/sidebar.php";  ?>

</div>


<hr>

<?php 

include "includes/footer.php";

?>
