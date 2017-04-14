<?php
session_start();
isset($_REQUEST['ad_s'])?$ad_s=$_REQUEST['ad_s']:$ad_s="";
isset($_REQUEST['new_user'])?strip_tags($new_user=$_REQUEST['new_user']):$new_user="";
isset($_REQUEST['new_pass'])?strip_tags($new_pass=$_REQUEST['new_pass']):$new_pass="";
isset($_REQUEST['del_uid'])?strip_tags($del_uid==$_REQUEST['del_uid']):$del_uid="";

include_once("/var/www/html/project/header.php");
include_once("/var/www/html/project/connect.php");
connect($db);
$user_id=$_SESSION['userid'];
if($user_id!=1)
{

	header("Location: /project/index.php");
}

switch($ad_s)
{
	case 1:
	default: 
		$fail=$_SESSION['fail'];
		echo "<br> <center> <font size=\"+4\"> Welcome,Admin! What do you wish to do today?</font></center>";
		echo "<br> Number of failed logins =$fail";
		echo "<br><br><br><br><br><br><center><font size=\"+3\"> <a href=/project/admin.php?ad_s=2> Login information </a> <br>
				<a href=/project/admin.php?ad_s=3> Add new user</a> <br>
				 <a href=/project/admin.php?ad_s=5> Delete a  user</a> <br>

				<a href=/project/admin.php?ad_s=3> Add new character </a> <br> </font> </center>";
		break;
	case 2: 
		echo "<table border=\"1\"><tr><th>IP</th><th> User name </th> <th>Status</th><th>date</th></tr>";
		/*$query="SELECT DBZ.users.user_name from DBZ.users WHERE DBZ.users.user_id=$user_id";
		$result=mysqli_query($db,$query);
		$user="";
		while($row=mysqli_fetch_row($result))
		{
			$user=$row[0];
			break;
		}*/
		if($stmt=mysqli_prepare($db,"SELECT DBZ.login.ip,DBZ.login.status,DBZ.login.date,DBZ.login.user_id,DBZ.login.user_name FROM DBZ.login"))
		{
		#	mysqli_stmt_bind_param($stmt);
			echo "<br> At least here";
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$ip,$status,$date,$uid,$u_name);
			while(mysqli_stmt_fetch($stmt))
			{
				$date=$date;
				$status=$status;
				$ip=$ip;
				$uid=$uid;
				#echo "uid is $uid<br>";
				$u_name=$u_name;
				/*if($st=mysqli_prepare($db,"SELECT DBZ.users.user_name FROM DBZ.users WHERE DBZ.users.user_id=?"))
				{
					echo "Here we are";
					mysqli_stmt_bind_param($st,$uid);
					mysqli_stmt_execute($st);
					mysqli_stmt_bind_result($st,$user);
					while(mysqli_stmt_fetch($st))
					{
						$user=$user;
						echo "<br> user is"; echo " $user";			
					}
			
					mysqli_stmt_close($st);
				}*/




				echo "<tr><th>$ip</th><th>$u_name</th><th>$status</th><th>$date</th>";

			}
			mysqli_stmt_close($stmt);

				echo "</table>";

		}
		
		break;
	
	case 3: 
		#PART 1 NEW USER
		echo "Let's add a new user";
		echo "<form method=post action=/project/admin.php>
			Enter user name:
			<input type=\"text\" name=\"new_user\">
			<br> Enter password:
			<input type=\"password\" name=\"new_pass\">
			<br> SUBMIT
			<input type=\"hidden\" name=\"ad_s\" value=4>
			<input type=\"Submit\" name=\"Submit\" value=\"Submit\">
			";
	  
		break;
	
	case 4:
		#Part 2 new user
		#echo "Case yo";
		#user exist check variable
		$check=0;
		if($stmt=mysqli_prepare($db,"SELECT DBZ.users.user_id from DBZ.users where DBZ.users.user_name=?"))
		{
				mysqli_stmt_bind_param($stmt,"s",$new_user);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt,$exist_uid);
				while(mysqli_stmt_fetch($stmt))
				{
					$exist_uid=htmlspecialchars($exist_uid);
					$check=1;
					break;			
				}
			mysqli_stmt_close($stmt);			
		}
		if($check==1)
		{
			echo "<br><br><center><font size=\"+3\"> User with $new_user name already exists</font></center>";
		
		}
		else
		{
			$salt=rand();
			$new_pass=hash('sha256',$new_pass.$salt);
			
			if($stmt=mysqli_prepare($db,"INSERT INTO DBZ.users SET DBZ.users.user_id='',DBZ.users.user_name=?,DBZ.users.user_pass=?,DBZ.users.user_salt=?"))
			{
				mysqli_stmt_bind_param($stmt,"sss",$new_user,$new_pass,$salt);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);	
			}

			echo "<br><center> <font size=\"+3\"> User with the user name $new_user created </font></center>";
		}
		break;


	case 5:
		echo "<br><center><font size=\"+2\"> Select a user:";
		echo "<form method=post action=/project/admin.php?ad_s=6>";
		echo "<select name=\"del_uid\">";
#		echo "<br> Select a user:";	
		if($stmt=mysqli_prepare($db,"SELECT DBZ.users.user_name,DBZ.users.user_id from DBZ.users"))
		{
			   #mysqli_stmt_bind_param($stmt,"s",$new_user);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt,$uname,$uid);
                                while(mysqli_stmt_fetch($stmt))
                                {
					if($uname!="admin")
					{
                                        	$uname=htmlspecialchars($uname);
						$uid=htmlspecialchars($uid);
                              			echo "<option value=$uid><font size=\"+2\">$uname  $uid </font> </option>";    
                                   	}
                                }

		}
	
		echo "</font></center> </select> <input type=\"Submit\" value=\"Submit\" name=\"Submit\"></form>";
		break;
	case 6:
		echo "<br> Delete uid is $del_uid";
}
