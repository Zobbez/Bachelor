<?php 

createUser();

?>





<!-- to upload image the attribute enctype is needed on the form, it's sending different form data. -->
<form action=""  method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">First name</label>
    <input type="text" class="form-control" name="first-name"> 
</div>

<div class="form-group">
    <label for="post-status">Last name</label>
    <input type="text" class="form-control" name="last-name"> 
</div>


<div class="form-group">
    <label for="user-role">User type </label>
    <select name="user-role" id="user-role">
        <option value="user">user</option>  
        <option value="admin">admin</option>                
                     
    </select>
</div>

 <div class="form-group">
    <label for="user-image">User image</label>
    <input type="file" name="image"> 
</div> 

<div class="form-group">
    <label for="post-tags">Username</label>
    <input type="text" class="form-control" name="username"> 
</div>

<div class="form-group">
    <label for="post-content">Email</label>
    <input type="email" class="form-control" name="email"> 
</div>


<div class="form-group">
    <label for="post-content">Password</label>
    <input type="password" class="form-control" name="password"> 
</div>


<div class="form-group">
    <input class="btn orangebtn" type="submit" name="create-user" value="Create user"> 
</div>


</form>