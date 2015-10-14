<?php
    $pageTitle = "Acme Employee Details";
    include_once 'partials/header.php';

    if(isset($_GET['emp_no']) && $_GET['emp_no'] != '') {
        $emp_no = $_GET['emp_no'];
    } else {
        echo "<p>No employee number found.  Try again. Loser.</p>";
        die;
    }
?>

<h1>
    Employee Details
</h1>
<?php
$empDB = new mysqli('localhost','root','password','employees');
if($empDB->connect_errno) {
    echo "<p>Failed to connect to MySQL: ("
    . $empDB->connect_errno . ") "
    . $empDB->connect_error . "</p>";
    die;
}
$query = "SELECT * from employees WHERE emp_no = " . $emp_no;

if($result = $empDB->query($query)){
    $emp = $result->fetch_assoc();
}

$empDB->close();
?>
<h3>
    <?php echo $emp['first_name'] . " " . $emp['last_name']; ?>
</h3>

<ul>
  <li>
    Employee No: <?php echo $emp['emp_no']; ?>
  </li>
  <li>
    Gender: <?php echo $emp['gender']; ?>
  </li>
  <li>
    Hire Date: <?php echo $emp['hire_date']; ?>
  </li>
</ul>










<?php
    include_once 'partials/footer.php';
 ?>
