<table class="table table-bordered table-hover">
                       <thead>
                           <tr>
                               <th>Id</th>
                               <th>Username</th>
                               <th>Firstname</th>
                               <th>Lastname</th>
                               <th>Email</th>
                               <th>Role</th>
                               <th>Admin</th>
                               <th>Subscriber</th>
                               <th>Edit</th>
                               <th>Delete</th>                               
                           </tr>
                       </thead>
                       <tbody>
                        
                         
                          <?php



                        //    DISPLAY USER QUERY                       
        $query = "SELECT * FROM users";   
$display_user_query = mysqli_query ($connection ,$query);

if(!$display_user_query){die(mysqli_error($connection));}

while($row= mysqli_fetch_assoc($display_user_query)){

    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
     $user_role = $row['user_role'];

   
echo "<tr>";
echo "<td>$user_id</td>";
echo "<td>$username</td>";
echo "<td>$user_firstname</td>";
echo "<td>$user_lastname</td>";
echo "<td>$user_email</td>";


    echo "<td>$user_role</td>";
echo "<td><a href='./users.php?switch_to_admin={$user_id}'>Admin</a>";
echo "<td><a href='./users.php?switch_to_subscriber={$user_id}'>Subscriber</a></td>";  
echo "<td><a href='./users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>"; 
echo "<td><a onclick=\"javascript: return confirm('Are You Sure You Want To Delete This User?');\" href='./users.php?del_user={$user_id}'>Delete</a></td>";  
echo "</tr>";

}
//       APPROVE AND UNAPPROVE COMMENTS

if (isset($_GET['switch_to_admin'])){
$the_user_id=escape($_GET['switch_to_admin']);
    $query = "UPDATE users SET user_role='Admin' WHERE user_id=$the_user_id"; 
    $admin_user_query = mysqli_query($connection, $query);
    header('location:users.php');
    if(!$admin_user_query){die(mysqli_error($connection));}
}

if (isset($_GET['switch_to_subscriber'])){
$the_user_id=escape($_GET['switch_to_subscriber']);
    $query = "UPDATE users SET user_role='Subscriber' WHERE user_id=$the_user_id"; 
    $user_subscriber_query = mysqli_query($connection, $query);
    header('location:users.php');
    if(!$user_subscriber_query){die(mysqli_error($connection));}   
}



//DELETE USERS

if (isset($_GET['del_user'])){
    
    if(isset($_SESSION['user_role'])){
        
        if($_SESSION['user_role'] =='Admin'){
    $delete_user_id=mysqli_real_escape_string($connection, $_GET['del_user']);

            
    $query = "DELETE FROM users WHERE user_id=$delete_user_id"; 
    $delete_user_query = mysqli_query($connection, $query);
    header('location:users.php');
    if(!$delete_user_query){die(mysqli_error($connection));}
    
}

}
    }

                           ?>
                         
                          
                          
                       </tbody>
                   </table>
            