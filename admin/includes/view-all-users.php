<table class="table table-hover">
<thead>
    <tr>

        <th>id</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>
        




    </tr>



</thead>

<tbody>
    
<?php  

readUsers();


?>
         

    

</tbody>


</table>


<?php 

deleteComments();

approveComments();

unapproveComments();



?>