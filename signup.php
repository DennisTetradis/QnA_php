<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp/Signin</title>
    <link rel="stylesheet" href="./css/signup.css" />
</head>
<body>
    <button class="light_button" onclick="handleClick()">Dark/Light</button>
    <script src="theme.js"></script>

    <h2>SignUp</h2>
<form action="signup.php" method="POST">
  <label for="first-name">Όνομα:</label>
  <input type="text" id="first-name" name="first-name" required>

  <label for="last-name">Επώνυμο:</label>
  <input type="text" id="last-name" name="last-name" required>

  <label for="username">Username:</label>
  <input type="text" id="username" name="username" required>

  <label for="password">Password:</label>
  <input type="password" id="password" name="password" required>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required>

  <!-- <label for="simplepush-key">Simplepush.io key:</label>
  <input type="text" id="simplepush-key" name="simplepush-key" required> -->

  <button type="submit">Submit</button>
  <a href="http://localhost:3000/signin.php">Already have an account?</a>
</form

<br>
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db.php';
    $first_name = $_POST["first-name"];
    $last_name = $_POST["last-name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $email = $_POST["email"];
    $key = md5(microtime().rand());
    $key = substr($key, 0, 20);

    // Set the cookie values
    setcookie("s_key", urlencode($key));
    setcookie("username", urlencode($username));

    $stmt = $mysqli->prepare("INSERT INTO users (first_name, last_name, username, password, email, simplepush_key) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("ssssss", $first_name, $last_name, $username, $hashedPassword, $email, $key);
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();
    // Redirect
    header("Location: http://localhost:3000/posts.php");
    exit(); 
}else{
    echo "Please fill the form!";
}
?> 

</body>
</html>