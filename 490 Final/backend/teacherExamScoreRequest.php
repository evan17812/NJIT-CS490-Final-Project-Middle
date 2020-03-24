<?php include("db.php");

  header("Content-type: application/json; charset=UTF-8");
  $examName = $_POST['examName'];


  //$conn = new mysqli("localhost", "root", "testpassword", "cs490");


  if ($db->connect_error)
	{
    die("Connection failed: " . $db->connect_error);
  }

  $sql = "SELECT ExamStatus, Username FROM ExamLIST WHERE ExamName='$examName'";
  $sql2 = "SELECT PointList FROM Exams WHERE ExamName='$examName'";

  $result=$db->query($sql2);
	//echo $result->num_rows;
  if ($result->num_rows == 0)
	{
		//echo json_encode("Hello");
  }
	elseif ($result->num_rows > 0)
	{
    while($row = $result->fetch_assoc())
		{
			//echo $pointString;
      $pointString = $row["PointList"];
    }
  }

  $pointArray = explode(",",$pointString);
  $total = array_sum($pointArray);



  $result = $db->query($sql);
  $i = -1;
  if ($result->num_rows == 0)
	{
  //echo json_encode("3");
  }
	elseif ($result->num_rows > 0)
	{
    while($row = $result->fetch_assoc())
		{
      $i++;
      $output[$i]['username'] = $row["Username"];
      $output[$i]['status'] = $row["ExamStatus"];
      $output[$i]['total'] = $total;
    }
  }


  for($j =0; $j <= $i; $j++)
	{
    $username = $output[$j]['username'];
    $sql3 ="SELECT Grade FROM StudentAnswers WHERE ExamName = '$examName' AND Username = '$username'";
    $result = $db->query($sql3);
    $grade=0;
    while($row = $result->fetch_assoc())
		{
      $grade= $grade+$row["Grade"];
    }
    $output[$j]['grade'] = $grade;
  }

  echo json_encode($output);

mysqli_close($db);
