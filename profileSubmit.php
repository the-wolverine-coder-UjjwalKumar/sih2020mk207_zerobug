<?php 
session_start();
   $servername = "localhost";
   $username = "root";
   $dbname = "sewa";

   $conn = mysqli_connect($servername, $username,null,$dbname);

   $user_id = $_SESSION["loggedInUserId"];

  if($_SERVER["REQUEST_METHOD"] == "POST"){

        $father_name = $_POST['father_name'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $aadhaar = $_POST['aadhaar'];
        $address = $_POST['address'];
        $district = $_POST['district'];
        $state = $_POST['state'];
        $pin = $_POST['pin'];


        if($conn->connect_error){
            die("Connection Failed:".$conn->connect_error);
        }

        $sql = "INSERT INTO userPersonal_details(father_name,dob,gender,aadhaar,address,district,state,pin,user_id)
                VALUES ('$father_name','$dob','$gender','$aadhaar','$address','$district','$state','$pin','$user_id')"; 

            
        if($conn->query($sql)){
            header("location:myDashboard.php");
        }else{
            echo"Error".$sql."<br>".$conn->error;
        }


  }




?>