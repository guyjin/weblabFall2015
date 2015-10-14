<?php include_once('partials/header.html'); ?>

<?php
  $emp_no = $_GET['emp_no'];
?>

<div class="container">
  <header>
    <h1>
      Acme Human Resources - Employee Details
    </h1>
  </header>

  <div class="employeeDetail">

    <?php
      $empDB = new mysqli('localhost','root','password','employees');
      if($empDB->connect_errno) {
        echo "Failed to connect to MySQL:(" . $empDB->connect_errno . ") " . $empDB->connect_error;
        die;
      }


      $query =  'SELECT * from employees where emp_no = ' . $emp_no;

      if($result = mysqli_query($empDB, $query)) {
        $row = mysqli_fetch_assoc($result);
      }

      mysqli_close($empDB);

    ?>

    <h3>
      Name: <?php echo $row['first_name'] . " " . $row['last_name']; ?> <a href="edit_emp.php?emp_no=<?php echo $row['emp_no']; ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> edit</a>
    </h3>
    <ul>
      <li>
        Employee No: <?php echo $row['emp_no']; ?>
      </li>
      <li>
        Gender: <?php echo $row['gender']; ?>
      </li>
      <li>
        Hire Date: <?php echo $row['hire_date']; ?>
      </li>
    </ul>
  </div>
  <div class="current">
      <?php
      $empDB = new mysqli('localhost','root','password','employees');
      if($empDB->connect_errno) {
        echo "Failed to connect to MySQL:(" . $empDB->connect_errno . ") " . $empDB->connect_error;
        die;
      }
      ?>
      <h3>
        History
      </h3>
    <table class="table table-bordered table-hover table-striped table-condensed">
        <thead>
          <tr>
            <th>
              Department Name
            </th>
            <th>
              Title
            </th>
            <th>
              Start Date
            </th>
            <th>
              End Date
            </th>
          </tr>
        </thead>
        <tbody>
      <?php
        $query = "Select c.*, d.dept_name, t.title from current_dept_emp as c
                	INNER JOIN departments as d
                		ON c.dept_no = d.dept_no
                	INNER JOIN titles as t
                		ON t.emp_no = c.emp_no
                WHERE c.emp_no = " . $emp_no;

        if($result = mysqli_query($empDB, $query)) {
          while($row = mysqli_fetch_assoc($result)){
            echo "<tr><td>" . $row['dept_name'] . "</td><td>" . $row['title'] . "</td><td>" . $row['from_date'] . "</td><td>" . $row['to_date'] . "</td></tr>";
          };
          mysqli_close($empDB);
        }
        ?>
      </tbody>
    </table>
  </div>
  <div class="salaryHistory">
    <?php
    $empDB = new mysqli('localhost','root','password','employees');
    if($empDB->connect_errno) {
      echo "Failed to connect to MySQL:(" . $empDB->connect_errno . ") " . $empDB->connect_error;
      die;
    }
    ?>
    <h3>
      Salary History
    </h3>
  <table class="table table-bordered table-hover table-striped table-condensed">
      <thead>
        <tr>
          <th>
            Salary
          </th>
          <th>
            End Date
          </th>
          <th>
            End Date
          </th>
        </tr>
      </thead>
      <tbody>
    <?php
      $query = "select s.salary, s.from_date, s.to_date from salaries as s where emp_no = " . $emp_no;
      setlocale(LC_MONETARY, 'en_US');
      if($result = mysqli_query($empDB, $query)) {
        while($row = mysqli_fetch_assoc($result)){
          echo "<tr><td>$" . money_format('%i', $row['salary']) . "</td><td>" . $row['from_date'] . "</td><td>" . $row['to_date'] . "</td></tr>";
        };
      }
      ?>
    </tbody>
  </table>
  </div>
</div>

<?php include_once('partials/footer.html'); ?>
