<?php
    
    session_start();
    //include "config.php";
    //include_once('header2.php');
    //include "functions.php";
    
    /*if(isset($_SESSION['userid']))
    {
    $targetPage = "logout.php";
    redirect($targetPage);
    }*/
    
    //if(isset($_POST['login']) && $_POST['username'] !=NULL && $_POST['password'] != NULL) {
    if(isset($_POST['username']) && $_POST['username'] !=NULL &&  isset($_POST['password']) && $_POST['password']!=NULL ) {
    	//echo '<pre>';
    	//print_r($_POST);exit();
    	$emp_code = $_POST['username'];
    	$emp_passwd = $_POST['password'];
    
    	//$SelQuery	= "Select ed.id,l.user_type from Employees Where EmployeeCode='$emp_code'";
    	$SelQuery	= "SELECT * FROM Employees Where EmployeeCode='$emp_code'";
    	$SelResult	= mysqli_query($ts_dbconn,$SelQuery);
    	$result = mysqli_fetch_assoc($SelResult);
    	$role_id = $result['RoleId'];
    	$hash_passwd = $result['PasswordHash'];
    
    	if(mysqli_num_rows($SelResult) > 0) {
    		//print_r($result);exit();
    		$_SESSION['EmployeeCode'] = $result['EmployeeCode'];
    		$_SESSION['userid'] = $result['EmployeeCode'];
    
    		if($role_id == 3) {
    			$_SESSION['usertype']='admin';
    		}
    		
    		//if (password_verify($emp_passwd, $hash_passwd)) {
		    //return true;
		        header("Location:  monthly_status_entry.php");
		    //}
		    //else {
		       // echo '<script>alert("Incorrect login detals")
		        //</script>';
		    //}
    		
    	}
    	else {
    		
    		$targetPage = "index.php?login=norecord#logerror";
    		redirect($targetPage);
    	}
    }
   

?>

<body>
	<p><br/><br/></p>
	<div class="container">
    	<!--<p class="text-center"><img style="width: 30%;" src="https://www.foundation.co.za/images/fpd-logo.png" /></p>-->
   		<h3 align="center">FPD Timesheet Login</h3>   
   
   		<!--<form name="frmLogin" method="post" action="check-login.php" onSubmit="javascript:return validation(this);">--> 
		   <form name="frmLogin" method="post" action="" >    
			<div class="form-group">
				<label for="email">Username <span class="error">*</span></label>
				<input type="username" name="username" class="form-control" id="username" >
				<span style="color: red;"><?php echo $username_error; ?></span>
			</div>
		
			<div class="form-group">
				<label for="password">Password: <span class="error">*</span></label>
				<input type="password" class="form-control" name="password" id="password" >
				<span style="color: red;"><?php echo $pass_error; ?></span>
			</div>    
			<button style="display: none" class="g-recaptcha" data-sitekey="6LdENlorAAAAAMDL3Xelr3tObYF_VBX6fOCrv4KP" 
				data-callback='onSubmit' 
				data-action='submit'>Submit</button>
			<button type="submit" class="btn btn-info mb-5 " name="login">Login</button>

   		</form>
	</div>
	<p>
		<?php include "footer.php";?>
	</p>
	</body>
</html>

