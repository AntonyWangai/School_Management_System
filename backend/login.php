<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$serverName = "localhost";
$userName = "root";
$password = "";
$dataBaseName = "school_management";

$conn = new mysqli($serverName, $userName, $password, $dataBaseName);

if ($conn->connect_error) {
    $response = array("status" => "error", "message" => "Connection failed: " . $conn->connect_error);
    echo json_encode($response);
    exit(); // Stop script execution if connection fails
}

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM signup WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($password === $row['password']) { // Compare passwords
        $response = array("status" => "success", "fullname" => $row["fullname"]);
        echo json_encode($response);
    } else {
        $response = array("status" => "error", "message" => "Invalid password");
        echo json_encode($response);
    }
} else {
    $response = array("status" => "error", "message" => "User not found");
    echo json_encode($response);
}

$stmt->close();
$conn->close();
?>
