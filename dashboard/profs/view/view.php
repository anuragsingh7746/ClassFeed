<?php
include('db.php');
  // Set session
  session_start();
  if(isset($_POST['records-limit'])){
      $_SESSION['records-limit'] = $_POST['records-limit'];
  }
  
  $limit = isset($_SESSION['records-limit']) ? $_SESSION['records-limit'] : 5;
  $page = (isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
  $paginationStart = ($page - 1) * $limit;
  $year = date('Y');
if(isset($_POST['course_id'])){
      $_SESSION['course_id'] = $_POST['course_id'];
  }
  if(isset($_SESSION['course_id']) ){
    $_SESSION['course_id'] = isset($_SESSION['course_id']) ? $_SESSION['course_id'] : $_POST['course_id'];
    $course = $_SESSION['course_id'];
    $ID = $_SESSION['enroll_no'];
$sql = "SELECT sec_id FROM P2_Teaches WHERE ID = '$ID' AND year = '$year' AND course_id = '$course'";
$result1 = $connection->query($sql)->fetchAll();
$sec = $result1[0]['sec_id'];

  $authors = $connection->query("SELECT t.course_id, t.sec_id, t.semester, t.year, tk.enroll_no, m.pseudo_name, f.feedback_id, f.comment FROM ( SELECT * FROM P2_Teaches WHERE course_id = '$course' AND ID = '$ID' AND year = '$year' ) t JOIN ( SELECT * FROM P2_Takes WHERE sec_id = '$sec' ) tk ON t.course_id = tk.course_id AND t.semester = tk.semester AND t.year = tk.year JOIN P2_Mapping m ON tk.enroll_no = m.enroll_no JOIN P2_Feedback f ON m.pseudo_name = f.pseudo_name AND t.course_id = f.course_id AND t.year = f.year LIMIT $paginationStart, $limit")->fetchAll();
  // Get total records
  $sql = $connection->query("SELECT count(f.feedback_id) AS id FROM ( SELECT * FROM P2_Teaches WHERE course_id = '$course' AND ID = '$ID' AND year = '$year' ) t JOIN ( SELECT * FROM P2_Takes WHERE sec_id = '$sec' ) tk ON t.course_id = tk.course_id AND t.semester = tk.semester AND t.year = tk.year JOIN P2_Mapping m ON tk.enroll_no = m.enroll_no JOIN P2_Feedback f ON m.pseudo_name = f.pseudo_name AND t.course_id = f.course_id AND t.year = f.year")->fetchAll();
  $allRecrods = $sql[0]['id'];
  
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
                <li class=""><a href="../professor.html" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="active"><a href="view.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-list"></i> View Feedback</a></li>
                <li class=""><a href="../add/add.html" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-user-graduate"></i> Add Students</a></li>
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
                          <li><a class="dropdown-item" href="../settings/settings.html">Settings</a></li>
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
  $ID = $_SESSION['enroll_no'];
  $sql = "SELECT course_id FROM P2_Teaches WHERE ID = '$ID' AND year = '$year'";
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


            </form>
        </div>
        <!-- Datatable -->
        <table class="table table-bordered mb-5">
            <thead >
                <tr class="table-success">
                    <th scope="col" ><span><i class="fas fa-user"></i>
</span>Feedback Id</th>
                    <th scope="col">Course Id</th>
                    <th scope="col">Anon Id</th>
                    <th scope="col">Year</th>
                    <th scope="col">Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($authors as $author): ?>
                <tr>
                    <th scope="row"><?php echo $author['feedback_id']; ?></th>
                    <td><?php echo $author['course_id']; ?></td>
                    <td style="width:10px"><?php echo $author['pseudo_name']; ?></td>
                    <td><?php echo $author['year']; ?></td>
                    <td><?php echo $author['comment']; ?></td>
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
          document.getElementById('navbarDropdown').innerHTML = '<i class="fas fa-user"></i> ' + result;
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
