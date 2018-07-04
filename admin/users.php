<?php include"includes/admin_header.php";?>
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
                   
                   <?php
                   if(isset($_GET['source'])){
                   
                    $source= $_GET['source'];  
                       
                       if($source=='add_user'){
                    include "includes/add_user.php";  }
                       elseif($source=='edit_user'){
                            include "includes/edit_user.php";}
                           elseif($source=='view_all_users'){
                            include "includes/view_all_users.php"; }
                   }
else{include "includes/view_all_users.php"; }
             
//include "includes/view_all_posts.php";
                      ?>
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

