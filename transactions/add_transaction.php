<?php
include '../database/db_config.php';

if (isset($_POST['status'])) {
    $user = $_POST['user_id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $additional_info = $_POST['additional_info'];

    $querySQL = "INSERT INTO `transactions`(`user_id`, `title`, `date`, `type`, `amount`, `additional_info`) VALUES (?,?,?,?,?,?)";
    $stmt = $conn->prepare($querySQL);

    if ($stmt) {
        $stmt->bind_param('isssds', $user, $title, $date, $type, $amount, $additional_info);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $myObj = new stdClass();
            $myObj->status = 1;
            $myObj->message = "Transaksi berhasil";
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
} else {
    $myObj = new stdClass();
    $myObj->status = 0;
    $myObj->message = "Gagal menambahkan transaksi";
    echo json_encode($myObj);
}
