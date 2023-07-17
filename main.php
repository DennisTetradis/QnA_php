<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="./css/main.css" />
</head>
<body>
    
    <?php 
        // <!-- PHP database connection -->
        include 'db.php';
    ?>
    <button class="light_button" onclick="handleClick()">Dark/Light</button>
    <script src="theme.js"></script>

    <h2>Post</h2>
<form action="main.php" method="POST">
  <label for="title">Title:</label>
  <input type="text" id="title" name="title" required>

  <label for="question">Question:</label>
  <input type="text" id="question" name="question" required>

  <button type="submit">Submit</button>
</form

  <?php 
    $title = $_POST["title"];
    $question = $_POST["question"];
  ?>

</body>
</html>