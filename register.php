<?php
require './utils/conn.php';

if(!$_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Failed to save user data : Bad request";
    header("Location: index.php");
    return exit();
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$address = $_POST['address'];
$province = $_POST['province'];
$city = $_POST['city'];
$zipcode = (int)$_POST['zipcode'];
$country_id = $_POST['country'];
$birth_date = $_POST['birth_date'];
$gender = $_POST['gender'];
$country_code_id = $_POST['country_code'];
$phone = (int)$_POST['phone'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$query = "INSERT INTO users (first_name, last_name, email, address, province, city, zipcode, country_id, birth_date, gender, country_code_id, phone, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$statement = $mysqli->prepare($query);

if (!$statement) {
    echo "Failed to save user info : ".$mysqli->error;
    header("Location: index.php");
    return exit();
}

$statement->bind_param("ssssssiissiis",
    $first_name,
    $last_name,
    $email,
    $address,
    $province,
    $city,
    $zipcode,
    $country_id,
    $birth_date,
    $gender,
    $country_code_id,
    $phone,
    $password
);

if (!$statement->execute()) {
    echo "Failed to save user info 2 : ".$mysqli->error;
    header("Location: index.php");
    return exit();
}

$name = $first_name.' '.$last_name;

session_start();
$_SESSION['user_id'] = $statement->id;
$_SESSION['username'] = $name;

header("Location: dashboard.php");
exit();


?>