<?php

include "../database/db_config.php";

$response = array();

$kode_user = $_GET['id'];
// echo $kode_barang;

$sql = "select * from users where user_id= '$kode_user'";
$result = mysqli_query($conn, $sql);
$row  = mysqli_num_rows($result);

if ($row > 0) {
  $data = mysqli_fetch_assoc($result);
  $nama = $data['nama'];
  $username = $data['username'];
  $password = $data['password'];
}

if (isset($_POST['ubah'])) {
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "UPDATE `users_21410100050` SET `nama` = '$nama', `username` = '$username',`password` = '$password' WHERE `users_21410100050`.`id` = $kode_user";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    $response["success"] = 1;
    $response["message"] = "succesfully update";
  } else {
    $response["success"] = 0;
    $response["message"] = "failed to update";
  }
  echo json_encode($response);
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

</html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="" method="post">
    <input type="text" name="item" id="item" value="<?php echo $kode_user; ?>" readonly><br>
    <label for="name">Name : </label>
    <input type="text" name="nama" id="nama" value="<?php echo $nama; ?>"><br>
    <label for="username">Username : </label>
    <input type="text" name="username" id="username" value="<?php echo $username; ?>"><br>
    <label for="password">Password : </label>
    <input type="text" name="password" id="password" value="<?php echo $password; ?>">
    <br>
    <input type="submit" value="ubah" name="ubah">
  </form>
</body>

</html>