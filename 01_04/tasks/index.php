<?php

// hostname: "127.0.0.1"
// username: "mariadb"
// password: "mariadb"
// database: "mariadb"
// port:     3306
// create database connectin
$db = mysqli_connect("127.0.0.1", "mariadb", "mariadb", "mariadb", 3306);

//test connection
if (mysqli_connect_errno()) {
  $msg = "Database connection unsucessful: ";
  $msg .= mysqli_connect_error();
  $msg .= " (" . mysqli_connect_errno() . ")";
  exit($msg);
}

//database query
$sql = "SELECT * FROM tasks ORDER BY priority";
$result = mysqli_query($db, $sql);

//check if query succeeded
if (!$result) {
  exit("Database query failed.");
}

//place returned data in array

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Task Manager: Task List</title>
  </head>
  <body>

    <header>
      <h1>Task Manager</h1>
    </header>

    <section>

      <h1>Task List</h1>

    	<table>
    	  <tr>
          <th>ID</th>
          <th>Priority</th>
          <th>Completed</th>
    	    <th>Description</th>
    	  </tr>

        <?php // loop through tasks
          while ($task = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?php echo $task['id'] ?></td>
              <td><?php echo $task['priority'] ?></td>
              <td><?php echo $task['completed'] == 1 ? 'true' : 'false'; ?></td>
              <td><?php echo $task['description']; ?></td>
            </tr>
        <?php } // end loop ?>
    	</table>

    </section>

  </body>
</html>

<?php
mysqli_free_result($result);

mysqli_close($db);
?>