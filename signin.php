<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
    <link rel="stylesheet" href="./css/profile.css" />
</head>
<body>
    <button class="light_button" onclick="handleClick()">Dark/Light</button>
    <script src="theme.js"></script>
    <h2>SignIn</h2>
<form action="signin.php" method="POST">
  <label for="username">Username:</label>
  <input type="text" id="username" name="username" required>

  <label for="password">Password:</label>
  <input type="password" id="password" name="password" required>

  <button type="submit">Submit</button>
  <a href="http://localhost:3000/signup.php">Don't have an account?</a>
</form

<br>

<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db.php';
    $username = $_POST["username"];
    echo $username;
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $key = md5(microtime().rand());
    $key = substr($key, 0, 20);

    //SQL query
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    // Bind the results to variables
    $stmt->bind_result($id, $first_name, $last_name, $usernameDB, $passwordDB, $email, $simplepush_key);
    //  Fetch the results
    $stmt->fetch();
    $stmt->close();

    if (password_verify( $password, $passwordDB) AND $username == $usernameDB){
      $stmt = $mysqli->prepare("UPDATE users SET simplepush_key = ? WHERE username = ?");
      $stmt->bind_param("ss",  $key, $username);
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
      $stmt->execute();
      $stmt->close();
      $mysqli->close();

      // Set the cookie values
      setcookie("s_key", urlencode($key));
      setcookie("username", urlencode($username));

      // Redirect
      header("Location: http://localhost:3000/posts.php");
      exit(); 
    }
    else{
      echo "Wrong password or username!";
    }
  }else{
    echo "Please fill the form!";
  }

?> 

</body>
</html>