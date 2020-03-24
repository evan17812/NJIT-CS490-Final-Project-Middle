<?php

try
{
    $db = new mysqli("localhost", "root", "testpassword", "cs490");
}
  catch (Exception $e)
	{
    $response = "Service Unavailable. Error: " . $e;
    echo json_encode($response);
    exit;
	}
