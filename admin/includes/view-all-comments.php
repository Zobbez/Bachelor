<table class="table table-hover">
<thead>
    <tr>

        <th>id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>in Response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Delete</th>




    </tr>



</thead>

<tbody>
    
<?php  

readComments();


?>
         

    

</tbody>


</table>


<?php 

deleteComments();

?>