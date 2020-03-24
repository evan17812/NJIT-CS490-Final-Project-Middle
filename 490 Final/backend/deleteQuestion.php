<?php include("db.php");

//$db = $GLOBALS['db'];

$message = "Some failure occurred";

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $deleteQuestionQuery = "DELETE FROM QuestionBank WHERE ID = '$id';";

    if (!mysqli_query($db, $deleteQuestionQuery)) {
        echo json_encode($message);
        mysqli_close($db);
        exit;
    }

    $message = "Success";

    echo json_encode($message);
}
mysqli_close($db);
?>