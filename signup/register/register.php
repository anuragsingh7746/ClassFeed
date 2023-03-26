<?php
require('../../server/connect.php');

$email = $_GET['email'];
$token = $_GET['token'];
$currentDate = date("Y-m-d H:i:s");

$check_token = "SELECT * FROM P2_Registration WHERE email = '$email' AND token = '$token' ";
$result = $conn->query($check_token);

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
    <link href="register.css" rel="stylesheet" />
  </head>

<?php 

if($result->num_rows === 1){
    $row = $result->fetch_assoc();
    if($row['expiryDate'] >= $currentDate ){

      $username = substr($email, 0, 10);
      $batch = substr($username, 3, 4);
      $program = substr($username, 0, 1);
      $department = substr($username, 1, 2);
?>

  <body class="text-center">
    <main class="form-verify w-100 m-auto">
      <img
        class="mb-4"
        src="../../pictures/iiita_logo.png"
        alt=""
        width="225"
        height="225"
      />
      <h1 class="h3 mb-3 fw-normal">ClassFeed</h1>
      
 <form action="">     
  <div class="row mb-2">
      <div class="form-floating col-md-6">
        <input
          type="text"
          class="form-control"
          id="floatingInput"
          name="name"
          placeholder="Anurag Singh" 
        />
        <label for="floatingInput">Full Name</label>
      </div>
      
      <div class="form-floating col-md-6">
        <input
          type="text"
          class="form-control"
          id="floatingInput"
          name="username"
          placeholder="iit2021xxx"
          value="<?php echo $username; ?>"
          disabled
        />
        <label for="floatingInput">Username</label>
      </div>
   </div> 
   
   <div class="row mb-2">
   
      <div class="form-floating col-md-4">
        <input
          type="text"
          class="form-control"
          id="floatingInput"
          name="Program"
          placeholder="BTech./MTech."
          value="<?php if($program == 'i'){
                  echo "BTech.";
          }else if($program == 'm'){
            echo "MTech.";
          }else echo "PhD" ?>" 
          disabled
        />
        <label for="floatingInput">Program</label>
        
      </div>
      
      <div class="form-floating col-md-4">
        <input
          type="text"
          class="form-control"
          id="floatingInput"
          name="batch"
          placeholder="202x"
          value="<?php echo $batch; ?>"
          disabled
        />
        <label for="floatingInput">Batch</label>
      </div>
      
      <div class="form-floating col-md-4">
        <input
          type="text"
          class="form-control"
          id="floatingInput"
          name="department"
          placeholder="IT/ECE/IIB"
          value="<?php if($department == 'it'){
                          echo "IT";
          }else if($department == 'ib'){
                  echo "IT-BI";
          }else if($department == 'ec'){
                  echo "ECE";
          }else echo "Check"; ?>"
          disabled
        />
        <label for="floatingInput">Department</label>
      </div>
      
   </div> 
   
   <div class="row mb-2">
   
      <div class="form-floating col-md-6">
        <input
          type="text"
          class="form-control"
          id="floatingInput"
          name="password"
          placeholder="" 
        />
        <label for="floatingInput">Password</label>
      </div>
      
      <div class="form-floating col-md-6">
        <input
          type="text"
          class="form-control"
          id="floatingInput"
          name="password_check"
          placeholder=""
        />
        <label for="floatingInput">Re-enter Password</label>
      </div>
   </div> 
    
   
   </div>
   
   
   
      <div class="alert alert-primary" role="alert" id="pop" hidden></div>
      <button
        class="w-100 btn btn-lg btn-primary"
        id="button"
        type="submit"
      >
        Register
      </button>
      <p class="mt-5 mb-3 text-muted">
        Copyright &copy; 2023 ClassFeed<br />
        IIIT - Allahabad
      </p>
</form>
    </main>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
    
<?php    
    
    }  
}else echo "errorehehhehe";

?>
