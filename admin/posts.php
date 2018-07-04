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
//   RESET VIEW COUNT QUERY.

    if(isset($_GET['reset_view_count'])){
    
    $reset_view_count=$_GET['reset_view_count'];
        
    $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = {$reset_view_count}";
    $reset_view_query = mysqli_query($connection, $query);
    
        if(!$reset_view_query){die(mysqli_error($connection));}
    
    
    }
                      
                      
                      
                      ?>
                                  
                   
                   <?php
                   if(isset($_GET['source'])){
                   
                    $source= $_GET['source'];  
                       
                       if($source=='add_posts'){
                    include "includes/add_posts.php";  }
                       elseif($source=='edit_posts'){
                            include "includes/edit_posts.php";}
                           elseif($source=='view_all_posts'){
                            include "includes/view_all_posts.php"; }
                   }
else{include "includes/view_all_posts.php"; }
             
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

