<?php
include('../../../server/db.php');
  // Set session
  session_start();
  if(isset($_POST['records-limit'])){
      $_SESSION['records-limit'] = $_POST['records-limit'];
  }
  
  $limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 5;
  $page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
  $paginationStart = ($page - 1) * $limit;
if(isset($_POST['course_id'])){
      $_SESSION['course_id'] = $_POST['course_id'];
}
if(isset($_POST['year'])){
      $_SESSION['year'] = $_POST['year'];
}
if(isset($_POST['instructor'])){
      $_SESSION['instructor'] = $_POST['instructor'];
}

  if(isset($_SESSION['course_id']) ){
    $_SESSION['course_id'] = isset($_SESSION['course_id']) ? $_SESSION['course_id'] : $_POST['course_id'];
    $course = $_SESSION['course_id'];
    $year = $_SESSION['year'];
    if(!isset($_SESSION['instructor'])) {
$authors = $connection->query("SELECT feedback_id, course_id, pseudo_name, year, comment, rating FROM P2_Feedback WHERE course_id = '$course' AND year ='$year' ORDER BY rating LIMIT $paginationStart, $limit")->fetchAll();
  // Get total records
  $sql = $connection->query("SELECT count(feedback_id) AS id FROM P2_Feedback WHERE course_id = '$course' AND year ='$year'")->fetchAll();
  $allRecrods = $sql[0]['id'];

    }else {
      $ID = $_SESSION['instructor'];
      $year = $_SESSION['year'];
$authors = $connection->query("SELECT feedback_id, course_id, pseudo_name, year, comment, rating FROM P2_Feedback NATURAL JOIN P2_Teaches WHERE course_id = '$course' AND year ='$year' AND ID ='$ID' ORDER BY rating  LIMIT $paginationStart, $limit")->fetchAll();
  // Get total records
  $sql = $connection->query("SELECT count(feedback_id) AS id FROM P2_Feedback NATURAL JOIN P2_Teaches WHERE course_id = '$course' AND year ='$year' AND ID ='$ID' ")->fetchAll();
 $allRecrods = $sql[0]['id'];

    } 
  }


  else if(isset($_SESSION['instructor']) ){
$ID = $_SESSION['instructor'];

    $year = $_SESSION['year'];
if(!isset($_SESSION['course'])) {
$authors = $connection->query("SELECT feedback_id, course_id, pseudo_name, year, comment, rating FROM P2_Feedback NATURAL JOIN P2_Teaches WHERE ID = '$ID' AND year ='$year' ORDER BY rating LIMIT $paginationStart, $limit")->fetchAll();
  // Get total records
  $sql = $connection->query("SELECT count(feedback_id) AS id FROM P2_Feedback NATURAL JOIN P2_Teaches WHERE year ='$year' AND ID ='$ID' ")->fetchAll();
  $allRecrods = $sql[0]['id'];


    }else {
      
      $course = $_SESSION['course_id'];
$authors = $connection->query("SELECT feedback_id, course_id, pseudo_name, year, comment, rating FROM P2_Feedback NATURAL JOIN P2_Teaches WHERE course_id = '$course' AND year ='$year' AND ID ='$ID' ORDER BY rating LIMIT $paginationStart, $limit")->fetchAll();
  // Get total records
  $sql = $connection->query("SELECT count(feedback_id) AS id FROM P2_Feedback NATURAL JOIN P2_Teaches WHERE course_id = '$course' AND year ='$year' AND ID ='$ID' ")->fetchAll();
  $allRecrods = $sql[0]['id'];

    } 
  }



  // Calculate total pages
  $totoalPages = ceil($allRecrods / $limit);
  // Prev + Next
  $prev = $page - 1;
  $next = $page + 1;
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
        <h2 class="text-center mb-5">Professor's View</h2>

        <!-- Select dropdown -->
        <div class="d-flex flex-row-reverse bd-highlight mb-3">
            <form action="view.php" method="post">
                <select name="records-limit" id="records-limit" class="custom-select" style="max-width:150px">
                    <option disabled selected>Records Limit</option>
                    <?php foreach([5,7,10,12] as $limit) : ?>
                    <option
                        <?php if(isset($_SESSION['records-limit']) && $_SESSION['records-limit'] == $limit) echo 'selected'; ?>
                        value="<?= $limit; ?>">
                        <?= $limit; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                    <select name="course_id" id="course_id" class="custom-select" style="max-width:150px">
                    <option disabled selected>Course ID</option>
<?php
  $year = $_SESSION['year']; 
  $sql = "SELECT distinct(course_id) FROM P2_Teaches where year = '$year'";
  $result = $connection->query($sql)->fetchAll();
?>
                    <?php foreach($result as $course_id) : ?>
                    <option
                        <?php if(isset($_SESSION['course_id']) && $_SESSION['course_id'] == $course_id['course_id']) echo 'selected'; ?>
                        value="<?= $course_id['course_id']; ?>">
                        <?= $course_id['course_id']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
<select name="year" id="year" class="custom-select" style="max-width:150px">
                    <option disabled selected>Year</option>
                    <?php foreach([2020,2021,2022,2023] as $limit) : ?>
                    <option
                        <?php if(isset($_SESSION['year']) && $_SESSION['year'] == $limit) echo 'selected'; ?>
                        value="<?= $limit; ?>">
                        <?= $limit; ?>
                    </option>
                    <?php endforeach; ?>
                </select>


                </select>
                    <select name="instructor" id="instructor" class="custom-select" style="max-width:150px">
                    <option disabled selected>Instructor</option>
<?php 
  if(isset($_SESSION['year'])){
    $year = $_SESSION['year'];
  $sql = "SELECT distinct(ID), P2_Instructor.name FROM P2_Teaches natural join P2_Instructor where year = '$year' ";
  $result = $connection->query($sql)->fetchAll();

  }else{
    $result = [];
  }
?>
                    <?php 
foreach($result as $instructor) : ?>
                    <option
                        <?php if(isset($_SESSION['instructor']) && $_SESSION['instructor'] == $instructor['ID']) echo 'selected'; ?>
                        value="<?= $instructor['ID']; ?>">
                        <?= $instructor['name']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>


            </form>
        </div>
        <!-- Datatable -->
        <table class="table table-bordered mb-5">
            <thead >
                <tr class="table-success">
                    <th scope="col" ><span><i class="fas fa-user"></i>
</span>Feedback Id</th>
                    <th scope="col">Course Id</th>
                    <th scope="col">Year</th>

                    <th scope="col">Rating</th>
                    <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($authors as $author): ?>
                <tr>
                    <th scope="row"><?php echo $author['feedback_id']; ?></th>
                    <td><?php echo $author['course_id']; ?></td>
                    <td><?php echo $author['year']; ?></td>
                    <td><?php echo $author['rating']; ?></td>
                    <td><a href="viewexp.php?feedback_id=<?php echo $author['feedback_id']; ?> ">View</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Pagination -->
        <nav aria-label="Page navigation example mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . $prev; } ?>">Previous</a>
                </li>
                <?php for($i = 1; $i <= $totoalPages; $i++ ): ?>
                <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
                    <a class="page-link" href="view.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                </li>
                <?php endfor; ?>
                <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?page=". $next; } ?>">Next</a>
                </li>
            </ul>
        </nav>
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
    xmlhttp.open('GET', '../admin.php', true);
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
