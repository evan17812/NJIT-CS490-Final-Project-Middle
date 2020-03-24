<?php include("db.php");

//$db = $GLOBALS['db'];
$message = "Some error occurred";

if (isset($_POST['keyword'], $_POST['topic'], $_POST['difficulty'])) {
    $difficulty = mysqli_real_escape_string($db, $_POST['difficulty']);
    $topic      = mysqli_real_escape_string($db, $_POST['topic']);
    $keyword    = mysqli_real_escape_string($db, $_POST['keyword']);

    if($difficulty  != '') $query_array[] = "Difficulty = '$difficulty'";
    if($topic       != '') $query_array[] = "Topic = '$topic'";
    if($keyword     != '') $query_array[] = "Question LIKE '%$keyword%'";
    
    $query_list = implode(" AND ", $query_array);
    $query      = "SELECT * FROM QuestionBank WHERE $query_list;";
    $result     = mysqli_query($db, $query);

    while($row = mysqli_fetch_assoc($result)) {
        $i = $row['ID'];
        $row_array[$i]['functionName'] = $row['FunctionName'];
        $row_array[$i]['topic'] 	   = $row['Topic'];
        $row_array[$i]['difficulty']   = $row['Difficulty'];
        $row_array[$i]['question'] 	   = $row['Question'];
	      $row_array[$i]['parameters']   = $row['Cases'];
      	$row_array[$i]['input'] 	   = $row['Input'];
      	$row_array[$i]['output'] 	   = $row['Output'];
        $row_array[$i]['constraint'] 	   = $row['ConstraintType'];
        $row_array[$i]['loop'] 	   = $row['LoopType'];
        
    }
    echo json_encode($row_array);
}
else {
echo json_encode($keyword);
}
mysqli_close($db);
?>