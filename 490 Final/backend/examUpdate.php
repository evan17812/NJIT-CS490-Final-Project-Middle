<?php include("db.php");

//$db = $GLOBALS['db'];
$message = "Some error occurred";

if (isset($_POST['username'], $_POST['grade'], $_POST['teacherNotes'], $_POST['examName'], $_POST['id']))
{
    $examName = mysqli_real_escape_string($db, $_POST['examName']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $grade = mysqli_real_escape_string($db, $_POST['grade']);
    $teacherNotes = mysqli_real_escape_string($db, $_POST['teacherNotes']);
    $functionGrade = mysqli_real_escape_string($db, $_POST['functionGrade']);

    $syntaxGrade = mysqli_real_escape_string($db, $_POST['syntaxGrade']);

    $constraintGrade = mysqli_real_escape_string($db, $_POST['constraintGrade']);

    $loopGrade = mysqli_real_escape_string($db, $_POST['loopGrade']);

    $TC1Grade = mysqli_real_escape_string($db, $_POST['TC1Grade']);
    $TC2Grade = mysqli_real_escape_string($db, $_POST['TC2Grade']);
    $TC3Grade = mysqli_real_escape_string($db, $_POST['TC3Grade']);
    $TC4Grade = mysqli_real_escape_string($db, $_POST['TC4Grade']);
    $TC5Grade = mysqli_real_escape_string($db, $_POST['TC5Grade']);
    $TC6Grade = mysqli_real_escape_string($db, $_POST['TC6Grade']);


    $updateExamQuery = "UPDATE StudentAnswers SET Grade = '$grade', TeacherNotes = '$teacherNotes', Function_Grade = '$functionGrade', Syntax_Grade ='$syntaxGrade', Constraint_Grade='$constraintGrade', Loop_Grade='$loopGrade', T1_Grade='$TC1Grade', T2_Grade='$TC2Grade', T3_Grade='$TC3Grade', T4_Grade='$TC4Grade', T5_Grade='$TC5Grade', T6_Grade='$TC6Grade'
                WHERE ExamName = '$examName' AND Username = '$username' AND ID = '$id'";

    if (!mysqli_query($db, $updateExamQuery))
		{
        echo json_encode($message);
        mysqli_close($db);
        exit;
    }

		$message = "success";
		echo json_encode($messagex);
}

mysqli_close($db);
