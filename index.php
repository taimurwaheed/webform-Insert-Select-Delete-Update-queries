<?php
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Age = $_POST['Age'];
    $Designation = $_POST['Designation'];

    define('dbHostname', 'localhost');
    define('dbUsername', 'root');
    define('dbPassword', '');
    define('dbName', 'fabscs23');

    $con = new mysqli(dbHostname,dbUsername,dbPassword,dbName);

    if($con->connect_error)
    {
            die("Connection Error".$con->connect_error);
    }

    $qry = "INSERT INTO webform (FirstName,LastName,Age,Designation) VALUES ('".$FirstName."','".$LastName."','".$Age."','".$Designation."')";

    $result = $con->query($qry);
    if($result) {
        header("Location: ./select.php");
        // echo"Data Successfully Saved";
    }
    else {
        echo"Data Unsuccessful";
    }

    $con->close();

?>