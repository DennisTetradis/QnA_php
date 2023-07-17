<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include "db.php";
// Retrieve questions and answers from the database

$query1 = "SELECT * FROM questions";
$questions = $mysqli->query($query1);
$query2 = "SELECT * FROM answers";
$asnwers = $mysqli->query($query2);
// Perform the join operation
$query = 'SELECT * 
FROM ' . $questions . ' AS t1
JOIN ' . $answers . ' AS t2
ON t1.common_column = t2.common_column';

$stmt = $mysqli->prepare($query);
$stmt->execute();

// Fetch the result
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$questionsAndAnswers = $result;

// Create a new XML document
$xmlDoc = new DOMDocument('1.0', 'UTF-8');

// Create the root element
$rootElement = $xmlDoc->createElement('data');
$xmlDoc->appendChild($rootElement);

// Iterate through each question and answer
foreach ($questionsAndAnswers as $qa) {
    // Create question element
    $questionElement = $xmlDoc->createElement('question');
    
    // Create and append question text element
    $questionTextElement = $xmlDoc->createElement('text', $qa['question_text']);
    $questionElement->appendChild($questionTextElement);
    
    // Create and append question identifier element
    $questionIdentifierElement = $xmlDoc->createElement('user_id', $qa['user_id']);
    $questionElement->appendChild($questionIdentifierElement);
    
    // Create answer element
    $answerElement = $xmlDoc->createElement('answer');
    
    // Create and append answer text element
    $answerTextElement = $xmlDoc->createElement('text', $qa['answer_text']);
    $answerElement->appendChild($answerTextElement);
    
    // Create and append answer identifier element
    $answerIdentifierElement = $xmlDoc->createElement('user_id', $qa['user_id']);
    $answerElement->appendChild($answerIdentifierElement);
    
    // Append question and answer elements to the root element
    $rootElement->appendChild($questionElement);
    $rootElement->appendChild($answerElement);
}

// Set the appropriate headers for XML
header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="questions_and_answers.xml"');

// Output the XML content
echo $xmlDoc->saveXML();

   
   ?> 
</body>
</html>