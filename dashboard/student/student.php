<?php 
require ('../../server/connect.php');
session_start();
$enroll = $_SESSION['enroll_no'];
$year = date('Y');
$sql = "select course_id, course_title from P2_Takes natural join P2_Course where enroll_no='$enroll' AND year ='$year'";
$result = mysqli_query($conn, $sql);
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
                <li class="active"><a href="professor.html" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-home"></i> Dashboard</a></li>
               <!-- <li class=""><a href="view/view.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-list"></i> View Feedback</a></li>
                <li class=""><a href="add/add.html" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-user-graduate"></i> Add Students</a></li> -->
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
                        
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="settings/settings.html">Settings</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="Javascript:logout()">Logout</a></li>
                        </ul>
                      </li>
                      
                      
                      
                    </ul>
                    
                  </div>
                </div>
              </nav>

              <div class="dashboard-content">


    <div class="d-flex justify-content-center">


<table class="table table-bordered text-center" style="float: none; width: 50%;">
  <thead>
    <tr>
      <th scope="col">Course Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($coursename = mysqli_fetch_array($result, MYSQLI_ASSOC)): ?>
    <tr>
      <td><?php echo $coursename['course_title']; ?></td>
      <td>
        <form action="feedback.php" method="POST">
          <?php
            $courseId = $coursename['course_id'];
            $sql = "SELECT COUNT(*) as countc FROM P2_Feedback NATURAL JOIN P2_Mapping WHERE course_id = '$courseId' AND year = '$year' AND enroll_no = '$enroll'";
            $resultCount = mysqli_query($conn, $sql);
            $rowCount = mysqli_fetch_assoc($resultCount);
            $disabled = ($rowCount['countc'] > 0) ? 'disabled' : '';
          ?>
          <button type="submit" class="btn btn-primary" id="button" name="givefeedback" value="<?php echo $courseId; ?>" <?php echo $disabled; ?>>Give Feedback</button>
        </form>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
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


$(".open-btn").on('click' , function(){
            $(".sidebar").addClass('active');
        });

        $(".close-btn").on('click' , function(){
            $(".sidebar").removeClass('active');
        });

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
          const first = this.responseText.charAt(0).toUpperCase();
          const result = first + this.responseText.slice(1);
          document.getElementById('navbarDropdown').innerHTML = '<i class="fas fa-user"></i> ' + result;
        }
      }
    };
    xmlhttp.open('GET', 'check.php', true);
    xmlhttp.send();
  }
};

 
    </script>
   </body>
</html>

