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
    <link href="../add/add.css" rel="stylesheet" />
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
                <li class=""><a href="view.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-list"></i> View Feedback</a></li>
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
                          <li><a class="dropdown-item" href="#">Settings</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="Javascript:logout()">Logout</a></li>
                        </ul>
                      </li>
                      
                      
                      
                    </ul>
                    
                  </div>
                </div>
              </nav>

              <div class="dashboard-content center">

<main class="form-verify w-100 m-auto text-center">
                <!-- <img class="mb-4" src="https://upload.wikimedia.org/wikipedia/en/2/2e/Indian_Institute_of_Information_Technology%2C_Allahabad_Logo.png" alt="" width="225" height="225" /> -->
                <h1 class="h3 mb-3 fw-normal">Change Password</h1>
        
                <div class="row mb-2">
                    <div class="form-floating col-md-14">
                        <input type="password" class="form-control" id="floatingInput" name="password" placeholder="pass" oninput="checkPass()" />
                        <label for="floatingInput">New Password</label>
                    </div>
                </div>
                 <div class="row mb-2">
                    <div class="form-floating col-md-14">
                        <input type="password" class="form-control" id="floatingInput" name="password_check" placeholder="pass" onkeyup="checkPass()"/>
                        <label for="floatingInput">Confirm Password</label>
                    </div>
                </div>

                <div class="alert alert-primary" role="alert" id="pop" hidden></div>
        <button class="w-100 btn btn-lg btn-primary" id="button" type="submit" onclick="submit2()" disabled>
            Change Password
        </button>
        

        <p class="mt-5 mb-3 text-muted">
            Copyright &copy; 2023 ClassFeed<br />
            IIIT - Allahabad
        </p>
       </main>



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
        }
      }
    };
    xmlhttp.open('GET', '../admin.php', true);
    xmlhttp.send();
  }
};

$(".open-btn").on('click' , function(){
            $(".sidebar").addClass('active');
        });

        $(".close-btn").on('click' , function(){
            $(".sidebar").removeClass('active');
        });



function checkPass() {
  const pass = document.getElementsByName('password');
  const pass_check = document.getElementsByName('password_check');
  const button = document.getElementById('button');
  let y = pass_check[0].value;
  let x = pass[0].value;

  if (x != y && y != '') {
    document.getElementById('pop').hidden = false;
    document.getElementById('pop').innerHTML = 'Password Do Not Match';
    button.disabled = true;
  } else {
    document.getElementById('pop').hidden = true;

    button.disabled = false;
  }
}

function submit2() {
  let pop = document.getElementById('pop');
  const pass = document.getElementsByName('password');
  const button = document.getElementById('button');
  let y = pass[0].value;

  const url = 'submit.php';
  const data = {
    password: y,
  };
  $.ajax({
    url: url,
    method: 'POST',
    data: data,
    success: function (response) {
      console.log(response);
      pop.removeAttribute('hidden');
      pop.innerHTML = response + '<br>' + 'Redirecting...';
      button.disabled = true;
      setTimeout(redirect, 2000);
    },
    error: function (xhr, status, error) {
      console.log('Error:', error);
    },
  });
}

function redirect() {
  document.location.href = '../admin.html';
}
    </script>
   </body>
</html>
