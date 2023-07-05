<?php

include "../database/db_config.php";

$response = array();

$sql = "SELECT * FROM users";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $response['users'] = array();
  while ($row = mysqli_fetch_array($result)) {

    $item = array();
    $item['id'] = $row['user_id'];
    $item['fullname'] = $row['fullname'];
    $item['email'] = $row['email'];
    $item['password'] = $row['password'];
    $item['created_at'] = $row['created_at'];
    $item['updated_at'] = $row['updated_at'];

    array_push($response["users"], $item);
  }

  $response["success"] = 1;
} else {
  $response["success"] = 0;
  $response["message"] = "No users found";
}

echo json_encode($response);
exit();
