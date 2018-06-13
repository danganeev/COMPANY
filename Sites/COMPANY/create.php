<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Create an employee</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(function () {

            $("#fullname").bind("change keypress paste click", function () {
                setTimeout(function () {
                    //get the value of the input text
                    var data = $('#fullname').val();
                    //replace the special characters to '' 
                    var dataFull = data.replace(/[^a-zA-Zа-яА-ЯїЇєЄіІёЁ\s-]/gi, '');
                    //set the new value of the input text without special characters
                    $('#fullname').val(dataFull);
                });

            });
        });
        $(function () {

            $("#bdate").bind("change keypress paste click", function () {
                setTimeout(function () {
                    //get the value of the input text
                    var data = $('#bdate').val();
                    //replace the special characters to '' 
                    var dataFull = data.replace(/[^0-9]|\./gi, '');
                    //set the new value of the input text without special characters
                    $('#bdate').val(dataFull);
                });

            });
        });


        //        function validatename(evt){
        //            var theEvent = evt || window.event;
        //            var key = theEvent.keyCode || theEvent.which;
        //            key = String.fromCharCode(key);
        //            var regexp = /^[a-zA-Zа-яА-ЯїЇєЄіІёЁ\s]*$/; 
        //            if (!regexp.test(key)) {
        //                theEvent.returnValue = false;
        //                if (theEvent.preventDefault) theEvent.preventDefault();
        //            }
        //        }
        //            
        //        function validate(evt) {
        //            var theEvent = evt || window.event;
        //            var key = theEvent.keyCode || theEvent.which;
        //            key = String.fromCharCode(key);
        //            var regex = /[0-9]|\./;
        //            if (!regex.test(key)) {
        //                theEvent.returnValue = false;
        //                if (theEvent.preventDefault) theEvent.preventDefault();
        //            }
        //        }
    </script>
</head>

<body>

    <?php
$mysqli=mysqli_connect('localhost','root','','COMPANY') or die("Database Error");
    
$add = @$_POST['add'];
//declaring variables to prevent errors
$name = ""; //Full Name
$position = ""; //Position
$year = ""; //Birth year
$sex = ""; // Sex
$e_check = "";    

    
class employee {
		var $name;
        var $position;
        var $year;
        var $sex;
		function __construct($n, $p, $y, $s) {		
			$this->name = $n;
            $this->position = $p;
            $this->year=$y;
            $this->sex=$s;
		}		
 
		function set_name($new_n) {
		 	 $this->name = $new_n;
		}
        function set_position($new_p) {
		 	 $this->position = $new_p;
		}
        function set_year($new_y) {
		 	 $this->year = $new_y;
		}
        function set_sex($new_s) {
		 	 $this->sex = $new_s;
		}
 
		function get_name() {		
		 	 return $this->name;		
		 }
        function get_position() {		
		 	 return $this->position;		
		 }
        function get_year() {		
		 	 return $this->year;		
		 }
        function get_sex() {		
		 	 return $this->sex;		
		 }
 }    
    
$new_employee= new employee(strip_tags(@$_POST['fullname']), strip_tags(@$_POST['position']), strip_tags(@$_POST['bdate']), strip_tags(@$_POST['sex']));

    
//form
$name = strip_tags(@$_POST['fullname']);
$position = strip_tags(@$_POST['position']);
$year = strip_tags(@$_POST['bdate']);
$sex = strip_tags(@$_POST['sex']);

if ($add) {

if ((empty($_POST['fullname'])) || (empty($_POST['position'])) || (empty($_POST['bdate'])) || (empty($_POST['sex']))){
    echo "Please fill in all the fields!";
}
else if (!preg_match('/^[a-zA-Zа-яА-ЯїЇєЄіІёЁ\s-]*$/u', $new_employee->name, $match)){
    echo "Name can consist of letters and spaces only";
}       
else if ($new_employee->year<1900 || $new_employee->year>2004 || !preg_match('/^[0-9]*$/', $new_employee->year, $match)){
    echo "Check the year of birth";
}    
else{    
$e_check = mysqli_query($mysqli, "SELECT FullName FROM EMPLOYEE WHERE FullName='$new_employee->name'");
// Count the amount of rows where user_nicename = $un
$check = mysqli_num_rows($e_check);

//check if employee with such name exists    
if ($check == 0) {
    
//if no create a new one    
$query = "INSERT INTO EMPLOYEE(FullName, PositionName, Bdate, Sex) VALUES('$new_employee->name','$new_employee->position', '$new_employee->year','$new_employee->sex')";
$res = mysqli_query($mysqli, $query);
echo "New employee '$new_employee->name' created";
    
}
else{
    
//if yes forward to update page
echo "Employee '$new_employee->name' already exists. Instead, you can <a href='update.php'>update</a> the existing one";    
}    
}
}
?>

        <br>
        <br>
        <h1 style="text-align: center;">Create an employee</h1>
        <div class="create_employee">
            <form action="create.php" method="post" id="form" class="form-style">
                <ul>
                    <li>
                        <label for="fullname">Full Name:</label>
                        <input name="fullname" type="text" class="field-style field-split align-right" id="fullname" size="30" required/>
                    </li>
                    <li>
                        <label for="position">Position:</label>
                        <select name="position" class="field-style field-split align-right" id="position">

                            <?php
$res0 = mysqli_query($mysqli, "select PositionName from POSITIONS");
 
while ($row = mysqli_fetch_array($res0))
    {
?>
                                <option value="<?php echo $row['PositionName'];?>">
                                    <?php echo $row["PositionName"];?>
                                </option>

                                <?php    
    }
?>
                        </select>
                    </li>
                    <li>
                        <label for="bdate">Year of birth:</label>
                        <input name="bdate" type="text" class="field-style field-split align-right" id="bdate" size="4" maxlength="4" required/>
                    </li>
                    <li>
                        <label for="sex">Sex:</label>
                        <select name="sex" class="field-style field-split align-right">
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                    </li>

                    <li>
                        <input name="add" type="submit" value="Submit" />
                    </li>
                </ul>
            </form>
        </div>
        <p style="text-align: center;"><a href="update.php">Update an employee</a> </p>
        <p style="text-align: center;"><a href="view.php">View Employees</a></p>
</body>

</html>