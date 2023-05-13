<?php
// Assuming you have established a database connection
require('../../server/connect.php');
// Fetch the instructor ID from the session variable
session_start();
$instructorID = $_SESSION['enroll_no'];
// Get the current year
$currentYear = date('Y');

// Construct the SQL query
$sql = "SELECT P2_Teaches.course_id, COUNT(P2_Feedback.feedback_id) AS feedback_count
        FROM P2_Teaches
        NATURAL JOIN P2_Feedback
        WHERE P2_Teaches.ID = '$instructorID'
        AND P2_Feedback.year = '$currentYear'
        GROUP BY P2_Teaches.course_id";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
  // Initialize an array to store feedback data
  $feedbackData = array();

  // Fetch data from the result set
  while ($row = mysqli_fetch_assoc($result)) {
    $feedbackData[] = array(
      'courseName' => $row['course_id'],
      'feedbackCount' => $row['feedback_count']
    );
  }

  // Close the result set
  mysqli_free_result($result);

  // Send feedback data as JSON response
  header('Content-Type: application/json');
  echo json_encode($feedbackData);
} else {
  // Query error handling
  echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

