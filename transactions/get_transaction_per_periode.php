<?php
include '../database/db_config.php';

if (isset($_POST['status'])) {
    $user = $_POST['user_id'];
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];

    $querySQL = "SELECT * FROM `transactions` WHERE `user_id`=? AND date BETWEEN ? AND ?";
    $stmt = $conn->prepare($querySQL);

    if ($stmt) {
        $stmt->bind_param('iss', $user, $tanggal_awal, $tanggal_akhir);
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
            $myObj->message = "Tidak ada transaksi";
            echo json_encode($myObj);
        }
    } else {
        $myObj = new stdClass();
        $myObj->status = 0;
        $myObj->message = "Error preparing statement for transaction: .$conn->error";
        echo json_encode($myObj);
    }
} else {
    $myObj = new stdClass();
    $myObj->status = 0;
    $myObj->message = "Gagal mencari transaksi";
    echo json_encode($myObj);
}
