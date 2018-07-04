
                      <?php

//                       UPDATE DATA

if (isset($_GET['edit'])){
    
   $update_id = escape($_GET['edit']);
    
   $query = "SELECT * FROM categories WHERE cat_id ={$update_id}"; 
    
    $update_query = mysqli_query($connection, $query);
    
    if (!$update_query){
    die(mysqli_error($connection));
    
    }
    
    while($row = mysqli_fetch_assoc($update_query)){
    
       $update_cat_title = $row['cat_title']; ?>
        
                     <form action="" method="post">
                     <div class="form-group">
                     <label for="cat-title">Edit Category</label>
                     
                     <input type="text" class="form-control" name="update_cat_title" value="<?php echo $update_cat_title;?>">
                     </div>
                     
                     <div class="form-group">         
    <input type="submit" class="btn btn-primary" value="Update Category" name="update_category">                                                
                     </div>
                     </form>
    
    <?php
    
    }         } 
     ?>
    
    <?php      //UPDATE QUERY
    
    if(isset($_POST['update_category'])){
   $update_post_title = $_POST['update_cat_title'];
        if($update_post_title == "" || empty($update_post_title)){
    
    echo "This field cannot be empty";
    } else {
$stmt= mysqli_prepare($connection, "UPDATE categories SET cat_title= ? WHERE cat_id = ? ");
mysqli_stmt_bind_param($stmt, 'si',$update_post_title, $update_id);  
mysqli_stmt_execute($stmt);

        redirect("categories.php");
        
        confirmQuery($stmt);
        
    }mysqli_stmt_close($stmt);}
                       ?>