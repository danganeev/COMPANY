<?php
	$mysqli=mysqli_connect('localhost','root','','COMPANY') or die("Database Error");
    
	$choice = mysqli_real_escape_string($mysqli, $_GET['oldname']);
	
	$query = "SELECT * FROM EMPLOYEE WHERE FullName='$choice'";
	
	$result = mysqli_query($mysqli, $query);
	
	$row = mysqli_fetch_array($result);

    //$('select option:contains("it\'s me")').prop('selected',true);

    //	$_POST['fn'] = $row{'FullName'};
//	$_POST['pn'] = $row{'PositionName'};
//	$_POST['bd'] = $row{'Bdate'};
//	$_POST['s'] = $row{'Sex'};

	 
	//echo $row{'FullName'}. ' '. $row{'PositionName'}. ' '. $row{'Bdate'}. ' '.$row{'Sex'};
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
    <form action="update.php" method="post" id="form" class="form-style">
        <ul>
            <li>
                <label for="fullname">New Name:</label>
                <input name="fullname" value="<?php echo $row{'FullName'}; ?>" type="text" class="field-style field-split align-right" id="fullname" size="30" required/>
            </li>
            <li>
                <label for="position">Position:</label>
                <select name="position" class="field-style field-split align-right" id="position">

                    <?php
$res1 = mysqli_query($mysqli, "select PositionName from POSITIONS");
 
while ($row0 = mysqli_fetch_array($res1))
    {
?>
                        <option value="<?php echo $row0['PositionName'];?>" <?php if ($row0[ 'PositionName']==$ row[ 'PositionName']) echo "selected = 'selected'"; ?>>
                            <?php echo $row0["PositionName"];?>
                        </option>

                        <?php    
    }
?>
                </select>
            </li>
            <li>
                <label for="bdate">Year of birth:</label>
                <input name="bdate" value="<?php echo $row{'Bdate'}; ?>" type="text" class="field-style field-split align-right" id="bdate" size="4" maxlength="4" required/>
            </li>
            <li>
                <label for="sex">Sex:</label>
                <select name="sex" class="field-style field-split align-right">
                    <option value="M" <?php if ($row[ 'Sex']=='M' ) echo "selected = 'selected'"; ?>>M</option>
                    <option value="F" <?php if ($row[ 'Sex']=='F' ) echo "selected = 'selected'"; ?>>F</option>
                </select>
            </li>
        </ul>
    </form>

    </html>