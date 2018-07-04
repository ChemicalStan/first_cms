<table class="table table-bordered table-hover">
                       <thead>
                           <tr>
                               <th>Id</th>
                               <th>Author</th>
                               <th>Comment</th>
                               <th>Email</th>
                               <th>Status</th>
                               <th>In Response To</th>
                               <th>Date</th>
                               <th>Approve</th>
                               <th>Unapprove</th>
                               <th>Delete</th>
                           </tr>
                       </thead>
                       <tbody>
                          <?php

        $query = "SELECT * FROM comment ORDER BY comment_id DESC ";  
// // AUTO DELETE 
//if(comment_post_id = ''){
//
//$query= "DELETE FROM comment WHERE comment_post_id = '' ";
//    $auto_delete_que
//
//}

$comments_table_query = mysqli_query ($connection ,$query);

if(!$comments_table_query){die(mysqli_error($connection));}

while($row= mysqli_fetch_assoc($comments_table_query)){

    $comment_id = $row['comment_id'];
    $comment_post_id = $row['comment_post_id'];
    $comment_author = $row['comment_author'];
    $comment_content = $row['comment_content'];
    $comment_email = $row['comment_email'];
    $comment_status = $row['comment_status'];
    $comment_date = $row['comment_date'];

   
echo "<tr>";
echo "<td>$comment_id</td>";
echo "<td>$comment_author</td>";
echo "<td>$comment_content</td>";
echo "<td>$comment_email</td>";
echo "<td>$comment_status</td>";
    
//    comment_post_title_query.
       $query="SELECT * FROM posts WHERE post_id =$comment_post_id";
$in_respose_to_query =mysqli_query($connection, $query);
 while ($row=mysqli_fetch_assoc($in_respose_to_query)){
 $comment_post_title=$row['post_title'];
 $comment_post_id=$row['post_id'];
 echo "<td><a href='../post.php?post_id=$comment_post_id;'>$comment_post_title</a></td>";
 }

    echo "<td>$comment_date</td>";
echo "<td><a class='btn btn-warning' href='./comments.php?approve=$comment_id'>Approve</a>";
echo "<td><a class='btn btn-warning' href='./comments.php?unapprove=$comment_id'>Unapprove</a></td>";    
// echo "<td><a href='./comments.php?del_comment=$comment_id'>delete</a></td>";  
?>
<form method="post">
  
<input type="hidden" name="comment_id" value="<?php echo $comment_id;?>">
 <?php 
echo "<td><input class='btn btn-danger' type='submit' name='del_comment' value='Delete'></td>";
 ?>
</form>
<?php

echo "</tr>";

}
//       APPROVE AND UNAPPROVE COMMENTS

if (isset($_GET['approve'])){
$comment_id=$_GET['approve'];
    $query = "UPDATE comment SET comment_status='Approved' WHERE comment_id=$comment_id"; 
    $approve_comment_query = mysqli_query($connection, $query);
    header('location:comments.php');
    if(!$approve_comment_query){die(mysqli_error($connection));}
}

if (isset($_GET['unapprove'])){
$comment_id=$_GET['unapprove'];
    $query = "UPDATE comment SET comment_status='Unapproved' WHERE comment_id=$comment_id"; 
    $unapprove_comment_query = mysqli_query($connection, $query);
    header('location:comments.php');
    if(!$unapprove_comment_query){die(mysqli_error($connection));}   
}



//DELETE COMMENTS

if (isset($_POST['del_comment'])){
$delete_comment_id=escape($_POST['comment_id']);
    
    $query = "DELETE FROM comment WHERE comment_id=$delete_comment_id"; 
    $delete_comment_query = mysqli_query($connection, $query);
    redirect("comments.php");
confirmQuery($delete_comment_query);    
}

                           ?>
                       </tbody>
                   </table>
            