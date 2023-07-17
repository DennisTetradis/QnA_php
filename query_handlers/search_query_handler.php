<html>
<?php

function sanitise_input($data)
{
    $data = trim($data); // Strip unnecessary characters (extra space, tab, newline)
    $data = stripslashes($data); // Remove backslashes (\)
    $data = htmlspecialchars($data); // Convert special characters to HTML entities
    return $data;
}

function get_search_results_by_title($search, $start_date, $end_date)
{
    include '../db.php';
    $search = "%" . $search . "%";
    if ($start_date && $end_date) {
        $stmt = $mysqli->prepare("
            SELECT * FROM questions WHERE (title LIKE ? OR body LIKE ?) AND created_at BETWEEN ? AND ? ORDER BY created_at DESC
        ");
        $stmt->bind_param("ssss", $search, $search, $start_date, $end_date);
    } else {
        $stmt = $mysqli->prepare(
            "SELECT * FROM questions WHERE title LIKE ? OR body LIKE ? ORDER BY created_at DESC"
        );
        $stmt->bind_param("ss", $search, $search);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result;
}

function get_search_results_by_name_email($search, $start_date, $end_date)
{
    include '../db.php';
    $name_email = "%" . $search . "%";
    if ($start_date && $end_date) {
        $stmt = $mysqli->prepare("
            SELECT * FROM questions WHERE user_id IN (
                SELECT id FROM users WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ? OR username LIKE ?
            ) AND created_at BETWEEN ? AND ? ORDER BY created_at DESC
        ");
        $stmt->bind_param("ssssss", $name_email, $name_email, $name_email, $name_email, $start_date, $end_date);
    } else {
        $stmt = $mysqli->prepare("
            SELECT * FROM questions WHERE user_id IN (
                SELECT id FROM users WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ? OR username LIKE ?
            ) ORDER BY created_at DESC
        ");
        $stmt->bind_param("ssss", $name_email, $name_email, $name_email, $name_email);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result;
}

function get_search_results($search, $selectedChoice, $start_date, $end_date)
{
    include '../db.php';
    switch ($selectedChoice) {
        case "by_title":
            return get_search_results_by_title($search, $start_date, $end_date);
        case "by_name_email":
            return get_search_results_by_name_email($search, $start_date, $end_date);
    }
}

$query = sanitise_input($_POST["search"]);
$start_date = $_POST["start-date"] ?: null;
$end_date = $_POST["end-date"] ?: null;
$selectedChoice = $_POST["choices"];
$results = get_search_results($query, $selectedChoice, $start_date, $end_date);
$jsonResults = json_encode($results->fetch_all(MYSQLI_ASSOC))
?>

<head>
    <title>Search Results</title>
    <link rel="stylesheet" href="../css/search_results.css" />
</head>

<body>
    <div id="search-results"></div>
    <script>
        function renderList(list) {
            const listItems = list
                .map((item) => {
                    return `<li>${item}</li>`;
                })
                .join("");

            return `<ul class="results">${listItems}</ul>`;
        }

        function formatQuestion({
            title,
            body,
            user_id,
            created_at
        }) {
            return `
    <div class="question">
      <h3 class="question__title">${title}</h2>
      <p class="question__body">${body}</p>
      <p class="question__metadata">Asked by ${user_id} on ${created_at}</p>
    </div>
  `;
        }

        function renderQuestions(questions) {
            return renderList(questions.map(formatQuestion));
        }
    </script>
    <script>
        const searchResults = document.getElementById("search-results");
        const results = JSON.parse('<?php echo $jsonResults; ?>');
        console.log(renderQuestions(results));
        searchResults.innerHTML = renderQuestions(results);
    </script>
</body>



</html>