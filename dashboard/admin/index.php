<?php
// Assuming you have established a database connection
require('../../server/connect.php');
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
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ClassFeed</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />


    <link href="style.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>

  <body>
    <div class="main-container d-flex">
        <div class="sidebar shadow" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4"><span class="bg-white text-dark px-2 me-2"> <img src="../../pictures/iiita_logo.png" width="40"></img> </span><span class="text-black">ClassFeed</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-black"><i class="fas fa-stream"></i></button>
            </div>

            <ul class="list-unstyled px-2">
                <li class="active"><a href="index.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class=""><a href="view/view.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-list"></i> View Feedback</a></li>
            </ul>
            <hr class="h-color mx-2" style="color:black;">

            <ul class="list-unstyled px-2">
                <li class="">
                    <a class="text-decoration-none px-3 py-2 d-block collaped" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false" href="#">
                      <i class="fas fa-chevron-down"></i>
                        Manage
                    </a>
                    <div class="collapse" id="dashboard-collapse">
                      <ul class="btn-toggle-nav list-unstyled">
                        <li><a href="add/add_dept.html" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-university"></i> Add Department</a></li>
                        <li><a href="add/add_course.html" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-book-open"></i> Add Course</a></li>
                        <li><a href="add/add_instructor.html" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-chalkboard-teacher"></i> Add Faculty</a></li>
                      </ul>
                    </div>
                  </li>
            </ul>


        </div>
        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                <div class="d-flex justify-content-between d-md-none d-block">
                  <a class="navbar-brand fs-4" href="#">ClassFeed</a>
                  <button class="btn px-1 py-0 open-btn"><i class="fas fa-stream"></i></button>
                </div>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                      
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="settings/settings.php">Settings</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="Javascript:logout()">Logout</a></li>
                        </ul>
                      </li>
                      
                      
                      
                    </ul>
                    
                  </div>
                </div>
              </nav>

              <div class="dashboard-content">

<label for="courseSelect">Select Course:</label>
  <select id="courseSelect" onchange="fetchFeedbackData()">
    <option value="">-- Select a Course --</option>
    <?php foreach ($courseOptions as $courseID): ?>
      <option value="<?php echo $courseID; ?>" <?php echo 'selected';  ?>><?php echo $courseID; ?></option>
    <?php endforeach; ?>
  </select>
  
  <canvas id="feedbackChart"></canvas>


</div>

        </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
function logout() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.location.href = '../../index.html';
    }
  };
  xmlhttp.open('GET', 'logout.php', true);
  xmlhttp.send();
}


document.onreadystatechange = () => {
  if (document.readyState === 'interactive') {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        let check = this.responseText;
        if (check == 'false') {
          window.location.href = '../../index.html';
        } else {
          console.log(this.responseText);
        }
      }
    };
    xmlhttp.open('GET', 'admin.php', true);
    xmlhttp.send();
  }
};

$(".open-btn").on('click' , function(){
            $(".sidebar").addClass('active');
        });

        $(".close-btn").on('click' , function(){
            $(".sidebar").removeClass('active');
        });
document.onreadystatechange = () => {
  if (document.readyState === 'interactive') {
setTimeout(fetchFeedbackData(), 50);
        }
      }


var feedbackChart;

function fetchFeedbackData() {
  var courseId = document.getElementById('courseSelect').value;

  if (courseId === '') {
    console.log('Please select a course.');
    return;
  }

  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'test/fetch_feedback.php?courseId=' + encodeURIComponent(courseId), true);
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

