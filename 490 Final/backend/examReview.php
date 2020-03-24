<?php include("db.php");

//$db = $GLOBALS['db'];

$message = "Some error occurred";
$message1 = "Some error occurred1";
$message2 = "Some error occurred2";

if (isset($_POST['examName'], $_POST['username']))
{
    $examName   = mysqli_real_escape_string($db, $_POST['examName']);
    $username   = mysqli_real_escape_string($db, $_POST['username']);
	$query 	    = "SELECT QuestionList, PointList FROM Exams WHERE ExamName = '$examName'";
	$result     = mysqli_query($db, $query);
	$row        = mysqli_fetch_row($result);
	$id_array   = explode(",", $row[0]);
	$pt_array   = explode(",", $row[1]);
	for ($i=0; $i <= count($id_array) - 1; $i++)
	{
		$id		  = $id_array[$i];
		$pt		  = $pt_array[$i];
		$id_query = "SELECT * FROM QuestionBank
                        INNER JOIN StudentAnswers ON QuestionBank.ID = StudentAnswers.ID
                     WHERE StudentAnswers.Username = '$username'
                        AND QuestionBank.ID = '$id'";
		$id_result = mysqli_query($db, $id_query);
		while ($row = mysqli_fetch_assoc($id_result))
		{
			$id 						    = $row['ID'];
			$row_array[$id]['id']		    = $row['ID'];
			$row_array[$id]['functionName'] = $row['FunctionName'];
			$row_array[$id]['topic'] 	    = $row['Topic'];
			$row_array[$id]['difficulty']   = $row['Difficulty'];
			$row_array[$id]['question'] 	= $row['Question'];
			$row_array[$id]['cases'] 	    = $row['Cases'];
			$row_array[$id]['input'] 	    = $row['Input'];
			$row_array[$id]['output'] 	    = $row['Output'];
            $row_array[$id]['pointWorth']	= $pt;
            $row_array[$id]['teacherNotes'] = $row['TeacherNotes'];
            $row_array[$id]['autoNotes']    = $row['Autonotes'];
            $row_array[$id]['grade']        = $row['Grade'];
            $row_array[$id]['answer']       = $row['Answer'];

            $row_array[$id]['functionNotes']    = $row['Function_Notes'];
            $row_array[$id]['syntaxNotes']    = $row['Syntax_Notes'];
            $row_array[$id]['constraintNotes']    = $row['Constraint_Notes'];
            $row_array[$id]['loopNotes']    = $row['Loop_Notes'];
            $row_array[$id]['TestCase1']    = $row['TestCase1'];
            $row_array[$id]['TestCase2']    = $row['TestCase2'];
            $row_array[$id]['TestCase3']    = $row['TestCase3'];
            $row_array[$id]['TestCase4']    = $row['TestCase4'];
            $row_array[$id]['TestCase5']    = $row['TestCase5'];
            $row_array[$id]['TestCase6']    = $row['TestCase6'];

            $row_array[$id]['functionGrade']    = $row['Function_Grade'];
            $row_array[$id]['syntaxGrade']    = $row['Syntax_Grade'];
            $row_array[$id]['constraintGrade']    = $row['Constraint_Grade'];
            $row_array[$id]['loopGrade']    = $row['Loop_Grade'];


            $row_array[$id]['TC1Grade']    = $row['T1_Grade'];
            $row_array[$id]['TC2Grade']    = $row['T2_Grade'];
            $row_array[$id]['TC3Grade']    = $row['T3_Grade'];
            $row_array[$id]['TC4Grade']    = $row['T4_Grade'];
            $row_array[$id]['TC5Grade']    = $row['T5_Grade'];
            $row_array[$id]['TC6Grade']    = $row['T6_Grade'];



					}
    }
    echo json_encode($row_array);
}
mysqli_close($db);
