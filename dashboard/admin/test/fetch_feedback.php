<?php
// Assuming you have established a database connection
require('../../../server/connect.php');
// Fetch the instructor ID from the session variable

// Fetch the course ID you want to plot the chart for



$courseID = $_GET['courseId'];

// Get the current year
$currentYear = date('Y');

// Construct the SQL query
$sql = "SELECT year, AVG(rating) AS avg_rating
        FROM P2_Feedback
        WHERE course_id = '$courseID'
        AND year >= '$currentYear' - 5
        GROUP BY year
        ORDER BY year ASC";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
  // Initialize arrays to store years and average ratings
  $years = array();
  $averageRatings = array();

  // Fetch data from the result set
  while ($row = mysqli_fetch_assoc($result)) {
    $years[] = $row['year'];
    $averageRatings[] = $row['avg_rating'];
  }

  // Close the result set
  mysqli_free_result($result);

  // Create an array combining years and average ratings
  $data = array(
    'years' => $years,
    'averageRatings' => $averageRatings
  );

  // Send the data as JSON response
  header('Content-Type: application/json');
  echo json_encode($data);
} else {
  // Query error handling
  echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
