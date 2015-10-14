<?php
  include_once('partials/header.html');
?>

<div class="container">
  <header>
    <h1>
      Acme Human Resources
    </h1>
  </header>

<div class="employeeTable">

<?php
  $empDB = new mysqli('localhost','root', 'password','employees');
  if ($empDB->connect_errno) {
    echo "Failed to connect to MySQL: (" . $empDB->connect_errno . ") " . $empDB->connect_error;
    die;
  }
?>
<table class="table table-striped table-hover table-bordered table-condensed">
  <thead>
    <tr>
      <th>Last Name</th>
      <th>First Name</th>
      <th>Employee ID</th>
      <th>

      </th>
    </tr>
  </thead>
  <tbody>
<?php
  $emps = $empDB->query('Select * from employees LIMIT 10');
  for($emp = $emps->num_rows -1; $emp >= 0; $emp --) {
    $emps->data_seek($emp);
    $row = $emps->fetch_assoc();
    // var_dump($row);
    echo "<tr><td>" . $row['last_name'] . "</td><td>" . $row['first_name'] . "</td><td>" . $row['emp_no'] . "</td><td><a class='btn btn-primary btn-block' href='emp_details.php?emp_no=" . $row['emp_no'] . "'>
    <span class='glyphicon glyphicon-info-sign'></span> view</a></td></tr>";
  }
?>
</tbody>
</table>
</div>

<?php
  $emps->free();
  $empDB->close();
  include_once('partials/footer.html');
?>
