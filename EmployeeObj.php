<?php

class Employee
{
    public $staffID;
    public $fname;
    public $lname;
    public $id;
    public $email;
    public $phone;
    public $department;
    public $position;
    public $supervisor;
    public $startDate;

    public function __construct($f, $l, $id, $em, $ph, $dert, $super, $date)
    {
        $this->staffID = rand(1_000, 100_000); //?randomly generated staff-id
        $this->fname = $f;
        $this->lname = $l;
        $this->id = $id;
        $this->email = $em;
        $this->phone = $ph;
        $this->department = $dert;
        $this->supervisor = $super;
        $this->startDate = $date;
    }


    //?Function is for writing into the file.
    //?This function will be used to write the employee data into the file.
    //?The insert to file format follows the required format/standard which is not 
    //?the CSV(comma separated value) but it SCSV(semi-colon separated value) 
    public function __insert()
    {
        return "\n{$this->staffID};{$this->id};{$this->id};{$this->lname};{$this->fname};{$this->department};{$this->position};{$this->startDate};{$this->email};{$this->phone}";
    }


    //?This function is to read the SCSV file and return file data to initialize the employee object.
    public function __read()
    {
        $file = 'employees.txt'; //?Employee file
        $string = null; //?Temp variable to hold data read from file in an unformatted manner.
        $arr = array(); //?Split the file content, thus it can be assigned to employee methods.
        $file_op = fopen($file, 'r') or die('Unable to access file');
        $count = 0; //?Number of tuples in the file.
        while (!feof($file_op)) {
            $string .= fgets($file_op);
            $count++;
        }
        //?Convert string tmp variable to array
        $arr = explode(";", $string); //?Split the string into an array using [semi-colon] as delimiter.

        //?Creating array of object... WHY
        //?If the count variable i greater than 1 we create  an array of objects, to hold many employee objects.
        //?Else we just print the existing  employee object.

        if ($count > 1) {
            $employee = [];
            rewind($file_op);
            //?Populating the array of objects
            while (!feof($file_op)) {
                $line = fgets($file_op);
                $arr = explode(";", $line);
                $this->__populateArray($arr);
            }
        } else {
            $this->__populateArray($arr);
        }
        fclose($file_op);
    }


    private function __populateArray($arr)
    {
        //?RE-POPULATING EMPLOYEE OBJECT..
        $this->staffID = $arr[0];
        $this->id = $arr[1];
        $this->lname = $arr[2];
        $this->fname = $arr[3];
        $this->department = $arr[4];
        $this->position = $arr[5];
        $this->startDate = $arr[6];
        $this->startDate = $arr[7];
        $this->email = $arr[8];
        $this->phone = $arr[9];
        echo "<div style='margin-left:500px'>";
        echo $this->__toString();
        echo '-------------------------------------------';
        echo "</div>";
    }



    //?This function is simply for displaying the employee data in a formatted way
    public function __toString()
    {
        return
            "Employee ID: $this->staffID <br>" .
            "First Name: $this->fname <br>" .
            "Last Name: $this->lname <br>" .
            "Identity No. : $this->id <br>" .
            "Email: $this->email <br>" .
            "Phone: $this->phone <br>" .
            "Department: $this->department <br>" .
            "Position: $this->position <br>" .
            "Supervisor: $this->supervisor <br>" .
            "Start Date: $this->startDate <br>";
    }
}