<?php include "delete_modal.php";
if(isset($_POST['checkBoxArray'])){

    foreach($_POST['checkBoxArray'] as $checkBoxid){
    
    $bulk_options = $_POST['bulk_options'];
        
        switch($bulk_options){
        
case 'published':
$query = "UPDATE posts SET post_status ='Published' WHERE post_id = {$checkBoxid} ";
$setPublishedQuery = mysqli_query($connection, $query); 
break;
        
case 'draft':
    $query = "UPDATE posts SET post_status ='Draft' WHERE post_id = {$checkBoxid} ";
    $setDraftQuery = mysqli_query($connection, $query); 
    break;
            
case 'delete':
    $query = "DELETE FROM posts WHERE post_id = {$checkBoxid} ";
    $deleteQuery = mysqli_query($connection, $query); 
    break;
        
case 'clone':
    $query = "SELECT * FROM posts WHERE post_id = {$checkBoxid} ";
    $clone_Query = mysqli_query($connection, $query); 
            
        //tester
    if(!$clone_Query){
    die(mysqli_error($connection));
    }

//    DISPLAY VALUES

while($row=mysqli_fetch_assoc($clone_Query)){
    $post_author = $row['post_author'];
    $post_user = $row['post_user'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
    $post_date = $row['post_date'];

  } // while end
     
    $query = "INSERT INTO posts (post_title,post_author,post_user,post_category_id,post_status,post_tags,post_content,post_date,post_image) "; 
    $query .="VALUES ('{$post_title}','{$post_author}','{$post_user}',{$post_category_id},'{$post_status}','{$post_tags}','{$post_content}',now(),'{$post_image}')";
    
    $copy_query = mysqli_query($connection, $query);
//    tester
    if(!$copy_query){
    die(mysqli_error($connection));
    }
    break;
        
 }   // switch end
    
    } // foreach end

} //if end 
?>
<form action="" method="post">
<table class="table table-bordered table-hover">
                      
        <div id="bulkOptionContainer" class="col-xs-2">
<!--select options at table top-->
        <select name="bulk_options" id="" class="form-control">
        <option value="">Select Option</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
        </select>
        </div>
<!--            butons at table top         -->
    <div class="col-xs-4">
    <input type="submit" class="btn btn-success" name="submit" value="Apply">                
    <a href="./posts.php?source=add_posts" class="btn btn-primary">Add New</a>        
    </div>
    <br>
    <br>
                      
                       <thead>
                           <tr>
<th><input id="SelectAllCheckBoxes" type="checkbox"></th>
           <th>Id</th>
           <th>User</th>
           <th>Title</th>
           <th>Categories</th>
           <th>Status</th>
           <th>Image</th>
           <th>Tags</th>
           <th>Comment</th>
           <th>Views</th>
           <th>Date</th>
           <th>View Post</th>
           <th>Edit</th>
           <th>Delete</th>
                           </tr>
                       </thead>
                       <tbody>
                          <?php
//DELETE POSTS

if(isset($_POST['delete'])){
$delete_post_id = escape($_POST['post_id']);
    
    $query = "DELETE FROM posts WHERE post_id= {$delete_post_id}";
    
    $delete_query = mysqli_query($connection, $query);
    redirect("posts.php");
    
    confirmQuery($delete_query);
}


//    display post on admin query
//$query = "SELECT * FROM posts ORDER BY post_id DESC"; 
//joint table query


$query = "SELECT posts.post_id, posts.post_user, posts.post_author, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, posts.post_tags, posts.post_view_count, posts.post_date, ";
$query .="categories.cat_id,categories.cat_title FROM posts ";
$query .="LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";   


$post_table_query = mysqli_query ($connection ,$query);
if(!$post_table_query){die(mysqli_error);}
while($row= mysqli_fetch_assoc($post_table_query)){
        $id = escape($row['post_id']);
        $post_user = escape($row['post_user']);
        $author = escape($row['post_author']);
        $title = escape($row['post_title']);
        $category_id = escape($row['post_category_id']);
        $status = escape($row['post_status']);
        $image = escape($row['post_image']);
        $tags = escape($row['post_tags']);
        $post_view_count = escape($row['post_view_count']);
        $date = escape($row['post_date']);
        $category_id_title=escape($row['cat_title']);

echo "<tr>";
?>

<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $id; ?>'></td>

<?php
echo "<td>$id</td>";
    
// DISPLAY USER QUERY
if(!empty($author)){
echo "<td>$author</td>";
}elseif(!empty($post_user)){
echo "<td>$post_user</td>";
}else{
echo "<td>this shit failed</td>";
}

echo "<td>$title</td>";
    
//    display post category title query old.
//$query="SELECT * FROM categories WHERE cat_id =$category_id";
//$select_categories_to_display =mysqli_query($connection, $query);
//while ($row=mysqli_fetch_assoc($select_categories_to_display)){
//
//}
    
echo "<td>$category_id_title</td>";
echo "<td>$status</td>";
echo "<td> <img width='100' src='../images/$image' alt='image'></td>";
echo "<td>$tags</td>";
    
  //  COMMENT COUNT QUERY
$query = "SELECT * FROM comment WHERE comment_post_id = {$id}";    
$comment_count_query = mysqli_query($connection,$query);
$comment_count = mysqli_num_rows($comment_count_query);
echo "<td><a href='post_comments.php?id={$id}'>$comment_count</a></td>";
  //COMMENT COUNT END
    
echo "<td><a onClick=\"javascript: return confirm('Are You Sure You Want To Reset?');\" href='posts.php?reset_view_count={$id}'>$post_view_count</td></a>";
echo "<td>$date</td>"; 
echo "<td><a class='btn btn-warning' href='../post.php?post_id={$id}'>View Post</a>
";
echo "<td><a class='btn btn-info' href='posts.php?source=edit_posts&edit={$id}'>Edit</a>
";

// echo "<td><a rel='$id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";  

// echo "<td><a onClick=\"javascript: return confirm('Are You Sure You Want To Delete?');\" href='posts.php?delete={$id}'>Delete</a></td>";
?>
<form method="post">
  <input type="hidden" name="post_id" value="<?php echo $id;?>">
  <?php
 echo "<td><input class='btn btn-danger' type='submit' name='delete' value='Delete'></td>";
 ?>
</form>

<?php 
echo "</tr>";
}
                           ?>
                       </tbody>
                   </table>
            </form>
<!-- incomplete modal script -->
<!-- <script>
            $(document).ready(function(){

$(".delete_link").on('click', function(){

        var id= $(this).attr("rel");
alert(id);

});
            });

              </script>
 -->