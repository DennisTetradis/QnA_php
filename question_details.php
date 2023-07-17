<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
    <link rel="stylesheet" href="./css/question_details.css" />
</head>
<body>

    <button class="light_button" onclick="handleClick()">Dark/Light</button>
    <script src="theme.js"></script>
    <button class="" onclick="direct_main()">Main Page</button>
    <button class="" onclick="direct_post()">Make a Post</button>
    <button class="" onclick="direct_settings()">Profile Settings</button>
    <button class="" onclick="direct_export()">Export Data</button>
    <button class="" onclick="logout()">Logout</button>
    <script src="redirects.js"></script>


<?php
include "db.php";

// Get the question ID from the URL parameter
$questionId = isset($_GET['id']) ? $_GET['id'] : 1;

// Fetch the question details based on the ID
$query = "SELECT * FROM questions WHERE id = $questionId";
$result = $mysqli->query($query);

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Check if the question exists
if ($result->num_rows === 1) {
    $question = $result->fetch_assoc();

    // Display the question details
    echo "<h1>" . $question['title'] . "</h1>";
    echo "<h2>" . $question['body'] . "</h2>";
    echo "<h5>" . $question['created_at'] . "</h5>";
} else {
    echo "Question not found.";
}

// Close the database connection
$mysqli->close();

$id = $question['id'];
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$uri = $_SERVER['REQUEST_URI'];
$fullUrl = $protocol . "://" . $host . $uri;
?>

<form action="<?php echo $fullUrl;?>" method="POST">
  <label for="reply">Reply:</label>
  <input type="text" id="reply" name="reply" required>

  <button type="submit">Reply</button>
</form

<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $s_key = $_COOKIE['s_key'];
    $username = $_COOKIE['username'];
    //SQL query
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE simplepush_key = ? AND username = ?");
    $stmt->bind_param("ss", $s_key, $username);
    $stmt->execute();
    // Bind the results to variables
    $stmt->bind_result($user_id, $first_name, $last_name, $username, $password, $email, $simplepush_key);
    //  Fetch the results
    $stmt->fetch();
    $stmt->close();

    // Fetch all questions from the table
    $reply = $_POST["reply"];
    $stmt = $mysqli->prepare("INSERT INTO answers (body, question_id, user_id) VALUES (?,?,?)");
    $stmt->bind_param("sii", $reply, $question['id'], $user_id);
    $stmt->execute();
    $stmt->close();
    // $mysqli->close();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
  } else {
    //Handle the case where the title is empty or null
    echo "Title cannot be empty";
  }


  // Get the question ID from the URL parameter
  $questionId = isset($_GET['id']) ? $_GET['id'] : 1;

  // Fetch all replies from the table
  $query = "SELECT * FROM answers WHERE question_id=$questionId";
  $result = $mysqli->query($query);

  // Check if there are any replies 
  if ($result->num_rows === 0) {
      echo "No replies found.";
  } else {

?><link rel="stylesheet" href="./css/question_details.css" /><br><?php

  // Display the replies 
  $rows = array();
  while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
  }

  // Reverse the array
  $rows = array_reverse($rows);

  foreach ($rows as $row) {
      ?>
      <div class="reply">
          <p><?php echo $row['body']; ?></p>
          <p><?php echo $row['created_at']; ?></p>
      </div>
      <?php
  }
}
?>
</body>
</html>