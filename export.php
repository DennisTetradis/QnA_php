<?php
// $result = get_all_questions_and_answers();
// $xmlData = new SimpleXMLElement('<data></data>');

function get_all_questions_and_answers()
{
    include 'db.php';
    $stmt = $mysqli->prepare("
        SELECT 
            questions.id AS question_id, questions.title AS question_title, questions.body AS question_body, 
            questions.created_at AS question_created_at, questions.user_id AS question_user_id, 
            users.first_name AS user_first_name, users.last_name AS user_last_name, users.email AS user_email, 
            users.username AS user_username, answers.id AS answer_id, answers.body AS answer_body, 
            answers.created_at AS answer_created_at, answers.user_id AS answer_user_id 
            FROM questions LEFT JOIN users ON questions.user_id = users.id LEFT JOIN answers ON questions.id = answers.question_id ORDER BY questions.created_at DESC
    ");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function resultToXml($result, &$xmlData)
{
    foreach ($result as $key => $value) {
        if (is_array($value)) {
            $subnode = $xmlData->addChild($key);
            resultToXml($value, $subnode);
        } else {
            $xmlData->addChild("$key", htmlspecialchars("$value"));
        }
    }
}

// $jsonResult = json_encode($result);
// echo $jsonResult;

// resultToXml($result, $xmlData);
// $dom = new DOMDocument('1.0');
// $dom->preserveWhiteSpace = false;
// $dom->formatOutput = true;
// echo $xmlData->asXML();
// $dom->loadXML($xmlData->asXML());
// $dom->loadXML($xmlData->asXML());
// $dom->save('export.xml');
