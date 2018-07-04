<?php
// redirect function
function redirect($location){
return header("Location:" . $location);
}
// real escape string function
function escape($string){
    global $connection;
return mysqli_real_escape_string($connection, trim($string));
}
// tester function
function confirmQuery($result){
global $connection;
if(!$result){ die(mysqli_error($connection));}
}
// show users online function
function users_online() {
     if (isset($_GET['onlineusers'])) {
 global $connection;
 if (!$connection) {
    session_start();
    include("../includes/db.php");

        $session= session_id();
        $time = time();
        $time_out_in_seconds = 30;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session ='$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);
        if ($count == NULL) {

        mysqli_query($connection, "INSERT INTO users_online (session, time) VALUES ('$session', '$time')");

        }else{
        mysqli_query($connection,"UPDATE users_online SET time = '$time' WHERE session = '$session' ");
        }

        $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
        echo $count_users = mysqli_num_rows($users_online_query);
    }

   } //get request end..

}
users_online();


function insert_categories(){
global $connection;

if(isset($_POST['submit'])){

  $cat_title= $_POST['cat_title']; 
    
    if($cat_title == "" || empty($cat_title)){
    
    echo "this field cannot be empty";
    } else {
    
$stmt = mysqli_prepare($connection, "INSERT INTO categories( cat_title ) VALUEs (?)");
  
  mysqli_stmt_bind_param($stmt, "s", $cat_title);  
   mysqli_stmt_execute($stmt); 

    confirmQuery($stmt);
    }    mysqli_stmt_close($stmt);

}
}

function display_all_categories(){
global $connection;
$query="SELECT * FROM categories";
      $select_categories =mysqli_query($connection, $query);
           
while($row=mysqli_fetch_assoc($select_categories)){

    $cat_id=$row['cat_id'];
    $cat_title=$row['cat_title'];
    
    
    echo "<tr>";
    echo "<td>$cat_id</td>";
    echo "<td>$cat_title</td>";
    echo "<td><a class='btn btn-info' href='categories.php?edit={$cat_id}'>Edit</a></td>";
    // echo "<td><a href='categories.php?delete={$cat_id}'>delete</a></td>";?>
<form method="post">
    <input type="hidden" name="cat_id" value="<?php echo $cat_id;?>">
    <?php
    echo "<td><input class='btn btn-danger' type='submit' name='delete' value='Delete'></td>";
?>
</form>



    <?php
    echo "</tr>";
}
}

function delete_caategories(){
global $connection ;
if(isset($_POST['delete'])){
    $the_cat_id = $_POST['cat_id'];
$query = "DELETE FROM categories WHERE cat_id ={$the_cat_id}";
    
$delete_query =mysqli_query($connection, $query);
    header("location: categories.php");
    
}
}
function recordCount($table){
    global $connection;
    $query = "SELECT * FROM " . $table;
    $select_table = mysqli_query($connection , $query);
    return mysqli_num_rows($select_table);
    
    confirmQuery($select_table);
}

// admin index function
function checkStatus($table, $column, $status){
    global $connection;
     $query = "SELECT * FROM $table WHERE $column ='$status'";
    $result= mysqli_query($connection , $query); 
    return mysqli_num_rows($result);
        confirmQuery($result);
}
// REGISTRATION: user exists function
function user_exists($username){
global $connection;
    $query= "SELECT username FROM users WHERE username = '$username'";
    $result= mysqli_query($connection,$query);
    confirmQuery($result);
        if (mysqli_num_rows($result) > 0) {
        return true;
        }else{
        return false;
        }
}
// REGISTRATION: EMAIL exists function
function email_exists($email){
global $connection;
    $query= "SELECT user_email FROM users WHERE user_email='$email'";
    $result= mysqli_query($connection,$query);
    confirmQuery($result);
        if (mysqli_num_rows($result) > 0) {
        return true;
        }else{
        return false;
        }
}

// REGISTER USER QUERY
function register_user($username, $email, $password){
global $connection;
 
        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

        //register user query
        $query = "INSERT INTO users (username,user_password,user_email,user_role) "; 
        $query .="VALUES ('{$username}','{$password}','{$email}','Subscriber')";
        $register_user_query = mysqli_query($connection, $query);
        
        confirmQuery($register_user_query);

}

// login function
function login_user($username,$password){
global $connection;
    
$username = mysqli_real_escape_string($connection, $username);  
$password = mysqli_real_escape_string($connection, $password);
    
$query= "SELECT * FROM users WHERE username ='{$username}'";
$login_query = mysqli_query($connection, $query);
//    tester
confirmQuery($login_query);    
    
    while($row= mysqli_fetch_assoc($login_query)){
    
    $db_user_id = $row['user_id'];
    $db_username = $row['username'];
    $db_user_password = $row['user_password'];
    $db_user_firstname = $row['user_firstname'];
    $db_user_lastname = $row['user_lastname'];
    $db_user_role = $row['user_role'];
    $db_user_email = $row['user_email'];
    }
    
    if(password_verify($password, $db_user_password)){
        $_SESSION['user_id'] = $db_user_id;
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['password'] = $db_user_password;
        $_SESSION['email'] = $db_user_email;
        
        redirect("/cms/admin/index.php");
    }else{
         redirect("/cms/index.php");
    }
}