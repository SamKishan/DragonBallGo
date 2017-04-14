<?php
#session_start();
function connect(&$db)
{
                $mycnf="/etc/hw5-mysql.conf";
                if(!file_exists($mycnf))
                {
                        echo "ERROR: DB config file not: $mycnf";
                        exit;
                }
        $mysql_ini_array=parse_ini_file($mycnf);
        $db_host=$mysql_ini_array["host"];
        $db_user=$mysql_ini_array["user"];
        $db_pass=$mysql_ini_array["pass"];
        $db_port=$mysql_ini_array["port"];
        $db_name=$mysql_ini_array["dbName"];
        $db=mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
        if(!$db) {
                print " Error Connecting to DB: ".mysqli_connect_error();
                print " <br>Try again later! :D";

                exit;
        }
}


function authenticate($db,$log_user_name,$log_user_password)

{
				 $_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
				$ip=$_SESSION['ip'];
                                #echo "username =$log_user_name";
                                echo "<br> ip is $ip";
				$white_query="SELECT DBZ.white.white_ip from DBZ.white";
				$check_white=0;
				$result=mysqli_query($db,$white_query);
				while($row=mysqli_fetch_row($result))
				{
					if($ip==$row[0])
					{
						$check_white=1;
						break;
					}
					
				}
				$login_check=0;
				$count_query=" SELECT count(DBZ.login.ip) FROM DBZ.login WHERE (DBZ.login.date > (DATE_SUB(NOW(),INTERVAL 1 MINUTE) )) AND (DBZ.login.status='fail') AND (DBZ.login.ip='198.18.3.206')";
				$result=mysqli_query($db,$count_query);
				$fail_login=0;
				while($row=mysqli_fetch_row($result))
				{
					echo "<br> fail Count=$row[0]";
					echo "<br> Inside";
					$fail_login=$row[0];
					$_SESSION['fail']=$row[0];
				}
				echo "<br> failed logins =$fail_login";
				$set=0;
				if($fail_login>=5 and $check_white!=1) 
				{
					session_destroy();
					$set=1;
					echo "Here";
					header("Location:/project/add.php?s=51");
				}
                                if($stmt=mysqli_prepare($db,"SELECT user_salt,user_pass,user_id from DBZ.users where DBZ.users.user_name=?"))
                                {
                                        mysqli_stmt_bind_param($stmt,"s",$log_user_name);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_bind_result($stmt,$user_salt,$user_pass,$user_id);

					echo "<br> Hi you <br>";
                                        while(mysqli_stmt_fetch($stmt))
                                        {
                                                $user_salt=$user_salt;
                                                $user_pass=$user_pass;
                                                $log_user_password=hash('sha256',$log_user_password.$user_salt);
                                                #echo "<br><br> user_salt=$user_salt";
                                                #echo "<br>log_user_password=";
                                                #echo substr($log_user_password,0,-4);
                                                #echo "<br>user_pass=$user_pass";

                                                if(substr($log_user_password,0,-4)==$user_pass)
                                                {
                                                        $login_check=1;
					#		$_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
							session_regenerate_id();
							$_SESSION['authenticated']="yes";
							$_SESSION['userid']=$user_id;
        						$_SESSION['HTTP_USER_AGENT']=md5($_SERVER['SERVER_ADDR'].$_SERVER['HTTP_USER_AGENT']);
							$_SESSION['created']=time();
	                                                break;
                                                }

                                        }



                                        mysqli_stmt_close($stmt);
                                }

				$ip=$_SESSION['ip'];

			#	echo "<br> first ip is $ip";
				connect($db);
                                if($login_check==1)
                                {
					/*echo "<br> Userid =$user_id <br>";
					echo "<br> Your IP is" ;
					#$ip=$_SESSION['ip'];
					echo "$ip";i */
					$time=date("Y-m-d H:i:s");
                                        #Let's insert this into the table
					#connect($db);	
					if($stmt=mysqli_prepare($db,"INSERT INTO DBZ.login set DBZ.login.login_id='',DBZ.login.ip=?,DBZ.login.status=?,DBZ.login.date=now(),DBZ.login.user_id=?,DBZ.login.user_name=?"))
					{
						#echo " <br> ....  ";
						if($set!=1)
						{	
							$status="pass";
						}
						else
						{
							$status="fail";
						}
						#Check with Joe if after 5 failed login attempts and the user enters valid credentials, should the status say "pass " o "fail" 
						#Right now I've kept it as pass.
						$status="pass";	
						#echo "pass";
						mysqli_stmt_bind_param($stmt,"ssss",$ip,$status,$user_id,$log_user_name);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_close($stmt);

				
					}
					


					


					echo " <center>You have logged in successfully";
					echo "<br><br><br> <a href=/project/add.php?s=111> Wanna log out? </a>"; 
					if($user_id!=1) {
					echo "<br> <a href=/project/game.php> Let's play? </a></center> ";
                               		}
					else 
					{
						header ("Location: /project/admin.php");
			
					}
				 }

                                else
                                {
#					echo "<br> second ip is $ip";
#                                        echo "<br><br>Wrong password/username";
				
#					 $ip=$_SESSION['ip'];
                                        echo "<br> ip is $ip";
                                        $time=date("Y-m-d H:i:s");
	
                                        if($stmt=mysqli_prepare($db,"INSERT INTO DBZ.login set DBZ.login.login_id='',DBZ.login.ip=?,DBZ.login.status=?,DBZ.login.date=now(),DBZ.login.user_id=?,DBZ.login.user_name=?"))
                                        {
                                                echo " <br> ....  ";
                                               $status="fail";
                                                echo "fail";
                                                mysqli_stmt_bind_param($stmt,"ssss",$ip,$status,$user_id,$log_user_name);
                                                mysqli_stmt_execute($stmt);
                                                mysqli_stmt_close($stmt);


                                        }


					
					if(session_id()!=''){
						session_destroy();
                                       	}
					error_log("----------------ERROR------: DBZ App has failed login from ".$_SERVER['REMOTE_ADDR'],0);
					 header("Location:/project/add.php?s=51&fail=1");
                                }


}


function logout()
{

		if(session_id()!='')
		{
			session_destroy();
		}
		header("Location:/project/add.php?s=51");



}

function checkauth()
{
	
	if(isset($_SESSION['HTTP_USER_AGENT'])) 
		{
		if($_SESSION['HTTP_USER_AGENT']!=md5($_SERVER['SERVER_ADDR'].$_SERVER['HTTP_USER_AGENT']))
			{
			logout();
			}
		}

	else	{
			logout();
		}
	if(isset($_SESSION['ip'])) 
	{
        	if($_SESSION['ip']!=$_SERVER['REMOTE_ADDR'])
		{
                	logout();
        	}
	}
	else
	{
                logout();
	}
	if(isset($_SESSION['created'])) 
	{
        	if(time()-$_SESSION['created']>1800){
                	logout();
        	}
	}
	else{
        	        logout();
	}

	/*if("POST"==$_SERVER["REQUEST_METHOD"])
	{
		if(isset($_SERVER["HTTP_ORIGIN"])){
			if($_SERVER["HTTP_ORIGIN"]!="https://100.66.1.18"){
				logout();
			}	
		}
		else
		{
			logout();
		}
	}*/	




}
?>
