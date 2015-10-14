<?php
  include_once('partials/header.html');
  $emp_no = $_GET['emp_no'];
?>
<div class="container">
    <header>
        <div style="margin-top: 10px;">
            <a href='index.php' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-arrow-left'></span> back</a>
        </div>
        <h1>
            Acme Human Resources - Edit Employee
        </h1>
    </header>

<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $fn = $_POST['first_name'];
        $ln = $_POST['last_name'];
        $bd = $_POST['birth_date'];
        $hd = $_POST['hire_date'];
        $g = $_POST['gender'];
        $en = $_POST['emp_no'];

        $empDB = new mysqli('localhost','root','password','employees');
        if($empDB->connect_errno) {
            echo 'Failed to connect to MySQL:(' . $empDB->connect_errno . ') ' . $empDB->connect_error;
            die;
        }

        $query = "UPDATE employees SET first_name = '$fn', last_name = '$ln', gender = '$g', hire_date = '$hd', birth_date = '$bd' WHERE emp_no = '$en' ";


        mysqli_query($empDB, $query);
        $updated = mysqli_affected_rows($empDB);
        if($updated == 1) {
            echo "<div class='well'><p>This Employee has been updated.<p></div>";
        } else {
            echo "<div class='well'>No changes were saved for this employee.  Please try again. <button class='btn btn-danger' onClick='window.history.go(-1);'><span class='glyphicon glyphicon-arrow-left'></span> back</button></div>";
        }

    } else {
        if(isset($_GET['emp_no'])){
    ?>
        <div class="employeeForm">
            <?php
                $empDB = new mysqli('localhost','root','password','employees');
                if($empDB->connect_errno) {
                    echo 'Failed to connect to MySQL:(' . $empDB->connect_errno . ') ' . $empDB->connect_error;
                    die;
                }

                $query = "SELECT first_name,last_name,gender,birth_date,hire_date from employees where emp_no = $emp_no";

                if($result = mysqli_query($empDB, $query)) {

                    $row = mysqli_fetch_assoc($result);
                }
                mysqli_close($empDB);
            ?>

            <div class="editForm">
                <form action="edit_emp.php" id="editForm" name='editForm' method="POST">
                    <div>
                        <label for="emp_no">Employee No: </label><?php echo $emp_no; ?>
                        <input type="hidden" id="emp_no" name="emp_no" value="<?php echo $emp_no; ?>" class="form-control" >
                    </div>


                    <label for="first_name">First Name: </label>
                    <input type="text" id="first_name" name='first_name' class='form-control' value="<?php echo $row['first_name']; ?>">

                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" class='form-control' value="<?php echo $row['last_name']; ?>">

                    <label for="birth_date">Birthday:</label>
                    <input type="text" id="birth_date" name="birth_date" class='form-control' value="<?php echo $row['birth_date']; ?>">

                    <label for="genderRadios">Gender:</label>
                    <div class="radio">
                      <label class='radio-inline'>
                        <input type="radio" name="gender" id="genderRadios1" value="F" <?php if($row['gender'] === 'F'){echo 'checked';} ?>>
                        Female
                      </label>

                      <label class='radio-inline'>
                        <input type="radio" name="gender" id="genderRadios2" value="M" <?php if($row['gender'] === 'M'){echo 'checked';} ?>>
                        Male
                      </label>
                    </div>
                    <hr />
                    <label for="hire_date">Hire Date: </label>
                    <input type="text" id="hire_date" name="hire_date" value="<?php echo $row['hire_date']; ?>">
                    <hr>
                    <div class="controls">
                        <input type="submit" class='btn btn-primary' value='Submit'>
                        <input type="reset" class="btn btn-default" value='Reset'>
                    </div>
                </form>
            </div>

        </div>
<?php
    } else {
        echo "<div class='well'><p>You must specify an employee ID before you can use this form.</p><a href='index.php' class='btn btn-primary'>Back</a>";
    }
}

?>
</div>

<?php
    include_once ('partials/footer.html');
?>
