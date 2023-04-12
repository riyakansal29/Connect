
<?php  
  include 'database/connection.php';
  include 'classes/base.php';
  include 'classes/user.php';
  include 'classes/post.php';
  include 'classes/follow.php';
 
  global $pdo;
 
  session_start();
  $getFromU = new User($pdo);
  $getFromT = new Post($pdo);
  $getFromF = new Follow($pdo);
 
  define("BASE_URL", "http://localhost/connect/");
?>
