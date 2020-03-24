<?php
include("db.php");
//echo $_POST['username'];
//echo $_POST['password'];

//$invalidCredsResponse = "Invalid Credentials";
//$message = "Some error occurred";

if (isset($_POST['username'], $_POST['password']))
{
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $loginQuery = "SELECT `UserStatus` FROM `Users` WHERE Username = '$username' and Password = '$password'";
    $result = mysqli_query($db, $loginQuery);

   if (!(TRUE == $result))
	 {
        echo json_encode($message);
        mysqli_close($loginQuery);
        exit;
    }

    $count = mysqli_num_rows($result);

    if ($count == 1) {$response = mysqli_fetch_row($result); }
    else {
       // echo json_encode($invalidCredsResponse);
        //mysqli_close($db);
        //exit;
        $response = "fail";
        }
    echo json_encode($response);


}
mysqli_close($db);
