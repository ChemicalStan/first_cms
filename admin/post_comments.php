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

if(isset($_GET['id'])){
    
    $the_post_id = $_GET['id'];

//DELETE COMMENTS

if (isset($_GET['del_comment'])){
    $the_post_id = $_GET['id'];
    
$delete_comment_id=$_GET['del_comment'];
    
    $query = "DELETE FROM comment WHERE comment_id=$delete_comment_id"; 
    $delete_comment_query = mysqli_query($connection, $query);
    header("location:post_comments.php?id=$the_post_id");
    if(!$delete_comment_query){die(mysqli_error($connection));}
    
}


  //DISPLAY COMMENTS
        $query = "SELECT * FROM comment WHERE comment_post_id=" . mysqli_real_escape_string($connection, $_GET['id']) . " ";  
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
echo "<td><a href='post_comments.php?approve=$comment_id&id=$the_post_id'>Approve</a>";
echo "<td><a href='post_comments.php?unapprove=$comment_id&id=$the_post_id'>Unapprove</a></td>";    
echo "<td><a href='post_comments.php?del_comment=$comment_id&id=$the_post_id'>delete</a></td>";  
echo "</tr>";

}
//       APPROVE AND UNAPPROVE COMMENTS

if (isset($_GET['approve'])){
$comment_id=$_GET['approve'];
    $the_post_id = $_GET['id'];
    $query = "UPDATE comment SET comment_status='Approved' WHERE comment_id=$comment_id"; 
    $approve_comment_query = mysqli_query($connection, $query);
    header("Location:post_comments.php?id={$the_post_id}");
    if(!$approve_comment_query){die(mysqli_error($connection));}
}

if (isset($_GET['unapprove'])){
$comment_id=$_GET['unapprove'];
    $the_post_id = $_GET['id'];
    $query = "UPDATE comment SET comment_status='Unapproved' WHERE comment_id=$comment_id"; 
    $unapprove_comment_query = mysqli_query($connection, $query);
    header("Location:post_comments.php?id={$the_post_id}");
    if(!$unapprove_comment_query){die(mysqli_error($connection));}   
}
}
                           ?>
                       </tbody>
                   </table>
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