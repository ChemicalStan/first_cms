<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>test</title>
</head>
<body>
    
  <form action="" method="post">
      
      <input type="text" name="ok">
      <select name="malam" id="">             
    <?php
      $case = [1,2,3,4,5];
      
      foreach($case as $i){
          
          
          echo "<option value='$i'>$i</option>";}
      ?>
           </select>
      
          <input type="submit" name="sub">
  </form>
    
    
</body>
</html>




<?php


if(isset($_POST['sub'])){
    
    
     echo $_POST['malam'];
          echo $_POST['ok'];
          
      }
?>