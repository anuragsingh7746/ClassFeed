<?php
// Connect to MySQL database
require('../../../server/connect.php');
                 // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        session_start();
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Read values from POST variables
$course_id = $_POST["course_id"];
$sec_id = $_POST["sec_id"];
$year = $_POST["year"];
$ID = $_SESSION['enroll_no'];
$current_month = date('m');
$batch=$_POST['batch'];
//$yeartemp = date('Y');
//echo $yeartemp;
// Calculate semester
$semester = ($year - $batch) * 2;
if ($current_month >= 7) {
    $semester += 1;
}

// Check if the record already exists in the database
$sql = "SELECT * FROM P2_Section WHERE course_id='$course_id' AND sec_id='$sec_id' AND year='$year' AND semester='$semester'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Record already exists, show error message
    echo "Error: Record already exists for given section and instructor.";
} else {
    // Record doesn't exist, insert into database
    $sql = "INSERT INTO P2_Section VALUES ('$course_id', '$sec_id', '$semester','$year')";
    $result = mysqli_query($conn, $sql);

    $sql1 = "INSERT INTO P2_Teaches VALUES ('$ID', '$course_id', '$sec_id', '$semester','$year')";
    $result1 = mysqli_query($conn, $sql1);
}

    // Include PhpSpreadsheet library
   
    // Check if a file was uploaded
   
if (isset($_FILES['excel_file'])) {
    // Get file details
    $filename = $_FILES['excel_file']['name'];
    $filetmp = $_FILES['excel_file']['tmp_name'];
    $fileext = pathinfo($filename, PATHINFO_EXTENSION);

    // Check if file is an Excel file
    if ($fileext != 'xls' && $fileext != 'xlsx') {
        die('Only Excel files are allowed.');
    }

    // Load Excel file using PhpSpreadsheet library
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filetmp);

    // Get the first worksheet in the Excel file
    $worksheet = $spreadsheet->getActiveSheet();

            

            // Insert Excel data into MySQL database
            foreach ($worksheet->getRowIterator() as $row) {
                $cell = $worksheet->getCellByColumnAndRow(1, $row->getRowIndex());
                $value = $cell->getValue();
                $rown = $row->getRowIndex();
                if ($row->getRowIndex() > 1 && !empty($value)) {
                    $sql = "SELECT COUNT(*) as count FROM P2_Takes WHERE enroll_no = '$value' AND course_id = '$course_id' AND sec_id = '$sec_id' AND semester = '$semester' AND year = '$year'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $sql1 = "SELECT COUNT(*) as count FROM P2_Student where enroll_no = '$value'";
                    $result = $conn->query($sql1);
                    $row1 = $result->fetch_assoc();
                    if( $row['count'] > '0' ){
                        echo "Student already exist in table enroll_no: '$value' on row '$rown'";
                    }
                    else if($row1['count'] == '0'){
                        echo "Student with enroll_no: '$value' on row '$rown' not found.";
                    }
                    else{
                        $sql = "INSERT INTO P2_Takes VALUES ('$value','$course_id','$sec_id','$semester','$year')";
                        if ($conn->query($sql) === false) {
                        echo "error";
                    }else echo "Success";

                    }
                    
                     
                   
                    
            }
                    
            }

}else {
        echo "Error: No file uploaded.";
    }

?>
