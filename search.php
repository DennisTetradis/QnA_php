<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search</title>
  <link rel="stylesheet" href="./css/search.css" />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
  <button class="light_button" onclick="handleClick()">Dark/Light</button>
  <script src="theme.js"></script>
    <button class="" onclick="direct_main()">Main Page</button>
    <button class="" onclick="direct_settings()">Profile Settings</button>
    <button class="" onclick="direct_export()">Export Data</button>
    <button class="" onclick="logout()">Logout</button>
    <script src="redirects.js"></script>

  <form action="query_handlers/search_query_handler.php" method="POST">
    <label for="search">Search:</label>
    <input type="date" id="start-date" name="start-date">
    <input type="date" id="end-date" name="end-date">
    <input type="text" id="search" name="search" required>
    <select name="choices" id="choices">
      <option value="by_title">By Title</option>
      <option value="by_name_email">By Name or Email</option>
    </select>
    <button type="submit">Search</button>
  </form>

</body>

</html>