<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="./css/profile.css" />
</head>
<body>

    <!-- PHP database connection -->
    <?php
        include 'db.php';
        if ($_COOKIE['s_key'] != null){
        //Get cookies
            $s_key = $_COOKIE['s_key'];
            $username = $_COOKIE['username'];
        }else{
            echo "You are not signed in!";
        }
        //SQL query
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE simplepush_key = ? AND username = ?");
        $stmt->bind_param("ss", $s_key, $username);
        $stmt->execute();
        // Bind the results to variables
        $stmt->bind_result($id, $first_name, $last_name, $username, $password, $email, $simplepush_key);
        //  Fetch the results
        $stmt->fetch();
        $stmt->close();
    ?>
    <button class="light_button" onclick="handleClick()">Dark/Light</button>
    <script src="theme.js"></script>
    <button class="" onclick="direct_main()">Main Page</button>
    <button class="" onclick="direct_post()">Make a Post</button>
    <button class="" onclick="direct_export()">Export Data</button>
    <button class="" onclick="logout()">Logout</button>
    <script src="redirects.js"></script>

    <h2>Change Profile Settings</h2>
<form action="profile.php" method="POST">
  <label for="first-name">Όνομα:</label>
  <input value="<?php echo $first_name; ?>" type="text" id="first-name" name="first-name" required>

  <label for="last-name">Επώνυμο:</label>
  <input value="<?php echo $last_name; ?>" type="text" id="last-name" name="last-name" required>

  <label for="username">Username:</label>
  <input value="<?php echo $username; ?>" type="text" id="username" name="username" required>

  <label for="password">Password:</label>
  <input type="password" id="password" name="password" required>

  <label for="email">Email:</label>
  <input value="<?php echo $email; ?>" type="email" id="email" name="email" required>

  <button type="submit">Save</button>
  <br>
<button class="" onclick="delete_acc()">Delete Account</button>
</form

<br>

<?php 

    include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST["first-name"];
    $last_name = $_POST["last-name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $email = $_POST["email"];
    $simplepush_key = $_COOKIE['s_key'];

    $stmt = $mysqli->prepare("UPDATE users SET first_name=?, last_name=?, username=?, password=?, email=? WHERE id=?;");
    $stmt->bind_param("sssssi", $first_name, $last_name, $username, $hashedPassword, $email, $id);
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();
    // Set the cookie values
    setcookie("username", urlencode($username));
    header("Location: http://localhost:3000/posts.php");
    exit(); 
    } else {
    echo "Please fill up the form!";
    }
?> 

</body>
</html>