<?php
include('../../../server/db.php');
  // Set session
session_start();
$feedback_id = $_GET['feedback_id'];
$answers = $connection->query("SELECT * FROM P2_Feedback where feedback_id = '$feedback_id'")->fetchAll();

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


    <link href="../style.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
  </head>

  <body>
    <div class="main-container d-flex">
        <div class="sidebar shadow" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4"><span class="bg-white text-dark px-2 me-2"> <img src="../../../pictures/iiita_logo.png" width="40"></img> </span><span class="text-black">ClassFeed</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-black"><i class="fas fa-stream"></i></button>
            </div>

            <ul class="list-unstyled px-2">
                <li class=""><a href="../index.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="active"><a href="../view/view.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-list"></i> View Feedback</a></li>
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
                        <li><a href="../add/add_dept.html" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-university"></i> Add Department</a></li>
                        <li><a href="../add/add_course.html" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-book-open"></i> Add Course</a></li>
                        <li><a href="../add/add_instructor.html" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-chalkboard-teacher"></i> Add Faculty</a></li>
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
                          <li><a class="dropdown-item" href="../settings/settings.php">Settings</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="Javascript:logout()">Logout</a></li>
                        </ul>
                      </li>
                      
                      
                      
                    </ul>
                    
                  </div>
                </div>
              </nav>
              <div class="dashboard-content">
<div class="container mt-5">
        <h2 class="text-center mb-5">Detailed View</h2>

<table class="table table-bordered md-5"style="width:95%" >
<tr>
    <th>Questions</th>
    <th>Answers</td>
  </tr>
  <tr>
    <th>How well did you achieve this learning goal in this course?</th>
    <td><?php 

switch ($answers[0]['Q1']) {
  case "1":
    echo "Not well at all";
    break;
  case "2":
    echo "Slightly Well";
    break;
  case "3":
    echo "Very Well";
    break;
case "4":
    echo "Extremely well";
    break;
    
  default:
    echo "N/A";
}
?>

</td>
  </tr>
  <tr>
    <th>How useful were the assignments from this instructor for your learning in the course?</th>
    <td><?php 

switch ($answers[0]['Q2']) {
  case "1":
    echo "Not well at all";
    break;
  case "2":
    echo "Slightly Well";
    break;
  case "3":
    echo "Very Well";
    break;
case "4":
    echo "Extremely well";
    break;
    
  default:
    echo "N/A";
}
?></td>
  </tr>
  <tr>
    <th>How prepared was this instructor for section meetings?</th>
    <td><?php 

switch ($answers[0]['Q3']) {
  case "1":
    echo "Not well at all";
    break;
  case "2":
    echo "Slightly Well";
    break;
  case "3":
    echo "Very Well";
    break;
case "4":
    echo "Extremely well";
    break;
    
  default:
    echo "N/A";
}
?></td>
  </tr>
<tr>
    <th>How organized was this course?</th>
    <td><?php 

switch ($answers[0]['Q4']) {
  case "1":
    echo "Not well at all";
    break;
  case "2":
    echo "Slightly Well";
    break;
  case "3":
    echo "Very Well";
    break;
case "4":
    echo "Extremely well";
    break;
    
  default:
    echo "N/A";
}
?></td>
  </tr>
<tr>
    <th>Overall, how would you describe the quality of the instruction in this course?</th>
    <td><?php 

switch ($answers[0]['Q5']) {
  case "1":
    echo "Not well at all";
    break;
  case "2":
    echo "Slightly Well";
    break;
  case "3":
    echo "Very Well";
    break;
case "4":
    echo "Extremely well";
    break;
    
  default:
    echo "N/A";
}
?></td>
  </tr>
<tr>
    <th>Would you like to provide any other comments about this course?</th>
    <td><?php echo $answers[0]['comment']; ?></td>
  </tr>
</table>
    </div>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#records-limit').change(function () {
                $('form').submit();
            })
$('#course_id').change(function () {
                $('form').submit();
            })
$('#year').change(function () {
                $('form').submit();
            })
$('#instructor').change(function () {
                $('form').submit();
            })

        });

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
      window.location.href = '../../../index.html';
    }
  };
  xmlhttp.open('GET', '../logout.php', true);
  xmlhttp.send();
}


document.onreadystatechange = () => {
  if (document.readyState === 'interactive') {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        let check = this.responseText;
        if (check == 'false') {
          window.location.href = '../../../index.html';
        } else {
          console.log(this.responseText);
          const first = this.responseText.charAt(0).toUpperCase();
          const result = first + this.responseText.slice(1);
          document.getElementById('navbarDropdown').innerHTML = '<i class="fas fa-user"></i> ' + 'Admin';
        }
      }
    };
    xmlhttp.open('GET', '../professor.php', true);
    xmlhttp.send();
  }
};

    </script>


</div>

        </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
   </body>
</html>
