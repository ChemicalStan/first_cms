
             <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/CMS/">CMS Home Page</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                
<?php

$query="SELECT * FROM categories";
$select_all_categories_query=mysqli_query($connection, $query);

while($row=mysqli_fetch_assoc($select_all_categories_query)){

$cat_title=$row['cat_title'];
$cat_id=$row['cat_id'];
echo "<li><a href='/cms/category/$cat_id'>$cat_title</a></li>";}
?>
                 
<li>
<a href="/cms/admin" >Admin</a>
</li>
<li>
<a href="/cms/registration" >Register</a>
</li>
<li>
<a href="/cms/contact" >Contact</a>
</li>
      
<?php
if(isset($_SESSION['user_role'])){

    if(isset($_GET['post_id'])){
   echo $edit_post_id=$_GET['post_id'];
                             
    echo "<li><a href='/cms/admin/posts.php?source=edit_posts&edit={$edit_post_id}'>Edit Post</a></li>";
        
    }                       
}                      
                    ?>                   
                         
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>