<?php
include('connection.php');
session_start();
	$email=$_SESSION['veri_email'];
	$mob=$_SESSION['veri_Mob'];
	if(isset($_POST['create_account']))
	{	
		
		$name= $_POST['NHAI_reg_name'];
		$work_location= $_POST['NHAI_work_location'];			
		$aadhar= $_POST['NHAI_reg_aadhar'];
		$street=$_POST['NHAI_reg_street'];
		$village=$_POST['NHAI_reg_village'];
		$tal=$_POST['NHAI_reg_tal'];
		$dist=$_POST['NHAI_reg_dist'];
		$state=$_POST['NHAI_reg_state'];
	
		$username=$email;
		$str_result='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$password=substr(str_shuffle($str_result),0,8);
	
		$sql = "INSERT INTO `nhai_admin` (`name`, `work_location`,  `username`, `password`, `email`, `mobile`, `aadhar_no`, `street`, `village`, `taluka`, `district`, `state`) VALUES ('$name', '$work_location', '$username', '$password', '$email', '$mob', '$aadhar', '$street', '$village', '$tal', '$dist', '$state')";
	
		$result = mysqli_query($conn,$sql);
		//$result=mysqli_query($conn,"INSERT INTO super_admin(name,username,password,email,mobile,aadhar_no,street, village, taluka, district, state)VALUES('$name', '$username', '$password','$email','$mob', '$aadhar','$street','$village', '$tal', '$dist', '$state')");
		if($result)
		{
			
			$sql = "UPDATE `nhai_admin` set `nhai_id` = concat(`prefix`,`id`)";
			$res = mysqli_query($conn,$sql);
			if($res)
			{
				$sqlf = "UPDATE `admin_registration` SET `flag` = 1 WHERE email='".$email."' AND mobile='".$mob."'";
				$resf = mysqli_query($conn, $sqlf);
				if($resf)
				{ 
					/*
						sending mail of username and password;
					*/
					
					echo"<script type='text/javascript'> 
							alert('record inserted...!!');
						</script>";
						
					header("Location:Login.php");
					
				}
					
			}		
	}
	else
	{
		echo $conn->error;
		echo"<script type='text/javascript'> 

					alert('record not inserted...!!');
			</script>";
	}
		
	
	$conn->close();
}

?>




<!DOCTYPE html>
<html>

<head>
<script>
	function NHAI_Registration()
	{
		var mailformat= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		var name_with_space= /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
		var name_widout_space= /^[a-zA-Z-]+$/;
		var no=/^[0-9]+$/;
		var aadhar_no = /^\d{12}$/;
		var mobile_no = /^\d{10}$/; 
		
		
		
		var name=document.getElementById("NHAI_reg_name").value;
		var work_location=document.getElementById("NHAI_work_location").value;		
		var email=document.getElementById("NHAI_reg_email").value;
		var mobile_no=document.getElementById("NHAI_reg_mobile_no").value;
		var aadhar=document.getElementById("NHAI_reg_aadhar").value;
		var street=document.getElementById("NHAI_reg_street").value;
		var village=document.getElementById("NHAI_reg_village").value;
		var tal=document.getElementById("NHAI_reg_tal").value;
		var dist=document.getElementById("NHAI_reg_dist").value;
		var state=document.getElementById("NHAI_reg_name").value;
		
		
	
			if(!name.match(name_with_space))
			{
				 
				alert("Plz Enter valid name  ");
				return false;
			}
			else if(!work_location.match(name_with_space))
			{
				 
				alert("Plz Enter valid work location  ");
				return false;
			}
			else if(!(aadhar.match(no)) || (aadhar.length!=12))
			{
				alert("Plz Enter valid Aadhar no ");
				return false;
			}
			else if(!street.match(name_with_space))
			{
				 
				alert("Plz Enter valid street  ");
				return false;
			}
			
			else if(!village.match(name_widout_space))
			{
				 
				alert("Plz Enter valid village  ");
				return false;
			}
			else if(!tal.match(name_widout_space))
			{
				 
				alert("Plz Enter valid Taluka name ");
				return false;
			}
			else if(!dist.match(name_widout_space))
			{
				 
				alert("Plz Enter valid District name ");
				return false;
			}
			else if(!state.match(name_widout_space))
			{
				 
				alert("Plz Enter valid State name ");
				return false;
			}
			else
			{
				window.location.replace("NHAI_Home.php");
			}
			
          
          return true;
	}
	
	
	function discard()
  {
    
    location.reload();
    return true;
  }

</script>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>NHAI Ambulance Admin Registration</title>
  <!-- Favicon -->
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body style="background-color:powderblue;" class="bg-default">
  <div class="main-content">
    <!-- navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand pt-0">
        <img src="logo_white.png" class="navbar-brand-img" alt="...">
      </a>
        
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="../index.html">
                  <img src="../assets/img/brand/blue.png">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sideGAv-main" aria-expanded="false" aria-label="Toggle sideGAv">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- navbar items -->
          
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container" >
        <div class="header-body text-center mb-6">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6" >
              <!-- <h1 class="text-white">Welcome!</h1> -->
              <p class="text-lead text-light">Create NHAI Ambulance Admin Account </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <p class = style= line-height:3.8;></p>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-7">
          <div class="card bg-secondary shadow border-0">

            <div class="card-body px-lg-5 py-lg-5">

              <form role="form" action="NHAI_Register.php" method="POST">

                   <div class="row">
  
                    <div class="col-lg-8">
                      <div class="form-group">
							<label class="form-control-label" for="input-username"> Enter your name:</label>
                            <input id="NHAI_reg_name" name="NHAI_reg_name"class="form-control" placeholder="name" type="text" required>
                      </div>
                    </div>
                    </div>
					
					<div class="row">
					<div class="col-lg-8">
                      <div class="form-group">
							<label class="form-control-label" for="input-username"> Enter Admin Work Location:</label>
                            <input id="NHAI_work_location" name="NHAI_work_location"class="form-control" placeholder="Admin Work Location" type="text" required>
                      </div>
                    </div>
					
					</div>
                  
					<div class="row">
                    <div class="col-lg-8">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Aadhar No:</label>
                        <input id="NHAI_reg_aadhar" name="NHAI_reg_aadhar"class="form-control" placeholder="Aadhar card Number" type="text" required>
                      </div>
                    </div>
					</div>
					
					<div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Street:</label>
                           <input id="NHAI_reg_street" name="NHAI_reg_street"class="form-control" placeholder="Street" type="text" required>

                      </div>
                    </div>
					
					 <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Village:</label>
                           <input id="NHAI_reg_village" name="NHAI_reg_village"class="form-control" placeholder="Village" type="text" required>

                      </div>
                    </div>
                    </div>
					
					<div class="row">
					 <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> Taluka:</label>
                           <input id="NHAI_reg_tal"name="NHAI_reg_tal"class="form-control" placeholder="Taluka" type="text" required>

                      </div>
                    </div>
					
					 <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> District:</label>
                           <input id="NHAI_reg_dist" name="NHAI_reg_dist"class="form-control" placeholder="District" type="text" required>

                      </div>
                    </div>
                    </div>
					
					<div class="row">
					<div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username"> State:</label>
                           <input id="NHAI_reg_dist" name="NHAI_reg_state"class="form-control" placeholder="State" type="text"required>

                      </div>
                    </div>
					</div>
					
                <div class="text-center" >
                  <button id="create_account" type="submit" name="create_account" required="true" class="btn btn-success my-4" onclick = "NHAI_Registration()" >Register</button>
                  <button id="discard" type="submit"  name="discard" required="true" class="btn btn-danger my-4" onclick = "discard()" >Discard</button>
                </div>
				
              </form>
            </div>
          </div>
          
		  <div class="row mt-3">
            <div class="col-6">
              <a href="Login.php" class="text-light"><small>Already have an account, go to Log in!</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </body>

</html>