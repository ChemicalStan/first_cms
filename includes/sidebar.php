      <div class="col-md-4">
                
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    
                    <form action="search.php" method="post"> <!-- form -->
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>

               
               
                  <!-- BLOG LOGIN -->
                  <?php
          if(isset($_SESSION['username'])){
         $username= $_SESSION['username'];
         $user_firstname= $_SESSION['firstname'];
         if(!empty($user_firstname)){
          $message = 'Welcome ' . $user_firstname . '.'; 
          }else{
                      $message = 'Welcome ' . $username . '.'; 

          } 
          }else{
          $message = "LOGIN";
          }
          
          ?>
                  
                <div class="well">
                    <h4><?php echo $message;?></h4>
                    
                    <form action="includes/login.php" method="post">  
                    <!--login form -->
                    <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="input-group">
                        <input name="password" type="password" class="form-control" placeholder="Enter Password">
                          <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" name="login">Login</button>
                        </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>
               
               
               
               
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                           
                            <ul class="list-unstyled">
<?php

$query="SELECT * FROM categories";
$select_categories_sidebar =mysqli_query($connection, $query);

while($row=mysqli_fetch_assoc($select_categories_sidebar)){

$cat_title=$row['cat_title'];
$cat_id=$row['cat_id'];
echo "<li><a href='category.php?cat_id=$cat_id'>$cat_title</a></li>";
}


?>
                
                            </ul>
                    
                                        </div>
                     
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
            
            <?php include "widget.php"; ?>
            
            </div>