<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$serverName = "localhost";
$userName = "root";
$password = "";
$dataBaseName = "school_management";

// Check if all required POST variables are set
if (
    isset($_POST['fullname']) &&
    isset($_POST['regno']) &&
    isset($_POST['nationalid']) &&
    isset($_POST['ksce']) &&
    isset($_POST['birthdate']) &&
    isset($_POST['email']) &&
    isset($_POST['password'])
) {
    // Create connection
    $conn = new mysqli($serverName, $userName, $password, $dataBaseName);

    // Check connection
    if ($conn->connect_error) {
        $response = array("status" => "error", "message" => "Connection failed: " . $conn->connect_error);
        echo json_encode($response);
    } else {
        $name = $_POST['fullname'];
        $reg = $_POST['regno'];
        $nationalid = $_POST['nationalid'];
        $ksce = $_POST['ksce'];
        $birthdate = $_POST['birthdate'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("INSERT INTO signup (fullname, regno, nationalid, kcse, birthdate, email, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $reg, $nationalid, $ksce, $birthdate, $email, $password);

        // Execute the statement
        if ($stmt->execute()) {
            // Data successfully added to the database
            $response = array("status" => "success", "message" => "Welcome " . $name . "! New record created successfully");
            echo json_encode($response);
        } else {
            // Error occurred
            $response = array("status" => "error", "message" => "Error: " . $stmt->error);
            echo json_encode($response);
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} else {
    $response = array("status" => "error", "message" => "Required POST variables are missing");
    echo json_encode($response);
}
?>
