<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="./css/main.css" />
</head>
<body>
    
    <button class="light_button" onclick="handleClick()">Dark/Light</button>
    <script src="theme.js"></script>
    <button class="" onclick="direct_main()">Main Page</button>
    <button class="" onclick="direct_settings()">Profile Settings</button>
    <button class="" onclick="direct_export()">Export Data</button>
    <button class="" onclick="logout()">Logout</button>
    <script src="redirects.js"></script>

    <h2>Post</h2>
<form action="post.php" method="POST">
  <label for="title">Title:</label>
  <input type="text" id="title" name="title" required>

  <label for="question">Question:</label>
  <input type="text" id="question" name="question" required>

  <button type="submit">Submit</button>
</form
<br/>

<?php 
    // <!-- PHP database connection -->
    include 'db.php';
    //Get cookies
    $s_key = $_COOKIE['s_key'];
    $username = $_COOKIE['username'];
    //SQL query
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE simplepush_key = ? AND username = ?");
    $stmt->bind_param("ss", $s_key, $username);
    $stmt->execute();
    // Bind the results to variables
    $stmt->bind_result($id, $first_name, $last_name, $username, $password, $email, $simplepush_key);
    //  Fetch the results
    $stmt->fetch();
    $stmt->close();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $title = $_POST["title"];
      $question = $_POST["question"];
      $stmt = $mysqli->prepare("INSERT INTO questions (title, body, user_id) VALUES (?,?,?)");
      $stmt->bind_param("ssi", $title, $question, $id);
      $stmt->execute();
      $stmt->close();
      $mysqli->close();
      // error_reporting(E_ALL);
      // ini_set('display_errors', 1);
      header("Location: http://localhost:3000/posts.php");
      exit(); 
    } else {
      // Handle the case where the title is empty or null
      echo "Title cannot be empty";
    }
  ?>

</body>
</html>