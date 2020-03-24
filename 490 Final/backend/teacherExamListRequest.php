<?php include("db.php");

//$db = $GLOBALS['db'];

$username = "";

if(isset($_POST['username'])){
    $username = mysqli_real_escape_string($db, $_POST['username']);
}
$query	  = "SELECT ExamName, ExamStatus FROM ExamLIST";
$result	  = mysqli_query($db, $query);
$data 	  = array();
$i = -1;
while($row = mysqli_fetch_assoc($result)) {
    $i++;
    $row_array[$i]['examName'] = $row['ExamName'];
    $row_array[$i]['status']   = $row['ExamStatus'];
}
echo json_encode($row_array);
mysqli_close($db);
