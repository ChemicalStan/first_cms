<?php
//SELECT ID
if(isset($_GET['edit'])){
$edit_id= $_GET['edit'];
    
    $query = "SELECT * FROM posts WHERE post_id ={$edit_id}";
    $edit_query =mysqli_query($connection, $query);
    if(!$edit_query){
    die(mysqli_error($connection));
    }
}
//    DISPLAY VALUES

while($row=mysqli_fetch_assoc($edit_query)){
$id = $row['post_id'];
 $post_author = $row['post_author'];
 $post_user = $row['post_user'];
    $title = $row['post_title'];
    $category_id = $row['post_category_id'];
    $status = $row['post_status'];
    $image = $row['post_image'];
    $tags = $row['post_tags'];
    $post_content = $row['post_content'];
    $date = $row['post_date']; ?>

<?php

                //UPDATE POST QUERY
if(isset($_POST["update_post"])){
    $post_title = $_POST['post_title'];
    $post_user = $_POST['post_user'];
   $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_tmp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 4;
    move_uploaded_file($post_image_tmp,"../images/$post_image");
    
    $post_title = mysqli_real_escape_string($connection, $post_title);
    $post_user = mysqli_real_escape_string($connection, $post_user);
    $post_status = mysqli_real_escape_string($connection, $post_status);
    $post_tags = mysqli_real_escape_string($connection, $post_tags);
    $post_content = mysqli_real_escape_string($connection, $post_content);
    
    if(empty($post_title || $post_user || $post_content)){
    echo "<h1>THIS FIELDS CANNOT BE EMPTY</h1>";
    } else {
    $query ="UPDATE posts SET post_title='$post_title',post_user='$post_user',post_category_id=$post_category_id,post_status='$post_status',post_tags='$post_tags',post_content='$post_content',post_date=now(),post_comment_count=$post_comment_count,post_image='$post_image' "; 
$query .="WHERE post_id={$edit_id}";
    $post_query = mysqli_query($connection, $query);
        
        echo "<p class='bg-success'>Update Successful <a href='../post.php?post_id={$edit_id}'>View Post</a> or <a href='./posts.php'>Edit More Posts</a></p>" ;
  

    if(!$post_query){
    die(mysqli_error($connection));
    }
}
}
?>
 <form action="" method="post" enctype="multipart/form-data">
       <div class="form-group">
        <label for="title">POST TITLE</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $title?>">
</div>  
      
       <div class="form-group">
<label for="category">CATEGORIES</label>
<select name="post_category_id" id="">
<?php
//    default category query
$query1="SELECT * FROM categories WHERE cat_id = $category_id";
$select_categories =mysqli_query($connection, $query1);

while($row=mysqli_fetch_assoc($select_categories)){
$cat1_id = $row['cat_id'];
$cat1_title = $row['cat_title'];
echo "<option value='{$cat1_id}'>{$cat1_title}</option>";}
    
    // remaining category query
    $query2= "SELECT * FROM categories WHERE cat_id != $category_id";
    $select_categories =mysqli_query($connection, $query2);
while($row=mysqli_fetch_assoc($select_categories)){
$cat2_id = $row['cat_id'];
$cat2_title = $row['cat_title'];
    echo "<option value='{$cat2_id}'>{$cat2_title}</option>";}

?>
</select>
</div>
      
       <div class="form-group">
         <label for="user">POST USER</label>
    <select name="post_user" id="">
                   <?php 
    
   //DISPLAY POST user QUERY
$query = "SELECT * FROM users";
$post_user_select_query = mysqli_query($connection, $query);
if(!$post_user_select_query){die(mysqli_error);}
    
    // DEFAULT POST USERS 
    if(!empty($post_author)){
echo "<option value='$post_auhtor'>$post_author</option>";
    }elseif(!empty($post_user)){
echo "<option value='$post_user'>$post_user</option>";   
}
        
while ($row = mysqli_fetch_assoc($post_user_select_query)){
$user_id = $row['user_id'];
$username= $row['username'];
    
    if(!empty($post_user) || !empty($post_author)){
echo "<option value='$username'>$username</option>";   
}
}
                    ?> 
                </select>
</div>
       <div class="form-group">
      <label for="post_status">POST STATUS</label> 
        <select name="post_status" id="">
         
    <?php
    echo "<option value='$status'>$status</option>";
    if($status=='Draft'){
    echo     "<option value='Published'>Published</option>";
    }else{
    echo    "<option value='Draft'>Draft</option>";
    }
    ?>
        </select>
</div>
       <div class="form-group">
        <label for="post_image">POST IMAGE</label>
        <img width="100" src="../images/<?php echo $image?>" alt="">
        <input type="file" name="image">
</div>
       <div class="form-group">
        <label for="post_tags">POST TAGS</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $tags?>">
                </div>
<div class="form-group">
        <label for="post_content">POST CONTENT</label>
        <textarea type="text" class="form-control" name="post_content" id="" cols="30" row="10"><?php echo str_replace('\r\n', '</br>', $post_content);?></textarea>
</div>
       <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
        
    </div>
</form>
<?php } ?>

