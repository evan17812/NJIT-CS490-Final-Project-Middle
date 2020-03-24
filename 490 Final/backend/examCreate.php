<?php include("db.php");

//$db = $GLOBALS['db'];

$response = "";

$message = "Some error occurred";

$questionListArray = $_POST['questionList'];
//print_r($questionListArray);
$examName = mysqli_real_escape_string($db, $_POST['examName']);
$questionList = mysqli_real_escape_string($db, $_POST['questionList']);
$pointList = mysqli_real_escape_string($db, $_POST['pointList']);
$examStatus = "Assigned";

$studentsArray = array();
$fetchStudentsQuery = "SELECT Username FROM Users WHERE UserStatus='student'";
$result = mysqli_query($db, $fetchStudentsQuery);

if (TRUE != $result) {
    echo json_decode($message);
    mysqli_close($db);
    exit;
}

while ($row = $result->fetch_assoc()) {
    array_push($studentsArray, $row['Username']);
}

foreach ($studentsArray as $studentName) {
    $updateExamListQuery = "INSERT INTO ExamLIST(Username, ExamName, ExamStatus)
          VALUES('$studentName', '$examName', '$examStatus')";
    if (TRUE != mysqli_query($db, $updateExamListQuery)) {
        echo json_decode($message);
        mysqli_close($db);
        exit;
    }
}

if (isset($_POST['examName'], $_POST['questionList'], $_POST['pointList'])) {
    $addToExamsQuery = "INSERT INTO Exams (ExamName, QuestionList, PointList, ExamStatus)
                   VALUES ('$examName','$questionList','$pointList', '$examStatus');";


    $assignExam = "UPDATE ExamLIST SET ExamStatus = '$examStatus' WHERE ExamName = '$examName';";
    if (!(mysqli_query($db, $addToExamsQuery) && mysqli_query($db, $assignExam))) {
        echo json_decode($message);
        mysqli_close($db);
        exit;
    }

    //$message = "success";
    //echo json_encode($message);
}
if (isset($_POST['examName'], $_POST['questionList']))
{

    $addToStudentAnswers = "INSERT INTO StudentAnswers (ExamName, Username, Answer, Autonotes, ID, Grade, TeacherNotes, Function_Notes,
																				Syntax_Notes, Constraint_Notes, Loop_Notes, TestCase1, TestCase2, TestCase3, TestCase4, TestCase5, TestCase6,
																				Function_Grade, Syntax_Grade, Constraint_Grade, Loop_Grade, T1_Grade, T2_Grade, T3_Grade, T4_Grade, T5_Grade, T6_Grade)
                   VALUES ('$examName','null','null', 'null', 'null','null','null','null','null','null','null','null','null','null','null','null','null',
									 				'null','null','null','null','null','null','null','null','null','null')";


									 if (TRUE != mysqli_query($db, $addToStudentAnswers)) {
						 	        echo json_decode($message);
						 	        mysqli_close($db);
						 	        exit;
    }

    $message = "success";
    echo json_encode($message);
}
mysqli_close($db);
