<?php
include "db.php";

//$db = $GLOBALS['db'];

$question = mysqli_real_escape_string($db, $_POST['question']);
$functionName = mysqli_real_escape_string($db, $_POST['functionName']);
$topic = mysqli_real_escape_string($db, $_POST['topic']);
$difficulty = mysqli_real_escape_string($db, $_POST['difficulty']);
$params = mysqli_real_escape_string($db, $_POST['parameters']);
$input = mysqli_real_escape_string($db, $_POST['input']);
$output = mysqli_real_escape_string($db, $_POST['output']);
$constraint = mysqli_real_escape_string($db, $_POST['constraint']);
$loop = mysqli_real_escape_string($db, $_POST['loop']);

$query = "INSERT INTO QuestionBank (FunctionName, Topic, Difficulty, ConstraintType, LoopType, Question, Cases, Input, Output)
		  VALUES ('$functionName','$topic','$difficulty','$constraint','$loop','$question','$params','$input','$output');";

if (mysqli_query($db, $query)) {
    $message = "success";
} else {
    $message = "fail";
}

echo json_encode($message);
mysqli_close($db);
