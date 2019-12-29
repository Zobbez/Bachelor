<table class="table table-hover">
<thead>
    <tr>

        <th>id</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>
        <th>Change user to</th>
        <th>Change user to</th>
        <th>Edit user</th>
        <th>Delete user</th>
        




    </tr>



</thead>

<tbody>
    
<?php  

readUsers();


?>
         

    

</tbody>


</table>


<?php 

deleteUser();

makeUserAdmin();

makeUserUser();



?>