<?php
// Assuming you have established a database connection
require('../../../server/connect.php');
// Fetch the instructor ID from the session variable

// Construct the SQL query to fetch the courses taught by the instructor
$sql = "SELECT DISTINCT(course_id)
        FROM P2_Teaches";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
  // Initialize an array to store the course options
  $courseOptions = array();

  // Fetch data from the result set
  while ($row = mysqli_fetch_assoc($result)) {
    $courseOptions[] = $row['course_id'];
  }

  // Close the result set
  mysqli_free_result($result);
} else {
  // Query error handling
  echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Feedback Chart</title>
  <!-- Include Chart.js library -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <label for="courseSelect">Select Course:</label>
  <select id="courseSelect" onchange="fetchFeedbackData()">
    <option value="">-- Select a Course --</option>
    <?php foreach ($courseOptions as $courseID): ?>
      <option value="<?php echo $courseID; ?>"><?php echo $courseID; ?></option>
    <?php endforeach; ?>
  </select>
  
  <canvas id="feedbackChart"></canvas>

<script>

// Store the chart instance globally
var feedbackChart;

function fetchFeedbackData() {
  var courseId = document.getElementById('courseSelect').value;

  if (courseId === '') {
    console.log('Please select a course.');
    return;
  }

  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'fetch_feedback.php?courseId=' + encodeURIComponent(courseId), true);
  xhr.onload = function() {
    if (xhr.status === 200) {
      var feedbackData = JSON.parse(xhr.responseText);

      if (feedbackData.years.length === 0) {
        console.error('No feedback data found for the selected course.');
        return;
      }

      var years = feedbackData.years;
      var averageRatings = feedbackData.averageRatings;

      console.log(years); // Debugging information
      console.log(averageRatings); // Debugging information

      // Destroy the previous chart instance if it exists
      if (feedbackChart) {
        feedbackChart.destroy();
      }

      var canvasId = 'feedbackChart';
      var ctx = document.getElementById(canvasId).getContext('2d');
      feedbackChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: years,
          datasets: [{
            label: 'Average Rating',
            data: averageRatings,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              stepSize: 1
            }
          }
        }
      });
    } else {
      console.error('Request failed. Status:', xhr.status);
    }
  };
  xhr.send();
}

        </script>
</body>
</html>

