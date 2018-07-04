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

<!--                    add category-->
                     <div class="container">
                     <div class="col-xs-6">
                     
<!--                    create category -->
                      <?php
            insert_categories();
?>
                     
<!--                     creating form-->
                     <form action="" method="post">
                     <div class="form-group">
                     <label for="cat-title">Add Category</label>
                     
                     <input type="text" class="form-control" name="cat_title">
                     </div>
                     
                     <div class="form-group">         
    <input type="submit" class="btn btn-primary" value="Add Category" name="submit">                                                                                       
                     </div>
                     </form>
                     
<!--                     UPDATE AND INCLUDE -->
     
      <?php include "includes/update_categories.php";?>               
                     </div>
                     
     <div class="col-xs-6">
               <table class="table table-bordered table-hover">
                   <thead>
                      <tr>
                       <th>ID</th>
                       <th>Category Title</th>
                       <th>Edit</th>
                       <th>Delete</th>
                       </tr>
                   </thead>
                   <tbody>
                      
                                        <?php
          //DISPLAY CATEGORY FUNCTION
                 display_all_categories();   
                    ?>             
                    
   <?php
                    //DELETE DATA FUNCTION
delete_caategories();
?>                             
                   </tbody>
               </table>  
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

