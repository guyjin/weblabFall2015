<?php $pageTitle = "Acme, Inc. Home of the finest in RoadRunner capture gear."; ?>
<?php include_once 'partials/header.php'; ?>

        <h1>Hello, World.</h1>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus error perspiciatis illo, harum eius repellat at quasi in cum! Ex aliquid placeat natus iste. Rem repellendus distinctio ratione iusto ipsa.
        </p>
<?php
    $empDB = new mysqli('localhost','root','password','employees');
    if($empDB->connect_errno) {
        echo "<p>Failed to connect to MySQL: (" . $empDB->connect_errno . ") " . $empDB->connect_error . "</p>";
        die;
    }
    $emps = $empDB->query('SELECT * from employees LIMIT 10');
?>
<table>
    <thead>
        <tr>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Employee ID</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
            for($emp = $emps->num_rows -1; $emp >= 0; $emp --) {
                $emps->data_seek($emp);
                $row = $emps->fetch_assoc();

                echo "<tr><td>" . $row['last_name']
                . "</td><td>".$row['first_name']
                . "</td><td>".$row['emp_no']
                . "</td><td><a href='emp_details.php?emp_no="
                . $row['emp_no'] . "'>View</a>"
                . "</td></tr>";


            }
        ?>
    </tbody>
</table>







<?php include_once 'partials/footer.php'; ?>
