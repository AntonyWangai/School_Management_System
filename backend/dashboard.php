<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dataBaseName = "school_management";

// Retrieve email from URL parameter
$email = isset($_GET['email']) ? $_GET['email'] : '';

// Database connection
$conn = new mysqli($serverName, $userName, $password, $dataBaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details
$sql = "SELECT * FROM signup WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>
    <h2>WELCOME : <?php echo $row['fullname']; ?></h2>
    The following is your details:
    <div class="form-content">
        <div class="content">
            <i class="fa-solid fa-user"></i>Basic Information
            <table>
                <tr>
                    <th>Registration Number</th>
                    <td><?php echo $row['regno']; ?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?php echo $row['fullname']; ?></td>
                </tr>
                <tr>
                    <th>National ID Number</th>
                    <td><?php echo $row['nationalid']; ?></td>
                </tr>
                <tr>
                    <th>KCSE Index Number</th>
                    <td><?php echo $row['ksce']; ?></td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td><?php echo $row['birthdate']; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $row['email']; ?></td>
                </tr>
            </table>
        </div>
        <div>
            Incase of any questions or complaints, reach us out in the ict office or email us at <a href="contact.html">Contact Us</a> 
        </div>
    <?php
} else {
    echo "0 results";
}
$conn->close();
?>
