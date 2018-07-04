<?php include"includes/header.php"; ?>
    
    <?php
    // Comming From Form Below
if($_SERVER['REQUEST_METHOD'] == "POST"){

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

$error = ['username'=>'', 'email'=>'', 'password'=>''];
  
  if(strlen($username) < 4){
   $error['username'] = 'Username Must Be More Than 4 Characters!';
  }

  if(empty($username)){
    $error['username'] = 'Username Cannot Be Empty!';
  }

  if(user_exists($username)){
    $error['username'] = 'Username Already Exists!';
  }

if(empty($email)){
    $error['email'] = 'Email Cannot Be Empty!';
  }

  if(email_exists($email)){
    $error['email'] = 'Email Already Exists, <a href="index.php">Login Here</a>';
  }

 if(empty($password)){
    $error['password'] = 'Password Cannot Be Empty!';
  }

foreach ($error as $key => $value) {
 if (empty($value)) {
     unset($error[$key]);
 }
} //foreach end

if (empty($error)) {
    register_user($username,$email,$password);
    login_user($username,$password);
}

} //if isset end

?>
    <!-- Navigation -->
  <?php include"includes/navigation.php"; ?>
    <!--   page content-->
    <div class="container">
<section id="login">   
        <div class="container">
        <div class="row">    
			<div class="col-xs-6  col-xs-offset-3">
               <div class="form-wrap">  
               
                <h1>Register</h1>

            <!-- Registration Form -->
                
			    <form role="form" action="registration.php" id="login-form" autocomplete="off" method="POST">
					<div class="form-group">
						<label for="username" class="sr-only">Username</label>
                        <p class="bg-warning"><?php echo isset($error['username']) ? $error['username'] : '';?></p>
						<input type="text" class="form-control" name="username"  id="username" placeholder="Enter Desired Username" autocomplete="on" value="<?php echo isset($username) ? $username : ''?>">
					</div>
					<div class="form-group">
<label for="email" class="sr-only">Email</label>
<p class="bg-warning"><?php echo isset($error['email']) ? $error['email'] : '';?></p>
						<input  type="email" class="form-control" name="email" id="email" placeholder="example@email.com" autocomplete="on" value="<?php echo isset($email) ? $email : ''?>">
					</div>
<div class="form-group">
<label for="password" class="sr-only">Password</label>
<p class="bg-warning"><?php echo isset($error['password']) ? $error['password'] : ''?></p>
<input  type="password" class="form-control" name="password" id="key" placeholder="Password">
</div>
					
<input type="submit" name="submit" id="btn-login" class="btn btn-success btn-lg btn-block" value="Register">
					 </form>
					   </div>
					 </div>
			      </div>  <!-- row end-->
            </div>  <!-- container close-->
    	 </section>
	</div>
    <?php include "includes/footer.php";?>