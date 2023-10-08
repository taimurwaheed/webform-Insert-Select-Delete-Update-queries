<?php
$Id = $_POST['Id'];
$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$Age = $_POST['Age'];
$Designation = $_POST['Designation'];

define('dbHostname', 'localhost');  
define('dbUsername', 'root');
define('dbPassword', '');
define('dbName', 'fabscs23');

$con = new mysqli(dbHostname,dbUsername,dbPassword,dbName);

if ($con->connect_error) {
    die("Connection Error".$con->connect_error);
}

$qry = "UPDATE webform SET
        FirstName = '$FirstName',
        LastName = '$LastName',
        Age = '$Age',
        Designation = '$Designation'
        WHERE Id='$Id'";

$result = $con->query($qry);

if ($result) {
    // echo "Data has been saved successfully.";
    header("Location:./select.php");
} 
else {
    echo "Data didn't save";
}

$con->close();
?>