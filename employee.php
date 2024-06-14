<?php
require_once 'EmployeeObj.php';
//? Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //?Form data values from the form.
    $fname = $_POST['fn'];
    $lname = $_POST['ln'];
    $idno = $_POST['idno'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $supervisor = $_POST['looker'];
    $date = $_POST['strtdate'];
    if (isset($_POST['looker']) != 'Select Supervisor' || $_POST['department'] != 'Select Department') {
        $employee = new Employee($fname, $lname, $idno, $email, $phone, $department, $supervisor, $date);
        // echo $employee->__toString();
        $file = 'employees.txt';
        // $file_op = fopen($file, 'a') or die('Unable to access file');
        //?Writing employee object to file
        // fwrite($file_op, $employee->__insert());
        // fclose($file_op);
        $employee->__read();
    } else {
        //! Handle the case where no department or supervisor was selected
        echo "Please select a valid option..";
        echo "No department was selected.";
    }
}


echo "<p style='margin-left:500px';>Script Executed Successful</p>";