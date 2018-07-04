<?php include"includes/header.php"; ?>
    
    <?php
if(isset($_POST['submit'])){
$to        ='chemicalstan15@gmail.com';
$subject   = wordwrap($_POST['subject'], 70);
$content   = $_POST['content'];
$header    = "From: " . $_POST['email'];    

mail($to,$subject,$content,$header);
    
}
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
               
                <h1>Contact</h1>
			    <form role="form" action="contact.php" id="login-form" autocomplete="off" method="POST">
			    
<div class="form-group">
    <label for="email" class="sr-only">Email</label>
    <input  type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address">
</div>

<div class="form-group">
    <label for="subject" class="sr-only">Subject</label>
    <input type="text" class="form-control" name="subject"  id="subject" placeholder="Enter Subject">
</div>

<div class="form-group">
<textarea class="form-control" name="content" id="content" cols="50" rows="10"></textarea>
</div>			

<input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Submit">
					
					 </form>
					   </div>
					 </div>
			      </div>  <!-- row end-->
            </div>  <!-- container close-->
    	 </section>
	</div>
    
    <?php include "includes/footer.php";?>