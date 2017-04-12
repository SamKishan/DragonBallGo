<?php 
session_start();
isset($_REQUEST['ad_s'])?$ad_s=$_REQUEST['ad_s']:$ad_s="";
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
		echo "<br> <center> <font size=\"+4\"> Welcome,Admin! What do you wish to do today?</font></center>";
		echo "<br><br><br><br><br><br><center><font size=\"+3\"> <a href=/project/admin.php?ad_s=2> Login information </a> <br>
				<a href=/project/admin.php?ad_s=3> Add new user</a> <br>
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
		if($stmt=mysqli_prepare($db,"SELECT DBZ.login.ip,DBZ.login.status,DBZ.login.date,DBZ.login.user_id FROM DBZ.login"))
		{
		#	mysqli_stmt_bind_param($stmt);
			echo "<br> At least here";
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$ip,$status,$date,$uid);
			while(mysqli_stmt_fetch($stmt))
			{
				$date=$date;
				$status=$status;
				$ip=$ip;
				$uid=$uid;
				#echo "uid is $uid<br>";
				$user="";
				if($st=mysqli_prepare($db,"SELECT DBZ.users.user_name FROM DBZ.users WHERE DBZ.users.user_id=?"))
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
				}




				echo "<tr><th>$ip</th><th>$user</th><th>$status</th><th>$date</th>";

			}
			mysqli_stmt_close($stmt);

				echo "</table>";

		}
		
		break;
	
	case 3: 
		echo "Case 3";
		break;
	
	case 4:
		echo "Case 4";
		break;




}
