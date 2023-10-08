<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Products</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="./index.html">Add New Record</a>
    <table>
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Designation</th>    
        </tr> 

        <?php
            define('dbHostname', 'localhost');
            define('dbUsername', 'root');
            define('dbPassword', '');
            define('dbName', 'fabscs23');

            $con = new mysqli(dbHostname,dbUsername,dbPassword,dbName);

            if($con->connect_error)
            { 
                die("Connect Error ".$con->connect_error);
            }

            $qry = "SELECT * FROM webform";

            $result = $con->query($qry);

            while($row=$result->fetch_assoc()){
                echo "<tr>
                    <td>".$row['Id']."</td>
                    <td>".$row['FirstName']."</td>
                    <td>".$row['LastName']."</td>
                    <td>".$row['Age']."</td>
                    <td>".$row['Designation']."</td>
                    <td>
                        <a href='./edit.php?Id=".$row['Id']."'>Edit</a>
                    </td>
                </tr>";
            }
            $con->close();
        ?>
    </table>
</body>
</html>