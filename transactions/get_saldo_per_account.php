<?php
include '../database/db_config.php';

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    $querySQL = "SELECT u.user_id, u.fullname, 
                    COALESCE(SUM(CASE WHEN t.type = 'Masuk' THEN t.amount ELSE 0 END), 0) -
                    COALESCE(SUM(CASE WHEN t.type = 'Keluar' THEN t.amount ELSE 0 END), 0) AS saldo
                FROM Users u
                LEFT JOIN Transactions t ON u.user_id = t.user_id
                WHERE u.user_id = ?
                GROUP BY u.fullname;
                ";

    $stmt = $conn->prepare($querySQL);

    if ($stmt) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // $rows = array();
            while ($row = $result->fetch_assoc()) {
                // $rows[] = $row;
                $data = $row;
            }

            $myObj = new stdClass();
            $myObj->status = 1;
            $myObj->message = "Get saldo berhasil";
            $myObj->data = $data;
        } else {
            $myObj = new stdClass();
            $myObj->status = 0;
            $myObj->message = "User yang dicari tidak dapat ditemukan";
        }
    } else {
        $myObj = new stdClass();
        $myObj->status = 0;
        $myObj->message = "Error preparing statement for transaction: .$conn->error";
    }
} else {
    $myObj = new stdClass();
    $myObj->status = 0;
    $myObj->message = "Saldo tidak dapat diambil. Parameter kurang";
}
echo json_encode($myObj);
