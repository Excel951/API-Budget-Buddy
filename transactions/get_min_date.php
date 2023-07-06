<?php
include '../database/db_config.php';

if (isset($_POST['user_id'])) {
    $user = $_POST['user_id'];


    $querySQL = "SELECT COALESCE(MIN(YEAR(date)),0) as MIN_YEAR, COALESCE(MIN(MONTH(date)),0) as MIN_MONTH FROM `transactions` WHERE user_id=?";

    $stmt = $conn->prepare($querySQL);

    if ($stmt) {
        $stmt->bind_param('i', $user);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                if ($row['MIN_YEAR'] !== 0 || $row['MIN_MONTH'] !== 0) {
                    $rows[] = $row;
                    $kosong = false;
                } else {
                    $kosong = true;
                }
            }

            if ($kosong) {
                $myObj = new stdClass();
                $myObj->status = 0;
                $myObj->message = "Tidak ada transaksi";
            } else {
                $myObj = new stdClass();
                $myObj->status = 1;
                $myObj->message = "Get Minimal Tanggal Transaksi Berhasil";
                $myObj->data = $rows;
            }
        } else {
            $myObj = new stdClass();
            $myObj->status = 0;
            $myObj->message = "Tidak ada transaksi";
        }
    } else {
        $myObj = new stdClass();
        $myObj->status = 0;
        $myObj->message = "Error preparing statement for transaction: .$conn->error";
    }
} else {
    $myObj = new stdClass();
    $myObj->status = 0;
    $myObj->message = "Gagal mencari transaksi. Parameter yang dibutuhkan tidak ada";
}
echo json_encode($myObj);
