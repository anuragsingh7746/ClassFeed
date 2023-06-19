<?php
// Include the PhpSpreadsheet library
require 'vendor/autoload.php';

require('../../../server/connect.php');
// Database credentials
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
            $existsSql = "SELECT COUNT(*) as count FROM P2_Department WHERE dept_name = '".$data[0]."'";
            $existsResult = mysqli_query($conn, $existsSql);
            $existsRow = mysqli_fetch_assoc($existsResult);
            if ($existsRow['count'] > 0) {
                // Entry already exists, show error message
                echo "Error: Record already exists for '".$data[0]."' on row ".$rowCounter.".";
            } else {
                $sql = "INSERT INTO P2_Department (`dept_name`) VALUES ('".$data[0]."')";

                    if (mysqli_query($conn, $sql)) {
                            echo "Record added successfully.";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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

