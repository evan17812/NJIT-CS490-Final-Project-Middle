<?php include("db.php");

//$db = $GLOBALS['db'];

$message = "Some error occurred";

if (isset($_POST['examName'])) {
    $examName = mysqli_real_escape_string($db, $_POST['examName']);
    $examStatus = "Released";
    $updateExamListQuery = "UPDATE ExamLIST SET ExamStatus = '$examStatus' WHERE ExamName = '$examName';";
    $updateExamStatusQuery = "UPDATE Exams SET ExamStatus = '$examStatus' WHERE ExamName = '$examName';";

    if (!(mysqli_query($db, $updateExamListQuery) && mysqli_query($db, $updateExamStatusQuery))) {
        echo json_encode($message);
        exit;
    }

    $message = "success";
    echo json_encode($message);
}
mysqli_close($db);
?>