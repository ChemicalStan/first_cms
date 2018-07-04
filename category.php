<?php include"includes/header.php"; ?>

    <!-- Navigation -->
    
  <?php include"includes/navigation.php"; ?>
   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            <div class="col-md-8">

                         <?php
// DISPLAYING CAT USING PREPARED STATEMENT

if (isset($_GET['cat_id'])){
$post_category_id= $_GET['cat_id'];
}
 if(isset($_SESSION['user_role'])){
$user_role = $_SESSION['user_role'];
 }else{$user_role = '';}

if ($user_role == 'Admin'){
    $stmt1= mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_user, post_date, post_content, post_image FROM posts WHERE post_category_id= ? ORDER BY post_id DESC");
}else{
    $stmt2=mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_user, post_date, post_content, post_image FROM posts WHERE post_category_id= ? AND post_status = ? ORDER BY post_id DESC");

$published = 'Published';
}

if (isset($stmt1)){
    
    mysqli_stmt_bind_param($stmt1, "i", $post_category_id);
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_user, $post_date, $post_content, $post_image );
    $stmt= $stmt1;
}else{
    mysqli_stmt_bind_param($stmt2, "is", $post_category_id, $published);
mysqli_stmt_execute($stmt2);
mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_author ,$post_user, $post_date, $post_content, $post_image);
$stmt= $stmt2;
}


$count = mysqli_stmt_num_rows($stmt);

if(empty($count)){
    echo "<h1 class='text-center'>NO POST FOUND</h1>";
}
           
while(mysqli_stmt_fetch($stmt)):

?>
                    
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?post_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by
<a href="/cms/author_posts.php?post_author=<?php echo $post_author;?>&post_id=<?php echo $post_id; ?>&post_user=<?php echo $post_user; ?>"><?php
                                   
    if(!empty($post_author)){                   
    echo $post_author;}elseif(!empty($post_user)){
    echo $post_user;}
                    ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="/cms/images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

             <?php  endwhile; mysqli_stmt_close($stmt);  ?>
                                </div>


            <!-- Blog Sidebar Widgets Column -->
      
        
        <?php include"includes/sidebar.php"; ?>


        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
      
    
<?php include"includes/footer.php"; ?>
