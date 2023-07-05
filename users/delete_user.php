<?php

include "../database/db_config.php";

$response = array();

if (isset($_GET["id"])) {
  $id = $_GET["id"];

  $result = mysqli_query($conn, "delete from  users where user_id='$id'");

  if ($result) {
    $response["success"] = 1;
    $response["message"] = "successfully delete";
  } else {
    $response["success"] = 0;
    $response["message"] = "failed to delete";
  }
  echo json_encode($response);
  exit();
}
