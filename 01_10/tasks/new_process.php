<?php

// Helper function
function redirect_to($location) {
  header("Location: " . $location);
  exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {

  $task = [];
  $task['description'] = $_POST['description'] ?? '';
  $task['priority'] = $_POST['priority'] ?? '10';
  $task['completed'] = $_POST['completed'] ?? '0';

  // hostname: "127.0.0.1"
  // username: "mariadb"
  // password: "mariadb"
  // database: "mariadb"
  // port:     3306

  //create db connection
  $db = mysqli_connect("127.0.0.1", "mariadb", "mariadb", "mariadb", 3306);
  
  //test if succesful connection
  if (mysqli_connect_errno()) {
    $msg = "Database connection failed";
    $msg .= mysqli_connect_error();
    $msg .= mysqli_connect_errno() . ")";
    exit($msg);
  }
  
  $sql = "INSERT INTO tasks (description, priority, completed) VALUES ";
  $sql .= "(";
  //escape string function to prevent sql injection, similar to allow list and making sure int
  $sql .= "'" . mysqli_real_escape_string($db, $task['description']) . "',";
  $sql .= "'" . mysqli_real_escape_string($db, $task['priority']) . "',";
  $sql .= "'" . mysqli_real_escape_string($db, $task['completed']) . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);

  //result will return true or false for insert statements
  //test if query success
  if(!$result) {
    echo 'insert fail';
    exit;
  }

  //use returned data if present
  $new_id = mysqli_insert_id($db);

  //no need to release returned data becasue result true/false
  //close db connection 
  mysqli_close($db);
  redirect_to('show.php?id=' . $new_id);

}

?>
