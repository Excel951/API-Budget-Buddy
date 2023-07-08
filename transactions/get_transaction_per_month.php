<?php
include '../database/db_config.php';

if (isset($_POST['user_id'])) {
    $user = $_POST['user_id'];
    $tanggal = $_POST['tanggal'];

    // diganti dengan bulan
    // if ($_POST['tanggal'] != "null") {
    $querySQL = "SELECT * FROM `transactions` WHERE user_id=? AND DATE_FORMAT(date, '%Y-%m') = DATE_FORMAT(?, '%Y-%m') ORDER BY date ASC";
    // } else {
    //     $querySQL = "SELECT * FROM `transactions` WHERE user_id=? AND DATE_FORMAT(date, '%Y-%m') = DATE_FORMAT(CURRENT_DATE, '%Y-%m') ORDER BY date DESC";
    // }
    $stmt = $conn->prepare($querySQL);

    if ($stmt) {
        // if ($_POST['tanggal'] != "null") {
        $stmt->bind_param('is', $user, $tanggal);
        // } else {
        //     $stmt->bind_param('i', $user);
        // }
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
