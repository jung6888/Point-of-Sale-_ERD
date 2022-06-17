<?php
session_start();
$msg="";
if(isset($_POST["button_login"])){
	$username =  $_POST["username"];
	$password =  $_POST["password"];
	$con = mysqli_connect("localhost","root","","pos");
	$qry = mysqli_query($con,"select * from table_users where username='".$username."' and password = '".md5($password)."'");
	$count = mysqli_num_rows($qry);
    //username: pos
    //password: admin123
	if($count == 0){
		$msg = "Username or Password is incorrect.";
	}
	else if($count >  0){
		$_SESSION["username"] = $username;
		header("location:dashboard.php");
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="index.css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <meta charset="utf-8">
	</head>
	<body>
	<div class="form-center">
		<h1 class="text-center" id="header1">Login</h1>
		<h3 class="text-center"><?php echo $msg;?></h3>
		<form class="text-center" id="login-form"action='<?php echo $_SERVER["PHP_SELF"]?>' method="post">
		<div >
			Username : <input type="text" name="username" /><br />
		</div>
			Password : <input  type="password" name="password"><br />
			<input  type="submit" value="Login" name="button_login" />
		</form>
	</div>	
	</body>
</html>