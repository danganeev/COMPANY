<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>View employees</title>
    <style>
        body {
            font-family: arial, sans-serif;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
            border-radius: 10px;
            border: 10px solid #305A72;
        }
        
        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        
        tr:nth-child(even) {
            background-color: #dddddd;
        }
        
        .table-hover>tbody>tr:hover {
            background-color: #f5f5f5
        }
        
        .hidden {
            display: none;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        function showhide(that, oldword, newword) {
            $('.hidden').toggle();
            that.textContent = that.textContent == oldword ? newword : oldword;

        }
    </script>
</head>

<body>
    <br>
    <h1 style="text-align: center;">Employees</h1>
    <br>
    <?php
        $mysqli=mysqli_connect('localhost','root','','COMPANY') or die("Database Error");

        $query = "SELECT FullName, PositionName, Bdate, Sex FROM EMPLOYEE";
        $res = mysqli_query($mysqli, $query);

        if ($res->num_rows > 0) {
            echo "<table class='table table-striped table-hover' style='width:70%; margin: auto;'><tr><th>Number</th><th>Name</th><th>Position</th><th class='hidden'>Year of birth</th><th class='hidden'>Sex</th></tr>";
            // output data of each row
            $counter=1;
            while($row = $res->fetch_assoc()) {
                echo "<tr><td>" . $counter. "</td><td>" . $row['FullName']. "</td><td>" . $row['PositionName']. "</td><td class='hidden'>" . $row['Bdate']. "</td><td class='hidden'>" . $row['Sex']. "</td></tr>";
                $counter=$counter+1;
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $mysqli->close();
        ?>
        <p style="text-align: center;"><a href="javascript:void(0)" onclick="return showhide(this,'Show more info','Hide more info');">Show more info</a> </p>
        <br>
        <p style="text-align: center;"><a href="create.php">Create an employee</a> </p>
        <p style="text-align: center;"><a href="update.php">Update an employee</a> </p>
</body>

</html>