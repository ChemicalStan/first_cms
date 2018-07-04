<?php
if(isset($_GET['edit_user'])){
$edit_user_id=escape($_GET['edit_user']);
    
     $query = "SELECT * FROM users WHERE user_id ={$edit_user_id}";   
$display_user_query = mysqli_query ($connection ,$query);

if(!$display_user_query){die(mysqli_error($connection));}

while($row= mysqli_fetch_assoc($display_user_query)){

    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
}
}
?>
           <?php    
                    //EDIT USER QUERY

    if(isset($_POST["edit_user"])){
    $wrong_password = "";
    $massage = "";
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $old_user_password = $_POST['old_user_password'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

        // VALIDATION QUERY
 
$user_firstname=mysqli_real_escape_string($connection, $user_firstname);
$user_lastname=mysqli_real_escape_string($connection, $user_lastname);
$username=mysqli_real_escape_string($connection, $username);
$user_password=mysqli_real_escape_string($connection, $user_password);
$old_user_password=mysqli_real_escape_string($connection, $old_user_password);
$user_email=mysqli_real_escape_string($connection, $user_email);

   //    CONFIRM PASSWORD BEFORE EDIT
        
        if(!empty($old_user_password)){
    $query="SELECT user_password FROM users WHERE user_id ={$edit_user_id} ";  
    $get_password_query=mysqli_query($connection,$query);           
        //            tester
        if(!$get_password_query){die(mysqli_error($connection));}

$row= mysqli_fetch_assoc($get_password_query);
$db_user_password = $row['user_password'];
if(!password_verify($old_user_password,$db_user_password)){
$wrong_password = "<p class='bg-success'>Incorrect Old Password</p>";}else{
      $hash_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
                       
      $query = "UPDATE users SET user_firstname='$user_firstname',user_lastname='$user_lastname',username='$username',user_password='$hash_password',user_email='$user_email',user_role='$user_role' WHERE user_id =$edit_user_id "; 

      $update_user_query = mysqli_query($connection, $query);

      $massage = "Update succesful <a href='users.php' class='bg-success'>View Users</a>";

      //  tester
      if(!$update_user_query){
      die(mysqli_error($connection));
      }
  }
        }else{$wrong_password = "<p class='bg-success'>This Field Cannot Be Empty</p>";}
}else{$massage = "";
$wrong_password = "";}
?>                                      
   <!--   EDIT USER FORM-->
   <form action="" method="post" enctype="multipart/form-data">
    <?php echo $massage;?>
       <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
</div>
      <div class="form-group">
        <label for="post_author">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
</div>
      
       <div class="form-group">
        <label for="User Role"></label>
                <select name="user_role" id="">
                   
        <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
<!--                   USER ROLE QUERY-->
                   <?php  
                    if($user_role=='Admin'){
                echo "<option value='Subscriber'>Subscriber</option>";
                    }else{
                    echo "<option value='Admin'>Admin</option>"; 
                    }
                    ?>
                </select>
</div>
       <div class="form-group">
        <label for="post_author">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
</div>
      <div class="form-group">
        <label for="post_status">Enter Old Password</label>
        <?php echo $wrong_password;?>
        <input type="password" class="form-control" name="old_user_password">
</div>
      
       <div class="form-group">
        <label for="post_status">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
</div>
      
      <!--
       <div class="form-group">
        <label for="post_image">POST IMAGE</label>
        <input type="file" name="image">
</div>
-->
       <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
                </div>

       <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
        
    </div>
</form>