<?php session_start();?>
<?php include "db.php";?>
<?php include "../admin/functions.php";?>

<?php 

if(isset($_POST['login'])){

$username= trim($_POST['username']);
$password = trim($_POST['password']);

login_user($username,$password);
    
//   ***** OLD METHOD******
//$password= crypt($password, $db_user_password);
    //if($username === $db_username && $password === $db_user_password){
    
}
?>

