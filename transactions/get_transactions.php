<?php
include '../database/db_config.php';

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    $querySQL = "SELECT * FROM `transactions` WHERE `user_id` = ?";
    $stmt = $conn->prepare($querySQL);
    $stmt->bind_param('i', $user_id);

    if ($stmt) {
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }

            $myObj = new stdClass();
            $myObj->status = 1;
            $myObj->message = "Get Transaksi Berhasil";
            $myObj->data = $rows;
        } else {
            $myObj = new stdClass();
            $myObj->status = 0;
            $myObj->message = "Transaksi gagal";
        }
    } else {
        $myObj = new stdClass();
        $myObj->status = 0;
        $myObj->message = "Error preparing statement for transaction: .$conn->error";
    }
} else {
    $myObj = new stdClass();
    $myObj->status = 0;
    $myObj->message = "Parameter yang dibutuhkan kurang";
}
echo json_encode($myObj);
