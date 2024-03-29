<?php include 'includes/dbconfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ZeroBugPas | Dashboard</title>
    
    <link rel="stylesheet" href="css/dashboard.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<?php
  session_start(); 
  if(isset($_SESSION["loggedIn"])) {
    if(!empty($_SESSION["loggedInUserId"])) {
      $id = $_SESSION["loggedInUserId"];
      $sql = "SELECT * FROM user_details WHERE id = ".$id;
      if($result = $con->query($sql)){
        $record = $result->fetch_assoc();
        if($record['isUpdated']=='false'){
          header('Location: profile.php');exit;
        }
      }
      // $sql_img = "SELECT Image FROM user WHERE Id = ".$id;
      // $result_img = $conn->query($sql);
      // $record_img = $result->fetch_assoc();
    }
  }
  else {
    header("Location:index.html");exit;
  }
?>
<?php
  if(isset($_POST['subAFScheme'])){
    if(!empty($_POST['schemes']))
      $schemes=json_encode($_POST['schemes']);
      
    $sql = "INSERT INTO schemeuser (user, schemes) VALUES ('$id','$schemes')";
    if ($con->query($sql) === true){
      header("Location: ?success=1");exit;
    }
    else
      header("Location: ?success=0");exit;
  }
  if(isset($_GET['success'])){
    if($_GET['success']==1) echo 'Successful';
    if($_GET['success']==0) echo 'Already Applied';
  }
?>
<nav class="navbar navbar-expand-lg" style="background-color: #192a56;">
  <a class="navbar-brand" style="color: white; text-decoration: none;" href="">ZeroBugPas</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span style='display:block;border:2px solid white;width:30px;margin:5px;border-radius:20px;'></span>
    <span style='display:block;border:2px solid white;width:30px;margin:5px;border-radius:20px;'></span>
    <span style='display:block;border:2px solid white;width:30px;margin:5px;border-radius:20px;'></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" style="color: white; text-decoration: none;" href="">Welcome <b><?php echo $record["first_name"]; ?></b></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" style="color: white; text-decoration: none;" href="logout_config.php">LogOut</a>
      </li>
    </ul>
  </div>
</nav>
    <header>
        <div id="head">
            <h2>Dashboard</h2>
        </div>
    </header>
    
<!--This part of code is for profile picture and name & mail-id-->
    <style>
     #appFSch{
       display:none;
       position:fixed;
       top:0;
       bottom:0;
       left:0;
       right:0;
       overflow:auto;
       background:rgba(1, 1, 1, 0.5);
       z-index:100;
     }
     .appFSchC1{
        padding:20px;
        width:90%;
        max-width:400px;
        height:500px;
        margin:auto;
        margin-top:50px;
        background:white;
        border-radius:20px;
        box-shadow: 0px 0px 10px 0px black;
     }
     .appFSchC1 input, .appFSchC1 button{
        margin:5px;
        padding:5px;
        border:none;
        border-radius:10px;
        background:lightblue;
        min-width:35px;
     }
     .appFSchC1 input:hover, .appFSchC1 button:hover{
        background:blue;
        color:white;
     }
   </style>
   <div id='appFSch'>
     <div class='appFSchC1'>
       <h2 style='text-align:center;'>Apply For Scheme</h2><br>
     <form action="" method="post">
       <?php 
       if($schemesData=mysqli_query( $con, "SELECT * FROM `schemes`"));
       while($rowSch=mysqli_fetch_assoc($schemesData)){
       ?>
        <input type="checkbox" name='schemes[]' value="<?php echo $rowSch['schemeid']; ?>"><span><?php echo $rowSch['schemename']; ?></span><br>
       <?php } ?>
        <input type="submit" name='subAFScheme' value="Submit">
     </form>
     <button onclick='document.getElementById("appFSch").style.display="none";'>X</button>
     </div>
   </div>
 
<!--This part of code is for card menu-->
<main class="main">
  
   <div class="container">
    <div class="card card--split-1">
    <div class="card__pic">
     <span class="card__placeholder">
    <img src="images/profile.png" alt="">
   </span>
    </div>
        <h2 class="card__headline card__headline--centered"><a href="profile.php" style="color: white; text-decoration: none;">Profile</a></h2>
   </div>

    <div class="card card--split-2">
    <div class="card__pic">
     <span class="card__placeholder">
    <img src="images/service.png" alt="">
   </span>
    </div>
        <h2 class="card__headline card__headline--centered" ><a href="#" style="color: white; text-decoration: none;" data-toggle="modal" data-target="#categoryModal">New Services</a></h2>
   </div>
   
   <div class="card card--split-3">
    <div class="card__pic">
     <span class="card__placeholder">
    <img src="images/payment.png" alt="">
   </span>
    </div>
    <h2 class="card__headline card__headline--centered"><a href="schemes\index.html" style="color: white; text-decoration: none;"> Get Scheme Details</h2></a>
   </div>
   <div class="card card--split-4">
    <div class="card__pic">
     <span class="card__placeholder">
    <img src="images/apply.png" alt="">
   </span>
    </div>
    <h2 class="card__headline card__headline--centered" ><span style="cursor:pointer;" onclick="document.getElementById('appFSch').style.display='block';">Apply For Schemes</span></h2>
   </div>
   
   <div class="card card--split-5">
    <div class="card__pic">
     <span class="card__placeholder">
    <img src="images/chat.png" alt="">
   </span>
    </div>
    <h2 class="card__headline card__headline--centered"><a href="schemes\forum.php" style="color: white; text-decoration: none;">Customer Queries</h2></a>
   </div>
   
  
</main>
 <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Select State and Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
         
        <div class="input-group mb-3">

          <select class="custom-select" id="inputGroupSelect01" name="state">
            <option selected value="0">SELECT STATE</option>
            <?php
              $sql = "SELECT * FROM states WHERE status = 1";
              $result = $con->query($sql);
              while($arr = $result->fetch_assoc()) {
              ?>
            <option value="<?php echo $arr["stateid"]; ?>"><?php echo $arr["statename"]; ?></option>
            <?php } ?>
          </select>
                  </div>
                <div class="input-group mb-3">

          <select class="custom-select" id="inputGroupSelect02" name="category">
           <option selected value="0">SELECT CATEGORY</option>
            <?php
              $sql = "SELECT * FROM categories WHERE status = 1";
              $result = $con->query($sql);
              while($arr = $result->fetch_assoc()) {
              ?>
            <option value="<?php echo $arr["categoryid"]; ?>"><?php echo $arr["categoryname"]; ?></option>
            <?php } ?>
          </select>
             
         
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">View</button>
      </div>
    </div>
        </form>
  </div>
</div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  
</body>




</html>