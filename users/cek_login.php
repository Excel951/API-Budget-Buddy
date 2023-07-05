<?php
include "../database/db_config.php";

$response = array();

// if (isset($_POST['login'])) {
if (isset($_POST['email']) && isset($_POST['password'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "select * from users where email= '$email' and password='$password'";
  $result = mysqli_query($conn, $sql);


  if (mysqli_num_rows($result) > 0) {
    $response['users'] = array();
    while ($row = mysqli_fetch_array($result)) {

      $item = array();
      $item['user_id'] = $row['user_id'];
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
    $response["message"] = "Failed to login, invalid email or password";
  }

  echo json_encode($response);
  exit();
}
// }

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="" method="post">
    <label for="email">email : </label><br>
    <input type="text" name="email" id="email"><br>
    <label for="password">Password : </label><br>
    <input type="text" name="password" id="password"><br>
    <input type="submit" value="login" name="login">
  </form>
</body>

</html>