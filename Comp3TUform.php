/*<?php
    require_once 'functions.php';
    // connect to the database
    $conn = mysqli_connect("localhost", "root", "",'chinook');
writeHead("Desired Comp3.4-3.5: Update Employee");
        // check to see if the form has been submitted if so write out the data.
        if (isset($_POST['update'])) {
        // set the validation flag
        $valid = true;
        // retrieve the values from the form.
        $eid = $_POST['eid'];
        $firstname = mysqli_real_escape_string($conn, trim($_POST['firstname']));
        if (empty($firstname)) {
            echo "<p class='error'>Please enter your first name</p>";
            $valid = false;
        }
		if(strlen($name
        $name = mysqli_real_escape_string($conn, trim($_POST['lastname']));
        if (empty($lastname)) {
            echo "<p class='error'>Please enter your last name</p>";
            $valid = false;
        }
        // convert the firstname and lastname to lowercase and capitalize the first letter
        $firstname = ucfirst(strtolower($firstname));
        $lastname = ucfirst(strtolower($lastname));
        $reportsto = $_POST['reportsto'];
        $title = mysqli_real_escape_string($conn, trim($_POST['title']));
        if (empty($title)) {
            echo "<p class='error'>Please enter a title</p>";
            $valid = false;
        }
        $bmo = mysqli_real_escape_string($conn, trim($_POST['bmo']));
        if (empty($bmo)) {
            echo "<p class='error'>Please enter a birth month</p>";
            $valid = false;
        }
        if ($bmo<1 or $bmo>12) {
            echo "<p class='error'>Birth month must be between 1 and 12</p>";
            $valid = false;
        }
        $bday = mysqli_real_escape_string($conn, trim($_POST['bday']));
        if (empty($bday)) {
            echo "<p class='error'>Please enter a birth day</p>";
            $valid = false;
        }

        if ($bday<1 or $bday>31) {
            echo "<p class='error'>Birth day must be between 1 and 31</p>";
            $valid = false;
        }
        $byr = mysqli_real_escape_string($conn, trim($_POST['byr']));
        if (empty($byr)) {
            echo "<p class='error'>Please enter a birth year</p>";
            $valid = false;
        }

        if ($byr<1900 or $byr>2015) {
            echo "<p class='error'>Birth year must be between 1900 and the present</p>";
            $valid = false;
        }
        $hmo = mysqli_real_escape_string($conn, trim($_POST['hmo']));
        if (empty($hmo)) {
            echo "<p class='error'>Please enter a hire month</p>";
            $valid = false;
        }
        if ($hmo<1 or $hmo>12) {
            echo "<p class='error'>Hire month must be between 1 and 12</p>";
            $valid = false;
        }
        $hday = mysqli_real_escape_string($conn, trim($_POST['hday']));
        if (empty($hday)) {
            echo "<class='error'>Please enter a hire day</p>";
            $valid = false;
        }

        if ($hday<1 or $hday>31) {
            echo "<p class='error'>Hire day must be between 1 and 31</p>";
            $valid = false;
        }
        $hyr = mysqli_real_escape_string($conn, trim($_POST['hyr']));
        if (empty($hyr)) {
            echo "<p class='error'>Please enter a hire year</p>";
            $valid = false;
        }

        if ($hyr<1900 or $hyr>2015) {
            echo "<p class='error'>Hire year must be between 1900 and the present</p>";
            $valid = false;
        }
        $address = mysqli_real_escape_string($conn, trim($_POST['address']));
        if (empty($address)) {
            echo "<p class='error'>Please enter a password</p>";
            $valid = false;
        }
        $city = mysqli_real_escape_string($conn, trim($_POST['city']));
        if (empty($city)) {
            echo "<p class='error'>Please enter a city</p>";
            $valid = false;
        }
        $state = mysqli_real_escape_string($conn, trim($_POST['state']));
        if (empty($state)) {
            echo "<p class='error'>Please enter a state</p>";
            $valid = false;
        }
        $country = mysqli_real_escape_string($conn, trim($_POST['country']));
        if (empty($country)) {
            echo "<p class='error'>Please enter a country</p>";
            $valid = false;
        }
        $zip = mysqli_real_escape_string($conn,trim($_POST['zipcode']));
        // test zip codeto make sure it is numeric
        if (!is_numeric($zip)) {
            echo "<p class='error'>Postal code must be numeric</p>";
            $valid = false;
        }
        if (!preg_match('/\d{5}(-\d{4})?/',$zip)) {
            echo "<p class='error'>Invalid postal code.</p>";
        }
        $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
        if (empty($phone)) {
            echo "<p class='error'>Please enter your phone</p>";
            $valid = false;
        }
        if (!preg_match('/\D*([2-9]\d{2})(\D*)([2-9]\d{2})(\D*)(\d{4})\D*/',$phone)) {
            echo "<p class='error'>Invalid phone</p>";
        }
        $fax = mysqli_real_escape_string($conn, trim($_POST['fax']));
        if (empty($fax)) {
            echo "<p class='error'>Please enter your fax</p>";
            $valid = false;
        }
        if (!preg_match('/\D*([2-9]\d{2})(\D*)([2-9]\d{2})(\D*)(\d{4})\D*/',$fax)) {
            echo "<p class='error'>Invalid fax</p>";
        }

        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
        if (empty($email)) {
            echo "<p class='error'>Please enter your email</p>";
            $valid = false;
        }
        if (!preg_match('/[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}/',$email)) {
            echo "<p class='error'>Invalid email address</p>";
        }
  // if the data is valid, update the database and transfer to the display page
        if ($valid) {
            $birthdate = "$byr-$bmo-$bday 00:00:00";
            $hiredate = "$hyr-$hmo-$hday 00:00:00";
            $query = "update employee set LastName='$lastname', FirstName='$firstname', Title='$title', ReportsTo=$reportsto, BirthDate='$birthdate', HireDate='$hiredate', Address='$address',City='$city',State='$state',Country='$country',PostalCode='$zip',Phone='$phone',Fax='$fax',Email='$email' where EmployeeId=$eid";
            mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_affected_rows($conn)>0) {
                header("Location:Comp3TblUpdate.php?action=updated&id=$eid");
                exit();
            }
            echo "<p class='error'>Unable to update record</p>";
        }
    } else {
// if the form was not submitted, get the id from the querystring and retrieve the data from the database
        if (!isset($_GET['eid'])) {
            echo "<p class='error'>No Employee ID provided. <a href='Comp3TblUpdate.php'>Return to display page.</a>";
        }
        $eid=$_GET['eid'];
        $query = "Select * from employee where EmployeeId = $eid";
        $result = mysqli_query($conn,$query);
        if (!$result) {
            die(mysqli_error($conn));
        }
        // check for results
        if (mysqli_num_rows($result)> 0) {
            // retrieve result row
            $row = mysqli_fetch_assoc($result);
            $firstname=$row['FirstName'];// FirstName is from Database table
            $lastname=$row['LastName'];
            $email=$row['Email'];
            $zip=$row['PostalCode'];
            $title=$row['Title'];
            $reportsto=$row['ReportsTo'];
            $birthdate=$row['BirthDate'];
            $hiredate=$row['HireDate'];
            $bmo=substr($birthdate,5,2);
            $bday=substr($birthdate,8,2);
            $byr=substr($birthdate,0,4);
            $hmo=substr($hiredate,5,2);
            $hday=substr($hiredate,8,2);
            $hyr=substr($hiredate,0,4);
            $address=$row['Address'];
            $city=$row['City'];
            $state=$row['State'];
            $country=$row['Country'];
            $phone=$row['Phone'];
            $fax=$row['Fax'];
        } else {
            echo "<p class='error'>Unable to retrieve employee $eid. <a href='Comp3TblUpdate.php'>Return to display page.</a>";
        }
    }
?>
        <form method="post" action="Comp3TUform.php">
            <p>
                <input type="hidden" name="eid" value="<?php echo $eid ?>">;
                <label for="firsname">First name</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>">
                <label for="lastname">Last name</label>
                <input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>">
            </p>

            <p>
                <label for="title">Title:</label>
                <input type="text" name="title" id="title"  value="<?php echo $title; ?>">
            </p>
            <p>
                <label for="reportsto">Reportsto:</label>
                <select name="reportsto" id="reportsto">
                    <?php
                    // create the query to populate dropdown list with existing employees
                    $query = "Select EmployeeId, FirstName, LastName from Employee";
                    // run the query
                    $result = mysqli_query($conn,$query);
                    // check for errors
                    if (!$result) {
                        die(mysqli_error($conn));
                    }
                    // check for results
                    if (mysqli_num_rows($result)> 0) {
                    // loop through results and display as an option.

                    while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='".$row['EmployeeId']."'";
                            // check to see if the employee id matches the reports to id for this employee.
                            if ($reportsto==$row['EmployeeId']) {
                                   echo " selected ";
                             }
                            echo ">".$row['FirstName']." ".$row['LastName']."</option>";
                    }

                }


                
                    ?>
                </select>
            </p>
            <p>
                Birth Date:
                <input type="text" name="bmo" id="bmo" value="<?php echo $bmo; ?>" size="2">
                <input type="text" name="bday" id="bday" value="<?php echo $bday; ?>" size="2">
                <input type="text" name="byr" id="byr" value="<?php echo $byr; ?>" size="4">

            </p>
            <p>
                Hire Date:
                <input type="text" name="hmo" id="hmo" value="<?php echo $hmo; ?>" size="2">
                <input type="text" name="hday" id="hday" value="<?php echo $hday; ?>" size="2">
                <input type="text" name="hyr" id="hyr" value="<?php echo $hyr; ?>" size="4">

            </p>
            <label for="address">Address</label>
                <input type="text" name="address" id="address" value="<?php echo $address; ?>">
            </p>
            <label for="city">city</label>
                <input type="text" name="city" id="city" value="<?php echo $city; ?>">
            </p>
            <label for="state">State</label>
                <input type="text" name="state" id="state" value="<?php echo $state; ?>" size="2">
            </p>
            <label for="country">Country</label>
                <input type="text" name="country" id="country" value="<?php echo $country; ?>">
            </p>
            <p>
                <label for="zip">Postal Code</label>
                <input type="text" name="zipcode" id="zip" value="<?php echo $zip; ?>">
            </p>
            <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>">
            </p>
            <label for="fax">Fax</label>
                <input type="text" name="fax" id="fax" value="<?php echo $fax; ?>">
            </p>
            <p>
                <label for="email">Email address:</label>
                <input type="email" name="email" id="email" value="<?php echo $email; ?>">
            </p>
            <p>
<input type="submit" name="update" value="Update Employee">
            </p>
        </form>
		
      <?php writeFoot(); ?>
		
		
		
		
		<?php
     require_once 'functions.php';
    // connect to the database
    $conn = mysqli_connect("localhost", "root", "",'chinook');
    writeHead("Desired Comp3.4-3.5: Update Employee");
        // check to see if the form has been submitted if so write out the data.
    if (isset($_POST['delete'])) {
        $eid = $_POST['eid'];
        $query = "delete from employee where EmployeeId=$eid";
        mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_affected_rows($conn)>0) {
                header("Location:Comp3TblUpdate.php?action=deleted&id=$eid");
                exit();
            }
            echo "<p class='error'>Unable to update record</p>";
    } else {
        // if the form was not submitted, get the id from the querystring and retrieve the data from the database
        if (!isset($_GET['eid'])) {
            echo "<p class='error'>No Employee ID provided. <a href='Comp3TblUpdate.php'>Return to display page.</a>";
        }
        $eid=$_GET['eid'];
        $query = "Select * from employee where EmployeeId = $eid";
        $result = mysqli_query($conn,$query);
        if (!$result) {
            die(mysqli_error($conn));
        }
        // check for results
        if (mysqli_num_rows($result)> 0) {
            // retrieve result row
            $row = mysqli_fetch_assoc($result);
            $firstname=$row['FirstName'];
            $lastname=$row['LastName'];
            $email=$row['Email'];
            $title=$row['Title'];
        } else {
            echo "<p class='error'>Unable to retrieve employee $eid. <a href='Comp3TblUpdate.php'>Return to display page.</a>";
        }
    }
?>
        <p>Employee Information</p>
        <p><?php echo "$firstname $lastname <br>$title<br>$email"; ?></p>
        <form method="post" action="Comp3TUform.php">
            <p>
                <input type="hidden" name="eid" value="<?php echo $eid; ?>">
                <input type="submit" name="delete" value="Confirm Delete">
            </p>
        </form>
        <p>Return to <a href="Comp3TblUpdate.php">Employee Display</a></p>
        <?php writeFoot(); ?>
