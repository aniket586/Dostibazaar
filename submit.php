<?php
// Azure SQL connection details
$serverName = "dbdosti.database.windows.net";
$connectionOptions = array(
    "Database" => "dostidb",
    "Uid" => "dosti",
    "PWD" => "Bazaar123"
);

// Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Get form data
$email = $_POST['username']; // Assuming 'username' is for email
$pass = $_POST['password'];
$confpass = $_POST['confpassword']; // Use 'confpassword' to differentiate from 'password'

$tsql = "INSERT INTO Users (email, pass, confpass) VALUES (?, ?, ?)";
$params = array($email, $pass, $confpass);
$stmt = sqlsrv_query($conn, $tsql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

echo "Data submitted successfully";

// Close the connection
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>

?>
