<?php include("db.php");

//$db = $GLOBALS['db'];

$message = "Some error occurred";

$fetchQuestionsQuery = "SELECT * FROM QuestionBank;";
$result = mysqli_query($db, $fetchQuestionsQuery);

/*if(!(TRUE == $result)) {
    echo json_encode($message);
    mysqli_close($db);
    exit;
}*/


while ($row = mysqli_fetch_assoc($result)) {
    $i = $row['ID'];
    $row_array[$i]['functionName'] = $row['FunctionName'];
    $row_array[$i]['topic'] = $row['Topic'];
    $row_array[$i]['difficulty'] = $row['Difficulty'];
    $row_array[$i]['question'] = $row['Question'];
    $row_array[$i]['parameters'] = $row['Cases'];
    $row_array[$i]['input'] = $row['Input'];
    $row_array[$i]['output'] = $row['Output'];
    $row_array[$i]['constraint'] = $row['ConstraintType'];
    $row_array[$i]['loop'] = $row['LoopType'];
    
}
echo json_encode($row_array);
//mysqli_free_result($result);
mysqli_close($db);
?>