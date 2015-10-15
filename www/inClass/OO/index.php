<?php
    include_once 'config.php';
    include_once 'mysql.php';

    $mysql = new mysql();
    $myQuery = "Select * from employees LIMIT 10";

    $emps = $mysql->getArray($myQuery);
    $tbody = '';
    foreach(array_reverse($emps) as $emp) {
        $tbody .= "<tr><td>"
        . $emp['last_name'] . "</td><td>"
        . $emp['first_name'] . "</td><td>"
        . $emp['emp_no'] . "</td></tr>";
    }
 ?>

 <table>
     <thead>
         <tr>
             <th>last name</th>
             <th>first name</th>
             <th>employee no.</th>
         </tr>
     </thead>
     <tbody>
         <?php echo $tbody; ?>
     </tbody>
 </table>
