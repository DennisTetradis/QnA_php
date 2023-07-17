<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link rel="stylesheet" href="./css/profile.css" />
</head>
<body>
    
    <h2>Delete Profile</h2>
<form action="delete.php" method="POST">
  <label for="username">Username:</label>
  <input type="text" id="username" name="username" required>

  <button type="submit">Delete</button>
</form
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // include 'db.php';
    $key = substr(md5(microtime().rand()), 0, 20);
    $stored_username = $_POST["username"];
    $first_name = $key; 
    $last_name = $key;
    $username = $key;
    $hashedPassword = $key;
    $email = "$key@aaaaaaaaaaaaaa";

    if ($stored_username == $_COOKIE['username']){
      $stmt = $mysqli->prepare("UPDATE users SET first_name=?, last_name=?, username=?, password=?, email=? WHERE id=?;");
      $stmt->bind_param("sssssi", $first_name, $last_name, $username, $hashedPassword, $email, $id);
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
      echo "You are not loged in!";
    }
  }else{
    echo "Please fill the form!";
  }
?>
</body>
</html>