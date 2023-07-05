<?php

include "../database/db_config.php";

if (isset($_POST["simpan"])) {
  $response = array();

  if (isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty(trim($fullname)) || empty(trim($email)) || empty(trim($password))) {
      echo "please isi field";
      exit();
    }


    $sql = "INSERT INTO `users` (`user_id`, `fullname`, `email`, `password`, `created_at`, `updated_at`) VALUES (NULL, '$fullname', '$email', '$password', current_timestamp(), current_timestamp())";
    $result = mysqli_query($conn, $sql);

    if ($result > 0) {
      $response["success"] = 1;
      $response["message"] = "success add user!";
    } else {
      $response["success"] = 0;
      $response["message"] = "gagal add user!";
    }

    echo json_encode($response);
    exit();
  }
}
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
    <label for="fullname">fullname : </label>
    <input type="text" name="fullname" id="fullname"><br>
    <label for="email">email : </label>
    <input type="email" name="email" id="email"><br>
    <label for="password">Password : </label>
    <input type="password" name="password" id="password">
    <br>
    <input type="submit" value="simpan" name="simpan">
  </form>
</body>



</html>