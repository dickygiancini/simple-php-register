<?php

require '../utils/conn.php';

if(!isset($_GET['country_id'])) {
    return "Country must be selected first";
}

$query = "SELECT id, country_code FROM mst_country_code WHERE country_id = ?";
$statement = $mysqli->prepare($query);
$statement->bind_param("i", $_GET['country_id']);
$statement->execute();
$result = $statement->get_result();

$codes = [];

if($result) {
    if($result->num_rows > 0) {
        $codes = $result->fetch_all(MYSQLI_ASSOC);

        $result->close();
    }
}

$mysqli->close();

echo json_encode($codes);
?>