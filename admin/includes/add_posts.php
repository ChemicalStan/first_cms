<?php
   //CREATE POST QUERY.

if(isset($_POST["create_post"])){
    
 
    $post_title = $_POST['post_title'];
    $post_user = $_POST['post_user'];
   $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_tmp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    move_uploaded_file($post_image_tmp,"../images/$post_image");
    
    $post_title = mysqli_real_escape_string($connection, $post_title);
    $post_user = mysqli_real_escape_string($connection, $post_user);
    $post_status = mysqli_real_escape_string($connection, $post_status);
    $post_tags = mysqli_real_escape_string($connection, $post_tags);
    $post_content = mysqli_real_escape_string($connection, $post_content);
    
    if(empty($post_title || $post_author || $post_content)){
    echo "<h1>THIS FIELDS CANNOT BE EMPTY</h1>";
    } else {
    
    $query = "INSERT INTO posts (post_title,post_user,post_category_id,post_status,post_tags,post_content,post_date,post_image) "; 
    $query .="VALUES ('{$post_title}','{$post_user}',{$post_category_id},'{$post_status}','{$post_tags}','{$post_content}',now(),'{$post_image}')";
    
    $post_query = mysqli_query($connection, $query);
     
      $new_post_id = mysqli_insert_id($connection);
        
        //header("location: posts.php");
    
    if(!$post_query){
    die(mysqli_error($connection));
    }
    
         echo "<p class='bg-success'>Post Added <a href='../post.php?post_id={$new_post_id}'>View Post</a> or <a href='./posts.php'>Edit More Posts</a></p>" ;
}}

?>
   
   
   

   <form action="" method="post" enctype="multipart/form-data">
    
       <div class="form-group">
        <label for="title">POST TITLE</label>
        <input type="text" class="form-control" name="post_title">
</div>
       <div class="form-group">
               <label for="category">CATEGORY:</label>
                <select name="post_category_id" id="">
                   <?php 
   //DISPLAY CATEGORY QUERY
                    $query = "SELECT * FROM categories";
$post_category_id_select_query = mysqli_query($connection, $query);
if(!$post_category_id_select_query){die(mysqli_error);}

while ($row = mysqli_fetch_assoc($post_category_id_select_query)){
$post_cat_id = $row['cat_id'];
$post_cat_title = $row['cat_title'];
echo "<option value='$post_cat_id'>$post_cat_title</option>";   
}                   ?> 
                </select>
         </div>
         
          <div class="form-group">
               <label for="author">POST USER</label>
                <select name="post_user" id="">
                   <?php 
   //DISPLAY POST AUTHOR QUERY

$query = "SELECT * FROM users";
$post_user_select_query = mysqli_query($connection, $query);
if(!$post_user_select_query){die(mysqli_error);}

while ($row = mysqli_fetch_assoc($post_user_select_query)){
$author_id = $row['user_id'];
$username= $row['username'];
echo "<option value='$username'>$username</option>";   
}                   ?> 
                </select>
         </div>
<!--
       <div class="form-group">
        <label for="post_author">POST AUTHOR</label>
        <input type="text" class="form-control" name="post_author">
</div>
-->
       <div class="form-group">  
       <label for="post_status">POST STATUS:</label>      
        <select name="post_status" id="">
        <?php
           echo "<option value='Draft'>Select Options</option>";
         echo "<option value='Published'>Published</option>";
            echo "<option value='Draft'>Draft</option>";
           ?>
                </select>
</div>
       <div class="form-group">
        <label for="post_image">POST IMAGE</label>
        <input type="file" name="image">
</div>
       <div class="form-group">
        <label for="post_tags">POST TAGS</label>
        <input type="text" class="form-control" name="post_tags">
                </div>
<div class="form-group">
        <label for="post_content">POST CONTENT</label>
        <textarea type="text" class="form-control" name="post_content" id="" cols="30" row="10"></textarea></textarea>
</div>
       <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>