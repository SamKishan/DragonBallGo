<?php
session_start(); 
session_regenerate_id();
isset($_REQUEST['s'])?$s=strip_tags($_REQUEST['s']):$s="";
isset($_REQUEST['series_id'])?$series_id=strip_tags($_REQUEST['series_id']):$series_id="";
isset($_REQUEST['sign_user_password'])?$sign_user_password= strip_tags($_REQUEST['sign_user_password']):$sign_user_password="";
isset($_REQUEST['sign_user_name'])?$sign_user_name=strip_tags($_REQUEST['sign_user_name']):$sign_user_name="";
isset($_REQUEST['log_user_password'])?$log_user_password=strip_tags($_REQUEST['log_user_password']):$log_user_password="";
isset($_REQUEST['log_user_name'])?$log_user_name=strip_tags($_REQUEST['log_user_name']):$log_user_name="";
isset($_REQUEST['fail'])?$fail=strip_tags($_REQUEST['fail']):$fail="";
#isset($_REQUEST['user_id'])?$user_id=strip_tags($_REQUEST['user_id']):$user_id="";

	include_once("/var/www/html/project/header.php");
	include_once("/var/www/html/project/connect.php");
	connect($db);
	switch($s)
{
		case 50:	#Sign up
				echo "<br> <center> <font size=\"+3\"> Sign up page </font></center> <br>";
				echo "<center> <form method=\"post\" action=/project/add.php>";
				echo "Enter name: <input type=\"text\" name=\"sign_user_name\"> <br>";
				echo "Enter password: <input type=\"password\" name=\"sign_user_password\"> <br>";
				echo "<input type=\"hidden\" name=\"s\" value=52>";
				echo "<input type=\"Submit\" name=\"Submit\" value=\"Submit\">";

			

				break;


		case 51:	#Login
				echo "<br> <center> <font size=\"+5\"> Login page </font></center> <br>";
                              	if($fail==1)
				{
					echo "<center>Sorry, wrong username/password <br> Please try again</center> <br><br>";

				}
				if(!isset($_SESSION['authenticated'])){
				echo "<font size=\"+3\"> <center> <form method=\"post\" action=/project/add.php>";
                                echo "Enter name: <input type=\"text\" name=\"log_user_name\"> <br>";
                                echo "Enter password: <input type=\"password\" name=\"log_user_password\"> <br>";
                                echo "<input type=\"hidden\" name=\"s\" value=53>";
				echo "<input type=\"Submit\" name=\"Submit\" value=\"Submit\"> </font>";
				}
				else
				{
					echo "You've already logged in ";
				}


                                break;
		case 52:
				#Sign up
				echo "username = $sign_user_name";
				$salt=rand();
				echo "<br> salt is $salt";
				$sign_user_password_hash=hash('sha256',$sign_user_password.$salt);
				echo "<br> sign_user_password=$sign_user_password_hash";
				if($stmt=mysqli_prepare($db,"INSERT into DBZ.users set DBZ.users.user_id='',DBZ.users.user_name=?,DBZ.users.user_pass=?,DBZ.users.user_salt=?")) 
				{
	
					mysqli_stmt_bind_param($stmt,"sss",$sign_user_name,$sign_user_password_hash ,$salt);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);

				}			
				header("Location:/project/index.php");	
				break;
		case 53:
				#Login
				if(!isset($_SESSION['authenticated']))
				{
					authenticate($db,$log_user_name,$log_user_password);
					checkauth();
				}
				else 
				{
					echo "You've already logged in";

				}
				break;
		
		case 111: 	logout();
				
				break;
		default: 
				echo " <br><br><br><br><font size=\"+4\"> <center>  DragonBallGo </center> </font>";
				break;
	}

	echo "</body></html>";
?>
