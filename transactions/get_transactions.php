<?php
include '../database/db_config.php';

$querySQL = "SELECT * FROM `transactions`";
$stmt = $conn->prepare($querySQL);

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
        echo json_encode($myObj);
    } else {
        $myObj = new stdClass();
        $myObj->status = 1;
        $myObj->message = "Transaksi gagal";
        echo json_encode($myObj);
    }
} else {
    $myObj = new stdClass();
    $myObj->status = 0;
    $myObj->message = "Error preparing statement for transaction: .$conn->error";
    echo json_encode($myObj);
}
