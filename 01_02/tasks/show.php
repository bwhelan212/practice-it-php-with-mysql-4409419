<?php

// hostname: "127.0.0.1"
// username: "mariadb"
// password: "mariadb"
// database: "mariadb"
// port:     3306

//1. Create Database connection
//mysqli_connect(<hostname>, <username>, <password>, <port>)
$db = mysqli_connect("127.0.0.1", "mariadb", "mariadb", "mariadb", 3306);

// Test connection
if (mysqli_connect_errno()) {
  $msg = "Database connection failed: ";
  $msg .= mysqli_connect_error();
  $msg .= " (" . mysqli_connect_errno() . ")";
  exit($msg);
}

// database query (LIMIT 1 returns 1 record)
$sql = "SELECT * FROM tasks LIMIT 1";
$result = mysqli_query($db, $sql);
//check if query succeeded 
if (!$result) {
  exit("Database query failed.");
}

// use returned data if present
$task = mysqli_fetch_assoc($result);
?>

<!doctype html>
<html lang="en">

<head>
  <title>Task Manager: Show Task</title>
</head>

<body>

  <header>
    <h1>Task Manager</h1>
  </header>

  <section>

    <h1>Show Task</h1>

    <dl>
      <dt>ID</dt>
      <dd><?php echo $task['id']; ?></dd>
    </dl>
    <dl>
      <dt>Priority</dt>
      <dd><?php echo $task['priority']; ?></dd>
    </dl>
    <dl>
      <dt>Completed</dt>
      <dd><?php echo $task['completed'] == 1 ? 'true' : 'false'; ?></dd>
    </dl>
    <dl>
      <dt>Description</dt>
      <dd><?php echo $task['description']; ?></dd>
    </dl>

  </section>

</body>

</html>
<?php
//release returned data
mysqli_free_result($result);

mysqli_close($db);
?>