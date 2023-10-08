<?php
ob_start();

$Id = $_GET['Id'];

if (!isset($Id)) {
    header("location: ./select.php");
    exit();
}

define('dbHostname', 'localhost');
define('dbUsername', 'root');
define('dbPassword', '');
define('dbName', 'fabscs23');

$con = new mysqli(dbHostname, dbUsername, dbPassword, dbName);

if ($con->connect_error) {
    die("Connect Error " . $con->connect_error);
}

$qry = "SELECT * FROM webform WHERE Id='" . $Id . "'";

$result = $con->query($qry);
$row = $result->fetch_assoc();

if (!isset($row)) {
    header("location: ./select.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        // Update operation (similar to your existing update code)
        $FirstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        $Agee = $_POST['Age'];
        $Designation = $_POST['Designation'];

        $qry = "UPDATE webform SET
                FirstName = '$FirstName',
                LastName = '$LastName',
                Age = '$Agee',
                Designation = '$Designation'
                WHERE Id='$Id'";

        $result = $con->query($qry);

        if ($result) {
            header("Location:./select.php");
            exit();
        } else {
            echo "Data update failed";
        }
    } elseif (isset($_POST['delete'])) {
        // Delete operation
        $qry = "DELETE FROM webform WHERE Id='" . $Id . "'";
        $result = $con->query($qry);

        if ($result) {

            // Reset the auto-increment counter
            $resetAutoIncrementQry = "ALTER TABLE webform AUTO_INCREMENT = 1";
            $con->query($resetAutoIncrementQry);

            header("Location:./select.php");
            exit();
        } else {
            echo "Data deletion failed";
        }
    }
}

$con->close();

ob_end_flush();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User Record</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="./update.php" method="post">
        <input type="hidden" name="Id" value="<?php echo isset($row['Id'])?$row['Id']:''?>">
        <br>

        <label for="FirstName">First name</label>
        <input type="text" id="FirstName"  name="FirstName" value="<?php echo isset($row['FirstName'])?$row['FirstName']:''?>">
        <br>

        <label for="LastName">Last Name</label>
        <input type="text" id="LastName"  name="LastName" value="<?php echo isset($row['LastName'])?$row['LastName']:''?>">
        <br>

        <label for="Age">Age</label>
        <input type="number" id="Age" name="Age" value="<?php echo isset($row['Age']) ? $row['Age'] : ''?>">
        <br>    

        <label for="Designation">Designation</label>
        <input type="text" id="Designation"  name="Designation" value="<?php echo isset($row['Designation'])?$row['Designation']:''?>">
        <br>

        <input type="submit" name="save" id="save" value="Update">
        <br>
    </form> 
    <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this record?')">
        <input type="hidden" name="Id" value="<?php echo isset($row['Id']) ? $row['Id'] : '' ?>">
        <button type="submit" name="delete">Delete</button>
    </form>
</body>
</html>