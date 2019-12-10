

<?php  

// header, navigation and db included
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php";
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
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
            
    ?>

<!--------------------- Structure of a post after search ------------------>    

            <h1 class="page-header">
                        Page Heading
                <small>Secondary Text</small>
            </h1>

            <h2>
                <a href="#"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
            <hr>
            <p> <?php echo $post_content; ?> </p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>


    <?php } 


}


}

?>


                 
               


             



            </div>

            <?php  include "includes/sidebar.php";  ?>

        </div>
        <!-- /.row -->

        <hr>

<?php 
       
include "includes/footer.php";

?>
