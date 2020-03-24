<?php include("db.php");

//$db = $GLOBALS['db'];

$message="failure";
		$examName = mysqli_real_escape_string($db, $_POST['examName']);

    //$examName   = mysqli_real_escape_string($db, $_POST['examName']);

    $username   = mysqli_real_escape_string($db, $_POST['username']);
    $id         = mysqli_real_escape_string($db, $_POST['id']);
   $answer     = mysqli_real_escape_string($db, $_POST['answer']);
    //$answer="I passed";
    $grade      = mysqli_real_escape_string($db, $_POST['grade']);
$notes = mysqli_real_escape_string($db, $_POST['notes']);

$FunctionNotes = mysqli_real_escape_string($db, $_POST['functionNotes']);

$SyntaxNotes = mysqli_real_escape_string($db, $_POST['syntaxNotes']);
$ConstraintNotes = mysqli_real_escape_string($db, $_POST['constraintNotes']);
$LoopNotes = mysqli_real_escape_string($db, $_POST['loopNotes']);

$TestCase1 = mysqli_real_escape_string($db, $_POST['testCase1']);

$TestCase2 = mysqli_real_escape_string($db, $_POST['testCase2']);
$TestCase3 = mysqli_real_escape_string($db, $_POST['testCase3']);
$TestCase4 = mysqli_real_escape_string($db, $_POST['testCase4']);
$TestCase5 = mysqli_real_escape_string($db, $_POST['testCase5']);
$TestCase6 = mysqli_real_escape_string($db, $_POST['testCase6']);
$FunctionGrade = mysqli_real_escape_string($db, $_POST['functionGrade']);
$SyntaxGrade = mysqli_real_escape_string($db, $_POST['syntaxGrade']);
$ConstraintGrade = mysqli_real_escape_string($db, $_POST['constraintGrade']);
$LoopGrade = mysqli_real_escape_string($db, $_POST['loopGrade']);
$T1Grade  = mysqli_real_escape_string($db, $_POST['TC1Grade']);
$T2Grade  = mysqli_real_escape_string($db, $_POST['TC2Grade']);
$T3Grade  = mysqli_real_escape_string($db, $_POST['TC3Grade']);
$T4Grade  = mysqli_real_escape_string($db, $_POST['TC4Grade']);
$T5Grade  = mysqli_real_escape_string($db, $_POST['TC5Grade']);
$T6Grade  = mysqli_real_escape_string($db, $_POST['TC6Grade']);

$sql="UPDATE ExamLIST SET ExamStatus='Submitted' Where Username='$username' AND ExamName='$examName'";
$flag = $db->query($sql);

if (isset($_POST['examName'], $_POST['username'], $_POST['id'], $_POST['notes'], $_POST['grade']))
{

    $query = "INSERT INTO StudentAnswers (ExamName, Username, Answer, Autonotes,ID, Grade,Function_Notes,Syntax_Notes,Constraint_Notes,Loop_Notes,
													TestCase1, TestCase2, TestCase3, TestCase4, TestCase5, TestCase6,Function_Grade, Syntax_Grade, Constraint_Grade, Loop_Grade,
												  T1_Grade, T2_Grade, T3_Grade, T4_Grade, T5_Grade, T6_Grade)
              VALUES ('$examName','$username','$answer', '$notes','$id','$grade','$FunctionNotes','$SyntaxNotes','$ConstraintNotes','$LoopNotes',
											'$TestCase1','$TestCase2','$TestCase3','$TestCase4','$TestCase5','$TestCase6','$FunctionGrade','$SyntaxGrade','$ConstraintGrade','$LoopGrade',
											'$T1Grade','$T2Grade','$T3Grade','$T4Grade','$T5Grade','$T6Grade')";
    if(mysqli_query($db,$query))
    {
    $message = ("success");
    }
    else
		{
			$message = ("failure");
		}
}
//echo json_encode($message);
mysqli_close($db);
