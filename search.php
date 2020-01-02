

<?php  

// header, navigation and db included
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php";
//session_start();
?>



<!---------------------------- Page Content ----------------------------->
    <div class="container">

        <div class="row">

<!---------------------------- Searchblock query------------------------->
            <div class="col-md-8">
              

<?php 

// checking if there is a search submitted, 
    if(isset($_POST['submit'])) {
// send the search as a post request
    $search = $_POST['search'];
// select everything from posts where the post_title are like the search input
    $query = "SELECT * FROM posts WHERE post_title LIKE '%$search%' ";
// send the query to the database
    $searchQuery = mysqli_query($connection, $query);
// check if the search query works 
    if(!$searchQuery) {
// kill everything after if the query fails, and output the message QUERY FAILED  
    die("QUERY FAILED" . mysqli_error($connection));
}
// count the number of rows coming from the query
    $count = mysqli_num_rows($searchQuery);
// if the count is 0 then echo that the is no search result
    if($count == 0) {

    echo " <h1> no search result </h1>";

}   else {

    
// to display the search query , a while loop is used. fecth the result of the query.
    while($row = mysqli_fetch_assoc($searchQuery)) {
// the data comes in an assosiative array and the row from the database.      
    $postId = $row['post_id'];
    $postTitle = $row['post_title'];
    $postAuthor = $row['post_author'];
    $postDate = $row['post_date'];
    $postImage = $row['post_image'];
    $postContent = $row['post_content'];
            
    ?>

<!--------------------- Structure of a post after search ------------------>    

                        <h1 class="page-header">
                        <a href="post.php?p_id=<?php echo $postId ?>" style="color: #777777; text-decoration: none;"><?php echo $postTitle; ?></a>
                            <small>by <?php echo $postAuthor; ?> <span style="font-size: 12px" class="glyphicon glyphicon-time"></span> <span style="font-size: 12px"><?php echo $postDate; ?></span> </small>
                        </h1>

                        <a href="post.php?p_id=<?php echo $postId ?>"> <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt=""> </a>
                    
                        <p> <?php echo $postContent; ?> </p>
                        

                        <hr>


    <?php } 


}


}

?>


                 
               


             



            </div>

            <span style="position:-webkit-sticky; position:sticky; top:65px;">    <?php  include "includes/sidebar.php";  ?> </span>

        </div>
        <!-- /.row -->

        <hr>

<?php 
       
include "includes/footer.php";

?>
