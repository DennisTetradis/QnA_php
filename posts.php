<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="./css/posts.css" />
</head>
<body>

    <button class="light_button" onclick="handleClick()">Dark/Light</button>
    <script src="theme.js"></script>
    <button class="" onclick="direct_post()">Make a Post</button>
    <button class="" onclick="direct_settings()">Profile Settings</button>
    <button class="" onclick="direct_export()">Export Data</button>
    <button class="" onclick="search()">Search</button>
    <button class="" onclick="logout()">Logout</button>
    <script src="redirects.js"></script>

<?php
include 'db.php';

// Fetch all questions from the table
$query = "SELECT * FROM questions";
$result = $mysqli->query($query);

// Check if there are any questions
if ($result->num_rows === 0) {
    echo "No questions found.";
} else {
        // Display the questions
        while ($row = $result->fetch_assoc()) {
            $questionUrl = "question_details.php?id=" . $row['id'];

            ?>
            <a href="<?php echo $questionUrl; ?>">
                <div class="question">
                    <h2><?php echo $row['title']; ?></h2>
                    <p><?php echo $row['body']; ?></p>
                    <p><?php echo $row['created_at'];?></p>
                </div>
            </a>
            <?php
                }
            }
        
            // Close the database connection
            $mysqli->close();
            ?>
 
</body>
</html>