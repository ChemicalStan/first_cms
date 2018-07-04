<?php include"includes/admin_header.php";?>
    <div id="wrapper">
       
       <?php 

$session= session_id();
$time = time();
$time_out_in_seconds = 10;
$time_out = $time - $time_out_in_seconds;

$query = "SELECT * FROM users_online WHERE session ='$session'";

$send_query = mysqli_query($connection, $query);
$count = mysqli_num_rows($send_query);


if ($count == NULL) {
 $new_user= mysqli_query($connection, "INSERT INTO users_online (session, time) VALUES ('$session', '$time')");
    if(!$new_user){die(mysqli_error($connection));}
    
}else{
    mysqli_query($connection,"UPDATE users_online SET time = '$time' WHERE session = '$session' ");

}

$users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");

$count_users = mysqli_num_rows($users_online_query);

 ?>
        <!-- Navigation -->
        <?php include"includes/admin_navigation.php";?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
        <h1 class="page-header">
          <?php echo $_SESSION['firstname'] . ' '; ?>Welcome To Admin
            <small>Author:ChemicalStan.</small>
        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
               
<!--                    POSTS COUNT QUERY USING FUNCTIONS-->
 <div class='huge'><?php echo $count_posts = recordCount('posts');?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
<!--                    COMMENT COUNT USING FUNCTIONS-->
<div class='huge'><?php echo $count_comments = recordCount('comment');?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                   
<!--                                USERS COUNT QUERY-->
   <div class='huge'><?php echo $count_users = recordCount('users');?></div>
                      
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
            
<!--         CATEGORIES COUNT QUERY using function-->

<div class='huge'><?php echo $count_categories = recordCount('categories');?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
                <?php
//                Published post query using functions
  $count_published_posts = checkStatus('posts','post_status', 'Published') ;

//                draft post query using functions
    $count_draft_posts = checkStatus('posts', 'post_status', 'Draft');

//  unappronved comments query using functions
$count_unapproved_comments = checkStatus('comment', 'comment_status', 'Unapproved');

//     draft post query using functions
    $count_Subscribers = checkStatus('users', 'user_role', 'Subscriber');;
                
                ?>
                <div class="row">
<!--                    CHART .JAVASCRIPT-->
                   <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
            
            <?php

$element_text = ['All Posts','Active Posts', 'Draft Posts', 'Comments','Unapproved Comments','Users','Subscribers','Categories'];
$element_count = [$count_posts,$count_published_posts,$count_draft_posts, $count_comments,$count_unapproved_comments,$count_users,$count_Subscribers,$count_categories];


for($i=0; $i<8 ; $i++){

echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";

}
            ?>
            
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>  
                    
                    
<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>         
                    
                    
                </div>
                

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
<?php include"includes/admin_footer.php";?>
