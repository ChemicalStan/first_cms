<?php include"includes/admin_header.php";?>
   

    <?php   

//SELF MADE, REAL IN VIDEO 159  ECHO PROFILE QUERY

    if(isset($_SESSION['username'])){
   $username = $_SESSION['username'];
        
$query = "SELECT * FROM users WHERE username = '{$username}'";   
$display_user_profile_query = mysqli_query ($connection ,$query);

if(!$display_user_profile_query){die(mysqli_error($connection));}

while($row= mysqli_fetch_assoc($display_user_profile_query)){

    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
     $user_role = $row['user_role'];

        
}
    }


//   UPDATE PROFILE QUERY
if(isset($_POST['update_profile'])){
    
    
     $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
   $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
    
    
$query = "UPDATE users SET user_firstname='$user_firstname',user_lastname='$user_lastname',username='$username',user_password='$user_password',user_email='$user_email',user_role='$user_role' WHERE user_id =$user_id "; 

  $update_user_profile_query = mysqli_query ($connection ,$query);
  
    
    if(!$update_user_profile_query){die(mysqli_error($connection));}
    
    
    
header("Location: users.php?source=view_all_users");
}


?>
   
   
   
    <div id="wrapper">
        <!-- Navigation -->
        <?php include"includes/admin_navigation.php";?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small>Author : CHEMICAL STAN</small>
                        </h1>
          <div class="container">  
                  <div class="col-xs-12">       
                   
                   
                    <form action="" method="post" enctype="multipart/form-data">
    
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
                   
                   <option value="Subscriber"><?php echo $user_role; ?></option>
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
        <label for="post_status">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
<!--
</div>
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
        <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
        
    </div>
</form>

                   
                   
                   
                   
                   
                    </div>
                    </div>
                     </div>
<!--                     view category-->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
<?php include"includes/admin_footer.php";?>

