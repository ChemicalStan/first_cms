                <!--   CREATE USER FORM-->
   
   <form action="" method="post" enctype="multipart/form-data">
    
       <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
</div>
      <div class="form-group">
        <label for="post_author">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
</div>
      
       <div class="form-group">
        <label for="User Role"></label>
                <select name="user_role" id="">
                   
                   <option value="Subscriber">Select Option</option>
                   <option value="Admin">Admin</option>
                   <option value="Subscriber">Subscriber</option>
                   
                </select>
</div>
       <div class="form-group">
        <label for="post_author">Username</label>
        <input type="text" class="form-control" name="username">
</div>
       <div class="form-group">
        <label for="post_status">Password</label>
        <input type="password" class="form-control" name="user_password">
</div>
<!--
       <div class="form-group">
        <label for="post_image">POST IMAGE</label>
        <input type="file" name="image">
</div>
-->
       <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" class="form-control" name="user_email">
                </div>

       <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
        
    </div>
</form>



<?php    
                    //CREATE USER QUERY

if(isset($_POST["create_user"])){
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
   $username = $_POST['username'];
    $user_password = $_POST['user_password'];
//    $post_image = $_FILES['image']['name'];
//    $post_image_tmp = $_FILES['image']['tmp_name'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
//    $post_date = date('d-m-y');
//    move_uploaded_file($post_image_tmp,"../images/$post_image");
    if(empty($user_firstname || $user_lastname || $user_email)){
    echo "<h1>THIS FIELDS CANNOT BE EMPTY</h1>";
    } else {
        //escaping
$username = mysqli_real_escape_string($connection,$username);        
$user_firstname = mysqli_real_escape_string($connection,$user_firstname);        
$user_lastname = mysqli_real_escape_string($connection,$user_lastname);        
$user_password = mysqli_real_escape_string($connection,$user_password);        
$user_email = mysqli_real_escape_string($connection,$user_email);      
                
$user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
        
    $query = "INSERT INTO users (user_firstname,user_lastname,username,user_password,user_email,user_role) "; 
    $query .="VALUES ('{$user_firstname}','{$user_lastname}','{$username}','{$user_password}','{$user_email}','{$user_role}')";
    $create_user_query = mysqli_query($connection, $query);
        header("location: users.php");
    
    if(!$create_user_query){
    die(mysqli_error($connection));
    }
    
}}

?>
   
   