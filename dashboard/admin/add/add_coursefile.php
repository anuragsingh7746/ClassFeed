<?php
// Include the PhpSpreadsheet library
require 'vendor/autoload.php';

// Database credentials
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '_Mysqllocalsecured1.';
$dbname = 'feedback_system_3.0';

// Connect to MySQL database
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if file was uploaded
if (isset($_FILES['file'])) {
    // Get file details
    $filename = $_FILES['file']['name'];
    $filetmp = $_FILES['file']['tmp_name'];
    $fileext = pathinfo($filename, PATHINFO_EXTENSION);

    // Check if file is an Excel file
    if ($fileext != 'xls' && $fileext != 'xlsx') {
        die('Only Excel files are allowed.');
    }

    // Load Excel file using PhpSpreadsheet library
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filetmp);

    // Get the first worksheet in the Excel file
    $worksheet = $spreadsheet->getActiveSheet();

    // Initialize counter variable
    $rowCounter = 0;

    // Loop through rows in the worksheet
    foreach ($worksheet->getRowIterator() as $row) {
        // Skip first row
        if ($rowCounter > 0) {
            $data = array();

            // Loop through cells in the row
            foreach ($row->getCellIterator() as $cell) {
                $data[] = $cell->getValue();
            }

            // Check if entry already exists in the database
            $existsSql = "SELECT COUNT(*) as count FROM P2_Course WHERE course_id = '".$data[0]."'";
            $existsResult = mysqli_query($conn, $existsSql);
            $existsRow = mysqli_fetch_assoc($existsResult);

            if ($existsRow['count'] > 0) {
                // Entry already exists, show error message
                echo "Error: Record already exists for '".$data[0]."': '".$data[2]."' on row ".$rowCounter.".";
            } else {
                // Check if department exists in the database
                $deptSql = "SELECT COUNT(*) as count FROM P2_Department WHERE dept_name = '".$data[1]."'";
                $deptResult = mysqli_query($conn, $deptSql);
                $deptRow = mysqli_fetch_assoc($deptResult);

                if ($deptRow['count'] > 0) {
                    // Department exists, insert data into MySQL database
                    $sql = "INSERT INTO P2_Course (`course_id`,`course_title` , `dept_name`, `type`, `credits`) VALUES ('".$data[0]."', '".$data[2]."', '".$data[1]."', '".$data[3]."', '".$data[4]."')";

                    if (mysqli_query($conn, $sql)) {
                        // Insert data into P2_Login table

                            echo "Record added successfully.";
                        } else {
                            echo "Error: " . $loginSql . "<br>" . mysqli_error($conn);
                        }
                    } else {
// Department does not exist, show error message
echo "Error: Department '".$data[2]."' does not exist on row ".$rowCounter.".";
}
}
}
   // Increment row counter
    $rowCounter++;
}

}

// Close MySQL connection
mysqli_close($conn);
?>

