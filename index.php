<?php include"includes/header.php"; ?>

    <!-- Navigation -->
    
  <?php include"includes/navigation.php"; ?>
   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            <div class="col-md-8">
                     
                         <?php

$per_page = 6;
//change page

if (isset($_GET['page'])){
$page = $_GET['page'];
    
}else{
    
$page = "";
    
}

if($page == "" || $page == 1){
$count_from = 0; 
}else{

$count_from = ($page * $per_page) - $per_page;
}

//  count posts query

if(isset($_SESSION['user_role'])){
$user_role=$_SESSION['user_role'];}else{$user_role = '';}

if($user_role == "Admin"){
$query="SELECT * FROM posts";
}elseif($user_role == "Subscriber"){
$query="SELECT * FROM posts WHERE post_status = 'Published'";
}else{
$query="SELECT * FROM posts WHERE post_status = 'Published'";} //stop

$count_post_query = mysqli_query($connection,$query);
$count_posts = mysqli_num_rows($count_post_query);

$count = ceil($count_posts / $per_page);

                //DISPLAY POST ON HOME PAGE QUERY   
//DISPLAY POSTS BY USER ROLE start
   if($user_role == "Admin" ){
$query="SELECT * FROM posts ORDER BY post_id DESC LIMIT $count_from, $per_page";
      $select_all_posts_query=mysqli_query($connection, $query);
       }elseif($user_role == "Subscriber"){
   $query="SELECT * FROM posts WHERE post_status = 'Published' ORDER BY post_id DESC LIMIT $count_from, $per_page";
      $select_all_posts_query=mysqli_query($connection, $query);
   }else{
   $query="SELECT * FROM posts WHERE post_status = 'Published' ORDER BY post_id DESC LIMIT $count_from, $per_page";
      $select_all_posts_query=mysqli_query($connection, $query);
   } //stop
           
while($row=mysqli_fetch_assoc($select_all_posts_query)){

    $post_id=$row['post_id'];
    $post_title=$row['post_title'];
    $post_author = $row['post_author'];
    $post_user = $row['post_user'];
    $post_date=$row['post_date'];
    $post_content=substr($row['post_content'],0,150);
    $post_image=$row['post_image'];
    $post_status = $row['post_status'];
    
?>
             <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post/<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
        by <a href="/cms/author_posts.php?post_author=<?php echo $post_author;?>&post_id=<?php echo $post_id; ?>&post_user=<?php echo $post_user; ?>"><?php
                                   
    if(!empty($post_author)){                   
    echo $post_author;}elseif(!empty($post_user)){
    echo $post_user;}
                    
                    ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?post_id=<?php echo $post_id;?>">
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
               </a>
                 <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
             <?php  /*}*/   }
                ?>
                                <ul class="pager">
           <?php
           for($i=1; $i<= $count; $i++){
               
   if($i == $page){


   echo "<li><a class= 'active_link' href='index.php?page={$i}'>{$i}</a></li> ";


   }else{
   echo "<li><a href='index.php?page={$i}'>{$i}</a></li> ";
   }
               
           
           }
          ?> 
       </ul>
                              <hr>
                               
                                </div>


            <!-- Blog Sidebar Widgets Column -->
      
        
        <?php include"includes/sidebar.php"; ?>
        <hr>


        </div>
        <!-- /.row -->

      
       

        <!-- Footer -->
      
    
<?php include"includes/footer.php"; ?>
