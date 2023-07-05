<?php

include "../database/db_config.php";

$sql = "SELECT * FROM users_21410100050";

$result = mysqli_query($conn, $sql);

echo "<h1>Daftar Item</h1>";
echo "<div><a href='add_user.php'><button>+</button></a><a href='cek_login.php'><button>Cek Login</button></a></div>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Name</th><th>Username</th><th>PW</th><th>Action</th></tr>";
echo "<tbody>";

if (mysqli_num_rows($result) > 0) {
  $response["orders"] = array();
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["nama"] . "</td>";
    echo "<td>" . $row["username"] . "</td>";
    echo "<td>" . $row["password"] . "</td>";
    echo "<td>";
    echo "<a href='update_user.php?id=" . $row["id"] . "'><button>U</button></a>";
    echo "<div style='display:inline-block; width:10px;'></div>";
    echo "<a href='delete_user.php?id=" . $row["id"] . "'><button>-</button></a>";
    echo "</td>";
    echo "</tr>";
    $item = array();

    $item['id'] = $row['id'];
    $item['nama'] = $row['nama'];
    $item['username'] = $row['username'];
    $item['password'] = $row['password'];

    array_push($response["orders"], $item);
  }
  $response["success"] = 1;
} else {
  $response["success"] = 0;
  $response["message"] = "No items found";
}
// echo json_encode($response);
// echo "<div style='display:inline-block; width:10px;'></div>";
// echo "<a href='fetch_data.php'><button>fetch</button></a>";
