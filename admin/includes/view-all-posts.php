<table class="table table-hover">
<thead>
    <tr>

        <th>id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>




    </tr>



</thead>

<tbody>
    
<?php  

// query to select all from the posts 
    $query = "SELECT * FROM posts";
// pass the db connection and the query.
    $selectPosts = mysqli_query($connection, $query);

// to display the posts, a while loop is used. fecth the result of the query.
    while($row = mysqli_fetch_assoc($selectPosts)) {
// the data comes in an assosiative array and the row from the database , and it can be run through a while loop and put into a tr into the table.    
    $postsId = $row['post_id'];
    $postsAuthor = $row['post_author'];
    $postsTitle = $row['post_title'];
    $postsCategoryId = $row['post_category_id'];
    $postsStatus = $row['post_status'];
    $postsImage = $row['post_image'];
    $postsTags = $row['post_tags'];
    $postsCommentCount = $row['post_comment_count'];
    $postsDate = $row['post_date'];

    echo "<tr>";
    echo "<td>{$postsId}</td>";
    echo "<td>{$postsAuthor}</td>";
    echo "<td>{$postsTitle}</td>";
    echo "<td>{$postsCategoryId}</td>";
    echo "<td>{$postsStatus}</td>";
    echo "<td><img width='200' src='../images/$postsImage'></img></td>";
    echo "<td>{$postsTags}</td>";
    echo "<td>{$postsCommentCount}</td>";
    echo "<td>{$postsDate}</td>";
    echo "</tr>";


    }


?>
         

    

</tbody>


</table>